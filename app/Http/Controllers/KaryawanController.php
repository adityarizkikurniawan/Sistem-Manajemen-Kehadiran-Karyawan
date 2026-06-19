<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KaryawanController extends Controller
{
    /**
     * Menampilkan halaman daftar karyawan (Dengan Fitur Filter)
     */
    public function index(Request $request)
    {
        // 1. Buat query dasar mengambil user ber-role karyawan
        $query = User::with('divisi')
             ->where('role', 'karyawan');

        // 2. Jika admin memilih filter divisi tertentu, saring datanya
        if ($request->has('filter_divisi') && $request->filter_divisi != '') {
            $query->whereHas('divisi', function ($q) use ($request) {
                 $q->where('nama_divisi', $request->filter_divisi);
            });
        }

        // 3. Urutkan dari yang terbaru dan batasi per halaman
        $karyawan = $query->latest()->paginate(20);

        // 4. Lempar data ke view index
        return view('pages.karyawan.index', compact('karyawan'));
    }

    /**
     * Menampilkan halaman form tambah karyawan baru
     */
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
            'password' => 'required|min:8',
            'divisi_id' => 'required|exists:divisis,id',
            'jenis_kelamin' => 'required',
            'status_pernikahan' => 'required',
        ]);

        // 2. Insert data ke tabel users
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'karyawan',
            'divisi_id' => $request->divisi_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_pernikahan' => $request->status_pernikahan,
        ]);

        // 3. Redirect kembali ke halaman utama
        return redirect()->route('karyawan.index')->with('success', 'Karyawan baru berhasil didaftarkan!'); 
    }

    /**
     * Mengunduh rekap data karyawan berdasarkan divisi dalam bentuk PDF
     */
    public function export(Request $request)
    {
        $query = User::where('role', 'karyawan');

        // Filter data berdasarkan divisi jika admin memilih divisi tertentu sebelum menekan tombol export
        if ($request->has('filter_divisi') && $request->filter_divisi != '') {
            $query->where('divisi', $request->filter_divisi);
        }

        $karyawan = $query->latest()->get();
        
        // Memproses file view cetak menggunakan DomPDF
        $pdf = Pdf::loadView('pages.karyawan.download_pdf', compact('karyawan', 'request'));
        return $pdf->download('Rekap_Karyawan_' . ($request->filter_divisi ?? 'Semua_Divisi') . '.pdf');
    }

    /**
     * Menghapus data karyawan dari database
     */
    public function destroy($id)
    {
        $user = User::where('role', 'karyawan')
                    ->findOrFail($id);

        $user->delete();

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus!');
    }
}