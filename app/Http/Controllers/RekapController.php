<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 

class RekapController extends Controller
{
    public function index()
    {
        $semua_presensi = Presensi::with('user')->latest('tanggal')->get();

        return view('pages.rekap.index', compact('semua_presensi'));
    }

    public function exportSemuaPdf()
    {
        $rekap = User::where('role', 'karyawan')->get()->map(function($user) {
            return [
                'nama'  => $user->name,
                'hadir' => Presensi::where('user_id', $user->id)->where('keterangan', 'Hadir')->count(),
                'izin'  => \App\Models\Permission::where('user_id', $user->id)->where('status', 'disetujui')->count(),
            ];
        });

        $pdf = Pdf::loadView('pages.rekap.pdf', compact('rekap'));
        
        return $pdf->download('Laporan_Ringkasan_Karyawan.pdf');
    }
}