<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use App\Models\Presensi;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KaryawanController extends Controller
{

    public function index(Request $request)
    {
        $query = User::with('divisi')
             ->where('role', 'karyawan');

        if ($request->has('filter_divisi') && $request->filter_divisi != '') {
            $query->whereHas('divisi', function ($q) use ($request) {
                 $q->where('nama_divisi', $request->filter_divisi);
            });
        }

        $karyawan = $query->latest()->paginate(20);

        return view('pages.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        $divisis = Divisi::all();

        return view('pages.karyawan.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'no_hp' => 'nullable|string|max:20',
            'password' => 'required|min:8',
            'divisi_id' => 'required|exists:divisis,id',
            'jenis_kelamin' => 'required',
            'status_pernikahan' => 'required',
        ]);

        // 2. Insert data ke tabel users
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => bcrypt($request->password),
            'role' => 'karyawan',
            'divisi_id' => $request->divisi_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_pernikahan' => $request->status_pernikahan,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan baru berhasil didaftarkan!'); 
    }

    public function export(Request $request)
    {
        $query = User::where('role', 'karyawan');

        if ($request->has('filter_divisi') && $request->filter_divisi != '') {
            $query->where('divisi', $request->filter_divisi);
        }

        $karyawan = $query->latest()->get();
        
        // Memproses file view cetak menggunakan DomPDF
        $pdf = Pdf::loadView('pages.karyawan.download_pdf', compact('karyawan', 'request'));
        return $pdf->download('Rekap_Karyawan_' . ($request->filter_divisi ?? 'Semua_Divisi') . '.pdf');
    }

    public function destroy($id)
    {
        $user = User::where('role', 'karyawan')
                    ->findOrFail($id);

        $user->delete();

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus!');
    }

    public function edit($id)
    {
        $karyawan = User::findOrFail($id);

        $divisis = Divisi::all();

        return view('pages.karyawan.EditKaryawan', compact(
            'karyawan',
            'divisis'
        ));
    }

    public function update(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);

        $karyawan->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'divisi_id'         => $request->divisi_id,
            'no_hp'             => $request->no_hp,
            'status_pernikahan' => $request->status_pernikahan,
        ]);

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil diperbarui');
    }

    public function show($id)
    {
        $karyawan = User::with('divisi')
                        ->where('role', 'karyawan')
                        ->findOrFail($id);

        return view('pages.karyawan.detail', compact('karyawan'));
    }

    public function anggotaDivisi()
    {
        $user = auth()->user();

        $divisi = Divisi::findOrFail($user->divisi_id);

        // keamanan
        if ($divisi->ketua_id != $user->id) {
            abort(403);
        }

        $anggota = User::where('divisi_id', $user->divisi_id)
            ->where('role', 'karyawan')
            ->orderBy('name')
            ->get();

        $today = Carbon::today();

        foreach ($anggota as $item) {

            $presensi = Presensi::where('user_id', $item->id)
                ->whereDate('tanggal', $today)
                ->first();

            if ($presensi) {

                $item->status_hari_ini = $presensi->keterangan;

            } else {

                $permission = Permission::where('user_id', $item->id)
                    ->where('status', 'disetujui')
                    ->whereDate('tanggal_mulai', '<=', $today)
                    ->whereDate('tanggal_selesai', '>=', $today)
                    ->latest()
                    ->first();

                if ($permission) {

                    $item->status_hari_ini = $permission->kategori;

                } else {

                    // Toleransi sampai jam 09.00
                    if (Carbon::now()->format('H:i') < '09:00') {

                        $item->status_hari_ini = 'Belum Absen';

                    } else {

                        $item->status_hari_ini = 'Alpa';

                    }

                }
            }
        }

        return view(
            'pages.karyawan.anggota-divisi',
            compact('anggota', 'divisi')
        );
    }
}