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
    private function hitungHariKerja($bulan, $tahun)
    {
        $jumlahHari = Carbon::create($tahun, $bulan)->daysInMonth;

        $hariKerja = 0;

        for ($i = 1; $i <= $jumlahHari; $i++) {

            $tanggal = Carbon::create($tahun, $bulan, $i);

            // Senin - Jumat
            if (!$tanggal->isWeekend()) {
                $hariKerja++;
            }
        }

        return $hariKerja;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $isKetua = false;
        $totalAnggotaDivisi = 0;

        if ($user->role == 'karyawan' && $user->divisi_id) {

            $divisiUser = Divisi::find($user->divisi_id);

            if ($divisiUser && $divisiUser->ketua_id == $user->id) {

                $isKetua = true;

                $totalAnggotaDivisi = User::where('divisi_id', $user->divisi_id)
                    ->where('role', 'karyawan')
                    ->count();
            }
        }

        $today = Carbon::today();   
        $bulanSekarang = Carbon::now()->month;
        $tahunSekarang = Carbon::now()->year;

        $user = Auth::user();

        if ($user->role == 'admin') {
            // --- DASHBOARD ADMIN ---

            $daftar_divisi = Divisi::all();

            // Ambil data presensi bulan ini
            $queryPresensi = Presensi::with('user')
                                    ->whereMonth('tanggal', $bulanSekarang)
                                    ->whereYear('tanggal', $tahunSekarang);

            // Filter berdasarkan divisi
            if ($request->filled('filter_divisi')) {
                $queryPresensi->whereHas('user', function ($q) use ($request) {
                    $q->where('divisi_id', $request->filter_divisi);
                });
            }

            $allDataBulanIni = $queryPresensi->get();

            // Hitung data untuk 3 Card & Chart
            $total_hadir = $allDataBulanIni
                ->where('keterangan', 'Hadir')
                ->count();

            $terlambat = $allDataBulanIni
                ->where('keterangan', 'Terlambat')
                ->count();
            
            $queryPermission = Permission::where('status', 'Disetujui')
                ->whereMonth('tanggal_mulai', $bulanSekarang)
                ->whereYear('tanggal_mulai', $tahunSekarang);

            if ($request->filled('filter_divisi')) {
                $queryPermission->whereHas('user', function ($q) use ($request) {
                    $q->where('divisi_id', $request->filter_divisi);
                });
            }

            $permissionBulanIni = $queryPermission->get();


            $izin = $permissionBulanIni
                ->where('kategori', 'Izin')
                ->count();

            $sakit = $permissionBulanIni
                ->where('kategori', 'Sakit')
                ->count();

            // Total hari kerja bulan ini
            $hariKerja = $this->hitungHariKerja($bulanSekarang, $tahunSekarang);

            // Jumlah karyawan
            $totalKaryawan = User::where('role', 'karyawan');

            if ($request->filled('filter_divisi')) {
                $totalKaryawan->where('divisi_id', $request->filter_divisi);
            }

            $totalKaryawan = $totalKaryawan->count();

            // Total kesempatan hadir
            $totalHariKerjaSemua = $hariKerja * $totalKaryawan;

            // Hitung alpa otomatis
            $alpa = max(
                0,
                $totalHariKerjaSemua
                - (
                    $total_hadir
                    + $terlambat
                    + $izin
                    + $sakit
                )
            );

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

            $divisi = Divisi::find($user->divisi_id);
            $jamMasukMaksimal = $divisi->jam_masuk_kerja;
            
            // Ambil data presensi karyawan
            $myDataBulanIni = Presensi::where('user_id', $user->id)
                                    ->whereMonth('tanggal', $bulanSekarang)
                                    ->whereYear('tanggal', $tahunSekarang)
                                    ->get();

            $total_hadir = $myDataBulanIni
                ->where('keterangan', 'Hadir')
                ->count();

            $terlambat = $myDataBulanIni
                ->where('keterangan', 'Terlambat')
                ->count();

            // Izin & sakit diambil dari tabel permission
            $permissionSaya = Permission::where('user_id', $user->id)
                ->where('status', 'Disetujui')
                ->whereMonth('tanggal_mulai', $bulanSekarang)
                ->whereYear('tanggal_mulai', $tahunSekarang)
                ->get();

            $izin = $permissionSaya
                ->where('kategori', 'Izin')
                ->count();

            $sakit = $permissionSaya
                ->where('kategori', 'Sakit')
                ->count();

            // Hari kerja bulan ini
            $hariKerja = $this->hitungHariKerja($bulanSekarang, $tahunSekarang);

            // Hitung alpa otomatis
            $alpa = max(
                0,
                $hariKerja
                - (
                    $total_hadir
                    + $terlambat
                    + $izin
                    + $sakit
                )
            );
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
                'cek_absen_hari_ini' => Presensi::where('user_id', $user->id)
                ->whereDate('tanggal', $today)
                ->latest('id')
                ->first(),
                
                'card_total_hadir'   => $card_total_hadir,
                'terlambat'          => $terlambat,
                'persentase_tidak_masuk' => $persentase_tidak_masuk,
                'total_hadir'        => $total_hadir,
                'izin'               => $izin,
                'sakit'              => $sakit,
                'alpa'               => $alpa,
                'isKetua'            => $isKetua,
                'totalAnggotaDivisi' => $totalAnggotaDivisi,
            ];

            return view('pages.dashboard', $data);
        }
    }
}