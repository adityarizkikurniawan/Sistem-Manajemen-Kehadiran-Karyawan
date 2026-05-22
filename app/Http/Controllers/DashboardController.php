<?php

namespace App\Http\Controllers;

use App\Models\Presensi; 
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        if ($user->role == 'admin') {
                // Dashboard Admin
                $data = [
                    'total_karyawan' => User::where('role', 'karyawan')->count(),
                    'hadir_hari_ini' => Presensi::whereDate('tanggal', $today)->where('keterangan', 'Hadir')->count(),
                    'izin_pending'   => Permission::where('status', 'pending')->count(),
                    'terlambat'      => Presensi::whereDate('tanggal', $today)->where('jam_masuk', '>', '08:00:00')->count(),
                    'recent_presences' => Presensi::with('user')->latest()->take(5)->get()
                ];
                return view('pages.dashboard', $data);
            }
  
        else {
            // Dashboard Karyawan
            $data = [
                'riwayat_absensi' => Presensi::where('user_id', $user->id)->latest()->take(5)->get(),
                'total_kehadiran' => Presensi::where('user_id', $user->id)->where('keterangan', 'Hadir') ->count(),
                'cek_absen_hari_ini' => Presensi::where('user_id', $user->id)->whereDate('tanggal', $today)->first()
            ];
            return view('pages.dashboard', $data);
        }
    }
}