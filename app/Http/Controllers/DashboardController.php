<?php

namespace App\Http\Controllers;

use App\Models\Presensi; 
use App\Models\Permission;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();   
        $bulanSekarang = Carbon::now()->month;
        $tahunSekarang = Carbon::now()->year;

        // Batas toleransi jam masuk terlambat
        $jamMasukMaksimal = '08:00:00'; 

        if ($user->role == 'admin') {
            // --- DASHBOARD ADMIN ---

            $daftar_divisi = Divisi::all();

            // Ambil data presensi bulan ini
            $queryPresensi = Presensi::with('user')
                                    ->whereMonth('tanggal', $bulanSekarang)
                                    ->whereYear('tanggal', $tahunSekarang);

            // Filter berdasarkan divisi
            if ($request->has('filter_divisi') && $request->filter_divisi != '') {
                $queryPresensi->whereHas('user', function($q) use ($request) {
                    $q->where('divisi', $request->filter_divisi);
                });
            }

            $allDataBulanIni = $queryPresensi->get();

            // Hitung data untuk 3 Card & Chart
            $total_hadir = $allDataBulanIni->where('keterangan', 'Hadir')->count();
            $terlambat   = $allDataBulanIni->where('keterangan', 'Hadir')->where('jam_masuk', '>', $jamMasukMaksimal)->count();
            $izin        = $allDataBulanIni->where('keterangan', 'Izin')->count();
            $sakit       = $allDataBulanIni->where('keterangan', 'Sakit')->count();
            $alpa        = $allDataBulanIni->where('keterangan', 'Alpa')->count();

            $card_total_hadir = $total_hadir + $terlambat;
            $total_tidak_masuk = $izin + $sakit + $alpa;
            $total_semua_log   = $allDataBulanIni->count();
            $persentase_tidak_masuk = $total_semua_log > 0 ? round(($total_tidak_masuk / $total_semua_log) * 100, 1) : 0;

            $data = [
                'total_karyawan'   => User::where('role', 'karyawan')->count(),
                'recent_presences' => $queryPresensi->latest('tanggal')->paginate(30)->withQueryString(),
                'daftar_divisi'    => $daftar_divisi,
                'divisi_terpilih'  => $request->filter_divisi,
                
                'card_total_hadir' => $card_total_hadir,
                'terlambat'        => $terlambat,
                'persentase_tidak_masuk' => $persentase_tidak_masuk,
                'total_hadir'      => $total_hadir,
                'izin'             => $izin,
                'sakit'            => $sakit,
                'alpa'             => $alpa,
            ];

            return view('pages.dashboard', $data);

        } else {
            // --- DASHBOARD KARYAWAN  ---
            
            // Ambil data presensi karyawan
            $myDataBulanIni = Presensi::where('user_id', $user->id)
                                    ->whereMonth('tanggal', $bulanSekarang)
                                    ->whereYear('tanggal', $tahunSekarang)
                                    ->get();

            $total_hadir = $myDataBulanIni->where('keterangan', 'Hadir')->where('jam_masuk', '<=', $jamMasukMaksimal)->count();
            $terlambat   = $myDataBulanIni->where('keterangan', 'Hadir')->where('jam_masuk', '>', $jamMasukMaksimal)->count();
            $izin        = $myDataBulanIni->where('keterangan', 'Izin')->count();
            $sakit       = $myDataBulanIni->where('keterangan', 'Sakit')->count();
            $alpa        = $myDataBulanIni->where('keterangan', 'Alpa')->count();

            // Hitung total 3 chart
            $card_total_hadir = $total_hadir + $terlambat;
            $total_tidak_masuk = $izin + $sakit + $alpa;
            $total_semua_log   = $myDataBulanIni->count();
            $persentase_tidak_masuk = $total_semua_log > 0 ? round(($total_tidak_masuk / $total_semua_log) * 100, 1) : 0;

            $data = [
                'riwayat_absensi'    => Presensi::where('user_id', $user->id)
                                            ->whereMonth('tanggal', $bulanSekarang)
                                            ->whereYear('tanggal', $tahunSekarang)
                                            ->latest('tanggal')
                                            ->paginate(30),
                'cek_absen_hari_ini' => Presensi::where('user_id', $user->id)->whereDate('tanggal', $today)->first(),
                
                'card_total_hadir'   => $card_total_hadir,
                'terlambat'          => $terlambat,
                'persentase_tidak_masuk' => $persentase_tidak_masuk,
                'total_hadir'        => $total_hadir,
                'izin'               => $izin,
                'sakit'              => $sakit,
                'alpa'               => $alpa,
            ];

            return view('pages.dashboard', $data);
        }
    }
}