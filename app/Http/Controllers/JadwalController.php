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
        $karyawan = User::where('role', 'karyawan')
        ->orderBy('name')
        ->get();

        // Hari libur
        $holidays = Holiday::orderBy('tanggal')->get();

        return view(
            'pages.jadwal',
                compact(
                    'divisi',
                    'divisis',
                    'karyawan',
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
    
    public function setKetua(Request $request)
    {
        $request->validate([
            'divisi_id' => 'required|exists:divisis,id',
            'ketua_id'  => 'nullable|exists:users,id',
        ]);

        $divisi = Divisi::findOrFail($request->divisi_id);

        $divisi->update([
            'ketua_id' => $request->ketua_id
        ]);

        return back()->with('success', 'Ketua divisi berhasil diperbarui.');
    }
}
