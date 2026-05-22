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
            // Admin melihat SEMUA pengajuan izin
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
            'tanggal' => 'required|date',
            'kategori' => 'required',
            'alasan' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('bukti_izin', 'public');
        }

        Permission::create([
            'user_id' => \Auth::id(),
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'alasan' => $request->alasan,
            'image' => $path,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Izin dan bukti berhasil dikirim!');
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