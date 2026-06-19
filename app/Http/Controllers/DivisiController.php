<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        // Menampilkan daftar divisi dan siapa ketuanya
        $divisis = Divisi::with('ketua')->get();
        return view('admin.divisi.index', compact('divisis'));
    }

    public function edit($id)
    {
        $divisi = Divisi::findOrFail($id);
        // Ambil semua karyawan yang ada di divisi tersebut untuk dijadikan kandidat ketua
        $karyawan = User::where('divisi_id', $divisi->id)->get();
        return view('admin.divisi.edit', compact('divisi', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $divisi = Divisi::findOrFail($id);
        
        // Validasi input
        $request->validate([
            'ketua_id' => 'nullable|exists:users,id',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
        ]);

        $divisi->update([
            'ketua_id' => $request->ketua_id,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
        ]);
        
        return redirect()->back()->with('success', 'Data divisi berhasil diperbarui!');
    }
}
