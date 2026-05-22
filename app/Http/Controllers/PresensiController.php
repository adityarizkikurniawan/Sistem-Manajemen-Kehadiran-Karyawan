<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;           
use Illuminate\Support\Facades\Auth; 
use App\Models\Presensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PresensiController extends Controller
{
    // FUNGSI UNTUK CHECK-IN (Masuk)
    public function store(Request $request)
    {
        $userId = auth()->id();
        $today = date('Y-m-d');

        // 2. Cek apakah sudah absen hari ini (Biar ga double)
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

    // EXPORT PDF
    public function exportPdf(Request $request)
    {
        $userId = Auth::id();
        $bulan = $request->get('bulan', date('m')); 
        $tahun = date('Y');

        // Catatan: Pastikan nama kolom 'date' atau 'tanggal' konsisten dengan DB
        $dataPresensi = Presensi::where('user_id', $userId)
            ->whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->orderBy('date', 'asc')
            ->get();
            
        $pdf = Pdf::loadView('exports.kehadiran_pdf', compact('dataPresensi', 'bulan', 'tahun'));
        
        return $pdf->download('Laporan_Kehadiran_Bulan_'.$bulan.'.pdf');
    }
}