<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Divisi user login
        $divisi = Divisi::with('ketua')->find($user->divisi_id);

        // Semua divisi (untuk admin)
        $divisis = Divisi::with('ketua')->orderBy('id')->get();

        // Semua karyawan
        $semuaKaryawan = User::all();

        // Hari libur
        $holidays = Holiday::orderBy('tanggal')->get();

        return view(
            'pages.jadwal',
            compact(
                'divisi',
                'divisis',
                'semuaKaryawan',
                'holidays'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_masuk_kerja' => 'required',
            'jam_pulang_kerja' => 'required',
        ]);

        $divisi = Divisi::findOrFail($id);

        $divisi->update([
            'jam_masuk_kerja' => $request->jam_masuk_kerja,
            'jam_pulang_kerja' => $request->jam_pulang_kerja,
        ]);

        return back()->with('success', 'Jadwal berhasil diperbarui.');
    }
    
}
