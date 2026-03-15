<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        // Simulasi data kehadiran karyawan
        $dataKehadiran = [
            ['nama' => 'Samuel Ambar Pasaribu', 'jam_masuk' => '08:00', 'status' => 'Tepat Waktu'],
            ['nama' => 'Muhammad Khairul Farhan', 'jam_masuk' => '08:15', 'status' => 'Terlambat'],
            ['nama' => 'Aditya Rizki Kurniawan', 'jam_masuk' => '07:55', 'status' => 'Tepat Waktu'],
        ];

        return view('presensi.index', compact('dataKehadiran'));
    }
}