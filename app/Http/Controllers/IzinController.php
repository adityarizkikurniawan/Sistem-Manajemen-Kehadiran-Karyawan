<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role == 'admin') {
            // Admin melihat semua pengajuan izin
            $izins = Permission::with('user')->latest()->get();
        } else {
            // Karyawan cuma melihat izin MEREKA SENDIRI
            $izins = Permission::where('user_id', $user->id)->latest()->get();
        }
        

        return view('pages.izin', compact('izins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kategori' => 'required',
            'alasan' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('perizinan', 'public');
        }

        // Simpan ke database
        Permission::create([
            'user_id' => auth()->id(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kategori' => $request->kategori,
            'alasan' => $request->alasan,
            'status' => 'pending',
            'image' => $imagePath, // Tambahkan baris ini agar file tersimpan!
        ]);

        return redirect()->back()->with('success', 'Berhasil!');
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