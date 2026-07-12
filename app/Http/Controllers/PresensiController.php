<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;           
use Illuminate\Support\Facades\Auth; 
use App\Models\Presensi;
use App\Models\Divisi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PresensiController extends Controller
{
    // (Masuk)
    public function store(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $today = date('Y-m-d');
        $divisi = Divisi::find($user->divisi_id);

        $officeLat = 1.118967354315375;
        $officeLng = 104.04844545239081;

        $distance = $this->hitungJarak(
            $request->latitude,
            $request->longitude,
            $officeLat,
            $officeLng
        );

        if ($distance > 100000) {
            return back()->with('error', 'Anda berada di luar area presensi (' . round($distance, 2) . ' meter).');
        }

        $sudahAbsen = \App\Models\Presensi::where('user_id', $userId)
                                            ->where('tanggal', $today)
                                            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Kamu sudah melakukan absen masuk hari ini.');
        }
        $jamMasuk = Carbon::now();

        $status = $jamMasuk->gt(
            Carbon::createFromFormat('H:i:s', $divisi->jam_masuk_kerja)
        )
            ? 'Terlambat'
            : 'Hadir';

        Presensi::create([
            'user_id' => $userId,
            'divisi_id' => $divisi->id,
            'tanggal' => $today,

            'jam_masuk' => $jamMasuk->format('H:i:s'),

            'jam_masuk_seharusnya' => $divisi->jam_masuk_kerja,
            'jam_pulang_seharusnya' => $divisi->jam_pulang_kerja,

            'location' => $request->location,

            'keterangan' => $status,

            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'jarak' => round($distance, 2),
        ]);
        return back()->with('success', 'Berhasil melakukan absen hadir!');
    }

    public function update(Request $request, $id)
    {
        $presensi = Presensi::findOrFail($id);

        $presensi->update([
            'jam_pulang' => now()->format('H:i:s'),
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

    private function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a =
            sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) *
            cos(deg2rad($lat2)) *
            sin($dLon / 2) *
            sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}