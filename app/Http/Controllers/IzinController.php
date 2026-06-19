<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IzinController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $izins = Permission::with('user.divisi')
                ->latest()
                ->get();
        } else {
            $izins = Permission::with('user.divisi')
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        }

        return view('pages.izin', compact('izins'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kategori' => 'required',
            'alasan' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $mulai = Carbon::parse($request->tanggal_mulai);
        $selesai = Carbon::parse($request->tanggal_selesai);
        $durasi = abs($selesai->diffInDays($mulai)) + 1;

        // Logika Validasi Berdasarkan Kategori
        switch ($request->kategori) {
            case 'Cuti Melahirkan':
                if ($user->jenis_kelamin == 'Perempuan' && $durasi > 90) {
                    return back()->withErrors(['tanggal_selesai' => 'Maksimal cuti melahirkan 90 hari.']);
                } 
                if ($user->jenis_kelamin == 'Laki-laki' && $durasi > 3) {
                    return back()->withErrors(['tanggal_selesai' => 'Maksimal cuti pendampingan 3 hari.']);
                }
                break;

            case 'Cuti Khusus':
                if ($durasi > 4) {
                    return back()->withErrors(['tanggal_selesai' => 'Maksimal cuti khusus 4 hari.']);
                }
                break;

            case 'Cuti Duka':
                if ($durasi > 2) {
                    return back()->withErrors(['tanggal_selesai' => 'Maksimal cuti duka 2 hari.']);
                }
                break;
        }

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('perizinan', 'public') : null;

        Permission::create([
            'user_id' => $user->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kategori' => $request->kategori,
            'alasan' => $request->alasan,
            'status' => 'pending',
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Pengajuan izin berhasil dikirim!');
    }

    public function updateStatus(Request $request, $id)
    {
        // Cuma Admin yang boleh akses ini
        if (Auth::user()->role !== 'admin') {
            return abort(403);
        }

        $izin = Permission::findOrFail($id);
        $izin->update(['status' => $request->status]);

        return back()->with('success', 'Status izin diperbarui!');
    }
}