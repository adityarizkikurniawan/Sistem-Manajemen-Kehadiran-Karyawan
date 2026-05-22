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

    public function exportPdf()
    {
        $user = auth()->user();
        $presensi = Presensi::where('user_id', $user->id)->latest()->get();

        $pdf = Pdf::loadView('exports.kehadiran_pdf', compact('user', 'presensi'));

        return $pdf->download('Rekap_Kehadiran_' . $user->name . '.pdf');
    }
}