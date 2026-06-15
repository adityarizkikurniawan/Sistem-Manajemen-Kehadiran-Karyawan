<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Presensi;
use App\Models\User;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $presensi = Presensi::where('user_id', $user->id)->latest()->get();

        return view('pages.profil.index', compact('user', 'presensi'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $presensi = Presensi::where('user_id', $id)->latest()->get();
        
        return view('pages.profil.index', compact('user', 'presensi'));
    }

    public function export_pdf(Request $request)
    {
        $user = Auth::user();
        $bulanSekarang = \Carbon\Carbon::now()->month;
        $tahunSekarang = \Carbon\Carbon::now()->year;

        if ($user->role == 'admin') {
            $query = Presensi::with('user')
                ->whereMonth('tanggal', $bulanSekarang)
                ->whereYear('tanggal', $tahunSekarang);

            if ($request->has('filter_divisi') && $request->filter_divisi != '') {
                $query->whereHas('user', function($q) use ($request) {
                    $q->where('divisi', $request->filter_divisi);
                });
            }
            $dataPresensi = $query->latest('tanggal')->get();
        } else {
            $dataPresensi = Presensi::where('user_id', $user->id)
                ->whereMonth('tanggal', $bulanSekarang)
                ->whereYear('tanggal', $tahunSekarang)
                ->latest('tanggal')
                ->get();
        }

        // Kirim data ke view PDF di atas
        $pdf = \Pdf::loadView('exports.kehadiran_bulan_ini_pdf', compact('dataPresensi', 'bulanSekarang', 'tahunSekarang'));
        return $pdf->stream('Laporan_Presensi.pdf');
    }
}