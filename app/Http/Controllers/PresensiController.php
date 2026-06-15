<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;           
use Illuminate\Support\Facades\Auth; 
use App\Models\Presensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PresensiController extends Controller
{
    // (Masuk)
    public function store(Request $request)
    {
        $userId = auth()->id();
        $today = date('Y-m-d');

        $sudahAbsen = \App\Models\Presensi::where('user_id', $userId)
                                            ->where('tanggal', $today)
                                            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Kamu sudah melakukan absen masuk hari ini.');
        }

        \App\Models\Presensi::create([
            'user_id'    => $userId,
            'tanggal'    => $today,
            'jam_masuk'  => date('H:i:s'),
            'location'   => $request->location,
            'keterangan' => 'Hadir',
        ]);

        return back()->with('success', 'Berhasil melakukan absen hadir!');
    }

    public function update(Request $request, $id)
    {
        $presensi = Presensi::findOrFail($id);
        
        $presensi->update([
            'time_out' => Carbon::now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Berhasil Check-out! Hati-hati di jalan.');
    }

    // EXPORT PDF (Bulan Ini)
    public function exportPdf(Request $request)
    {
        $user = Auth::user();

        $bulanSekarang = \Carbon\Carbon::now()->month;
        $tahunSekarang = \Carbon\Carbon::now()->year;

        if ($user->role == 'admin') {

            $dataPresensi = Presensi::whereMonth('tanggal', $bulanSekarang)
                                ->whereYear('tanggal', $tahunSekarang)
                                ->orderBy('tanggal', 'asc')
                                ->get();
        } else {

            $dataPresensi = Presensi::where('user_id', $user->id)
                                ->whereMonth('tanggal', $bulanSekarang)
                                ->whereYear('tanggal', $tahunSekarang)
                                ->orderBy('tanggal', 'asc')
                                ->get();
        }
            
        $pdf = Pdf::loadView('exports.kehadiran_bulan_ini_pdf', compact('dataPresensi', 'bulanSekarang', 'tahunSekarang'));
        
        return $pdf->stream('Laporan_Presensi_Bulan_'.$bulanSekarang.'_'.$tahunSekarang.'.pdf');
    }
}