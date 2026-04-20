<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;           
use Illuminate\Support\Facades\Auth; 
use App\Models\Presensi;               
use Barryvdh\DomPDF\Facade\Pdf;

class PresensiController extends Controller
{
public function exportPdf(Request $request)
{
    $userId = Auth::id();
    $bulan = $request->get('bulan', date('m')); 
    $tahun = date('Y');

    $dataPresensi = Presensi::where('user_id', $userId)
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->orderBy('tanggal', 'asc')
        ->get();
        
    $pdf = Pdf::loadView('exports.kehadiran_pdf', compact('dataPresensi', 'bulan', 'tahun'));
    
    return $pdf->download('Laporan_Kehadiran_Bulan_'.$bulan.'.pdf');
}
}