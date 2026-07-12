<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Profil pengguna yang sedang login
     */
    public function index()
    {
        $user = Auth::user()->load('divisi');

        return view('pages.profile', compact('user'));
    }

    /**
     * Detail profil karyawan (dipakai nanti dari Data Karyawan)
     */
    public function show($id)
    {
        
        return view('pages.profile', compact('user'));
        $user = User::with('divisi')->findOrFail($id);
    }

    /**
     * Ubah password akun yang sedang login
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ],[
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        if (Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password baru tidak boleh sama dengan password lama.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }

}
