@extends('layouts.app')

@section('title', 'Dashboard - Presensi Karyawan')

@section('content')
<div class="space-y-10">

    <div
        class="relative overflow-hidden rounded-3xl bg-slate-900 border border-white/5 flex flex-col lg:flex-row min-h-[350px] shadow-2xl">

        <div class="w-full lg:w-1/2 p-10 flex flex-col justify-center">
            <div class="space-y-1 mb-8">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Selamat Datang, {{ Auth::user()->name }}!
                </h2>
                <p class="text-slate-400 text-sm">
                    @if(Auth::user()->role == 'admin')
                    Panel Kendali Administrasi Sistem Presensi Karyawan.
                    @else
                    Silakan catat kehadiran Anda untuk hari ini.
                    @endif
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                {{-- TAMPILAN JIKA YANG LOGIN KARYAWAN --}}
                @if(Auth::user()->role == 'karyawan')
                @if(!$cek_absen_hari_ini)
                <form action="{{ route('presensi.store') }}" method="POST" id="formAbsen" class="flex-1">
                    @csrf
                    <input type="hidden" name="location" id="locationInput">
                    <input type="hidden" name="latitude" id="latitudeInput">
                    <input type="hidden" name="longitude" id="longitudeInput">
                    <input type="hidden" name="jarak" id="jarakInput">
                    <button type="button" onclick="getLocation()" id="btnAbsen"
                        class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-2xl transition duration-300 flex items-center justify-center gap-3 shadow-lg shadow-blue-600/20 transform hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span id="btnText">CHECK IN</span>
                    </button>
                </form>
                @else
                @if($cek_absen_hari_ini->keterangan == 'Terlambat')
                <div
                    class="flex-1 bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 font-bold py-4 rounded-2xl text-center flex items-center justify-center gap-2">
                    <svg class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4l3 3" />
                    </svg>
                    HADIR TERLAMBAT
                </div>
                @else

                <div
                    class="flex-1 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold py-4 rounded-2xl text-center flex items-center justify-center gap-2">
                    <svg class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                    SUDAH HADIR
                </div>
                @endif
                @endif

                @if($cek_absen_hari_ini && !$cek_absen_hari_ini->jam_pulang)
                <form action="{{ route('presensi.update', $cek_absen_hari_ini->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-500 text-white font-bold py-4 rounded-2xl transition duration-300">
                        CHECK OUT
                    </button>
                </form>

                @else
                <button
                    class="flex-1 bg-white/5 text-white/20 font-bold py-4 rounded-2xl cursor-not-allowed border border-white/5"
                    disabled>
                    CHECK OUT
                </button>
                @endif
                @endif

                {{-- TOMBOL AKSES ADMIN (MUNCUL JIKA YANG LOGIN ADMIN) --}}
                @if(Auth::user()->role == 'admin')
                <div class="flex-1 flex flex-col gap-3 w-full">
                    <a href="{{ route('karyawan.create') }}"
                        class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-2xl transition duration-300 flex items-center justify-center gap-3 shadow-lg shadow-blue-600/20 transform hover:-translate-y-1 text-center text-xs uppercase tracking-wider">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        TAMBAH KARYAWAN BARU
                    </a>

                    <a href="{{ route('karyawan.index') }}"
                        class="w-full bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold py-4 rounded-2xl transition duration-300 flex items-center justify-center gap-3 border border-slate-700 shadow-lg transform hover:-translate-y-1 text-center text-xs uppercase tracking-wider">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        KELOLA DATA KARYAWAN
                    </a>
                </div>
                @endif
            </div>

            <div class="mt-6 flex items-center gap-4">
                <div class="text-left">
                    <p class="text-[10px] text-slate-500 uppercase tracking-[0.2em] font-bold">Waktu Server</p>
                    <p class="text-xl font-mono font-bold text-blue-500" id="clock">00:00:00</p>
                </div>

                @if(Auth::user()->role == 'karyawan')
                <div class="h-8 w-[1px] bg-white/10"></div>
                    <div class="space-y-1">
                        <p id="statusLokasi"
                        class="text-[11px] text-slate-400 font-semibold">
                        GPS belum aktif.
                        </p>

                        <p id="jarakLokasi"
                        class="text-[10px] text-slate-500">
                        Jarak ke kantor : -
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="hidden lg:block w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 z-10 bg-gradient-to-r from-slate-900 via-slate-900/40 to-transparent"></div>
            <img src="https://www.polibatam.ac.id/wp-content/uploads/2023/02/DSC_3736-1-1024x683.jpg"
                class="h-full w-full object-cover grayscale-[20%] brightness-75" alt="Office Background">
        </div>
    </div>

    @if(isset($isKetua) && $isKetua)
    <div class="rounded-3xl bg-gradient-to-r from-slate-800 to-slate-600 p-6 text-white shadow-xl">
        <div class="flex justify-between items-center">
            <div>

                <span class="uppercase text-xs tracking-[0.25em] font-bold">
                    👑 Dashboard Ketua Divisi
                </span>

                <h2 class="text-2xl font-bold mt-2">
                    {{ auth()->user()->divisi->nama_divisi }}
                </h2>

                <p class="mt-2 text-blue-100">
                    Total Anggota :
                    <b>{{ $totalAnggotaDivisi }}</b>
                </p>
            </div>

            <a href="{{ route('anggota.divisi') }}"
                class="bg-white text-blue-700 font-bold px-6 py-3 rounded-xl hover:bg-blue-50 transition">

                👥 Lihat Anggota

            </a>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Card 1: Kehadiran --}}
        <div
            class="bg-white border border-slate-100 p-8 rounded-3xl shadow-sm hover:shadow-md hover:border-blue-500/30 transition duration-300 group">
            <p
                class="text-[11px] font-black text-blue-600 uppercase tracking-[0.2em] group-hover:text-blue-500 transition">
                Total Kehadiran Bulan ini
            </p>
            <h3 class="text-4xl font-black text-slate-800 mt-4 tracking-tight">
                {{ $total_hadir ?? 0 }}
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider ml-1">Hari</span>
            </h3>
        </div>

        {{-- Card 2: Terlambat --}}
        <div
            class="bg-white border border-slate-100 p-8 rounded-3xl shadow-sm hover:shadow-md hover:border-rose-500/30 transition duration-300 group">
            <p
                class="text-[11px] font-black text-rose-600 uppercase tracking-[0.2em] group-hover:text-rose-500 transition">
                Total Terlambat Bulan ini
            </p>
            <h3 class="text-4xl font-black text-slate-800 mt-4 tracking-tight">
                {{ $terlambat ?? 0 }}
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider ml-1">Kali</span>
            </h3>
        </div>

        {{-- Card 3: Persentase Tidak Hadir --}}
        <div
            class="bg-white border border-slate-100 p-8 rounded-3xl shadow-sm hover:shadow-md hover:border-amber-500/30 transition duration-300 group">
            <p
                class="text-[11px] font-black text-amber-600 uppercase tracking-[0.2em] group-hover:text-amber-500 transition">
                Total Alpa Bulan Ini
            </p>

            <h3 class="text-4xl font-black text-slate-800 mt-4 tracking-tight">
                {{ $alpa ?? 0 }}
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider ml-1">Hari</span>
            </h3>
        </div>
    </div>

    <div class="bg-gradient-to-r from-slate-400 to-slate-300 p-8 rounded-3xl shadow-2xl mt-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="text-[15px] font-black text-blue-800 uppercase tracking-[0.2em]">Visualisasi Data</span>
                <h3 class="text-xl font-bold text-white mt-1">Analisis Kehadiran</h3>
            </div>

            <div class="flex gap-4 text-[10px] font-bold text-slate-500">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-blue-500"></div> REAL-TIME DATA
                </div>
            </div>
        </div>

        <div class="relative w-full h-[300px]">
            <canvas id="mainAttendanceChart"></canvas>
        </div>
    </div>

    <!-- TABEL RIWAYAT & FILTER (DIJADIKAN SATU DIV CONTAINER UTAMA) -->
    <div class="bg-slate-900 rounded-3xl border border-white/5 shadow-2xl overflow-hidden">

        {{-- 1. BAGIAN FILTER DATA REKAP (HANYA UNTUK ADMIN) --}}
        @if(Auth::user()->role == 'admin')
        <div
            class="p-8 border-b border-white/5 bg-white/[0.01] flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h4 class="text-xs font-black text-white uppercase tracking-wider">Filter Data Rekap</h4>
                <p class="text-[10px] text-slate-400 mt-1">Tampilkan statistik dan riwayat kehadiran berdasarkan divisi
                </p>
            </div>

            <form action="{{ route('dashboard') }}" method="GET" class="flex flex-wrap items-center gap-2">
                <select name="filter_divisi"
                    class="min-w-[200px] rounded-xl border border-white/10 bg-slate-800/80 px-4 py-2.5 text-xs font-bold text-slate-300 focus:border-blue-500 focus:outline-none">

                    <option value="">-- Semua Divisi --</option>

                    @foreach ($daftar_divisi as $divisi)
                    <option value="{{ $divisi->id }}" {{ request('filter_divisi') == $divisi->id ? 'selected' : '' }}>
                        {{ strtoupper($divisi->nama_divisi) }}
                    </option>
                    @endforeach

                </select>

                <button type="submit"
                    class="rounded-xl bg-blue-600 px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500">
                    Filter
                </button>

                @if (request()->filled('filter_divisi'))
                <a href="{{ route('dashboard') }}"
                    class="rounded-xl bg-white/10 px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-slate-200 transition hover:bg-white/20">
                    Reset
                </a>
                @endif
            </form>
            
        </div>
        @endif

        {{-- 2. HEADER RIWAYAT PRESENSI --}}
        <div
            class="p-8 border-b border-white/5 flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white/[0.02] gap-4">
            <div>
                <h3 class="font-bold text-white uppercase tracking-widest text-xs">Riwayat Presensi Bulan ini</h3>
                <p class="text-[10px] text-slate-500 mt-1 uppercase tracking-tighter">Data berdasarkan log sistem PBL
                    Team</p>
            </div>
            <a href="{{ route('profil.export_pdf', ['filter_divisi' => request('filter_divisi')]) }}" target="_blank"
                class="px-4 py-2 bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white rounded-xl text-xs font-black tracking-wider uppercase transition flex items-center gap-2 border border-red-500/20 shadow-lg shadow-red-500/5">
                Export PDF Bulan Ini
            </a>
        </div>

        {{-- 3. STRUKTUR DATA TABEL --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead
                    class="bg-white/[0.01] text-[10px] text-slate-500 font-black uppercase tracking-[0.2em] border-b border-white/5">
                    <tr>
                        {{-- KONDISI KHUSUS ADMIN: TAMBAH KOLOM NAMA & DIVISI --}}
                        @if(Auth::user()->role == 'admin')
                        <th class="px-8 py-5">Karyawan</th>
                        <th class="px-8 py-5">Divisi</th>
                        @endif

                        <th class="px-8 py-5">Tanggal</th>
                        <th class="px-8 py-5">Jam Masuk</th>
                        <th class="px-8 py-5">Jam Pulang</th>
                        <th class="px-8 py-5 text-right">Lokasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @php $list = Auth::user()->role == 'admin' ? $recent_presences : $riwayat_absensi; @endphp
                    @forelse($list as $presensi)
                    <tr class="hover:bg-white/[0.02] transition group">

                        {{-- KONDISI KHUSUS ADMIN: TAMPILKAN DATA NAMA & DIVISI KARYAWAN --}}
                        @if(Auth::user()->role == 'admin')
                        <td class="px-8 py-6">
                            <p class="text-white font-bold tracking-wide">
                                {{ $presensi->user->name ?? 'User Terhapus' }}
                            </p>
                        </td>
                        <td class="px-8 py-6">
                            <span
                                class="inline-flex items-center px-2.5 py-1 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-black rounded-md uppercase tracking-wider">
                                {{ strtoupper($presensi->user->divisi?->nama_divisi ?? 'Belum Set') }}
                            </span>
                        </td>
                        @endif

                        <td class="px-8 py-6">
                            <p class="text-white font-medium">
                                {{ \Carbon\Carbon::parse($presensi->tanggal)->translatedFormat('d M Y') }}
                            </p>
                        </td>
                        <td class="px-8 py-6">
                            <span
                                class="px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 font-mono font-bold border border-blue-500/10">
                                {{ $presensi->jam_masuk ?? '--:--' }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-slate-400 font-mono">
                            {{ $presensi->jam_pulang ?? '--:--' }}
                        </td>
                        <td class="px-8 py-6 text-right">
                            @if($presensi->location)
                            <a href="https://maps.google.com/?q={{ $presensi->location }}" target="_blank"
                                class="text-[10px] font-black text-blue-500 border-b border-blue-500/20 hover:border-blue-500 transition">
                                MAPS VIEW
                            </a>
                            @else
                            <span class="text-[10px] text-slate-600 font-bold uppercase italic tracking-tighter">No
                                Signal</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role == 'admin' ? '6' : '4' }}" class="px-8 py-20 text-center">
                            <p class="text-slate-600 font-bold uppercase tracking-widest text-xs">Belum ada aktivitas
                                terekam</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function updateClock() {
    const now = new Date();
    document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID');
}
setInterval(updateClock, 1000);
updateClock();

const OFFICE_LAT = 1.118967354315375;
const OFFICE_LNG = 104.04844545239081;
const MAX_RADIUS = 100000;

function deg2rad(deg){
    return deg * (Math.PI/180);
}

function hitungJarak(lat1, lon1, lat2, lon2){

    const R = 6371000;

    const dLat = deg2rad(lat2-lat1);
    const dLon = deg2rad(lon2-lon1);

    const a =
        Math.sin(dLat/2)*Math.sin(dLat/2)+
        Math.cos(deg2rad(lat1))*
        Math.cos(deg2rad(lat2))*
        Math.sin(dLon/2)*
        Math.sin(dLon/2);

    const c = 2*Math.atan2(Math.sqrt(a),Math.sqrt(1-a));

    return R*c;
}

function getLocation(){

    const status=document.getElementById("statusLokasi");
    const jarak=document.getElementById("jarakLokasi");

    const btn=document.getElementById("btnAbsen");
    const btnText=document.getElementById("btnText");

    if(!navigator.geolocation){

        status.innerHTML="❌ Browser tidak mendukung GPS";

        return;
    }

    btn.disabled=true;

    btnText.innerHTML="MENCARI GPS...";

    status.innerHTML="📍 Mengambil lokasi...";

    navigator.geolocation.getCurrentPosition(

        function(position){

            const lat=position.coords.latitude;
            const lng=position.coords.longitude;

            const distance=hitungJarak(
                lat,
                lng,
                OFFICE_LAT,
                OFFICE_LNG
            );

            document.getElementById("latitudeInput").value=lat;
            document.getElementById("longitudeInput").value=lng;
            document.getElementById("locationInput").value=lat+","+lng;
            document.getElementById("jarakInput").value=distance.toFixed(2);

            jarak.innerHTML="Jarak : "+distance.toFixed(2)+" meter";

            if(distance<=MAX_RADIUS){

                status.innerHTML="🟢 Dalam Radius Kantor";

                btnText.innerHTML="CHECK IN";

                document.getElementById("formAbsen").submit();

            }else{

                status.innerHTML="🔴 Di luar radius kantor";

                btn.disabled=false;

                btnText.innerHTML="CHECK IN";

                alert(
                    "Anda berada "+
                    distance.toFixed(2)+
                    " meter dari kantor.\nRadius maksimal 20 meter."
                );

            }

        },

        function(){

            btn.disabled=false;

            btnText.innerHTML="CHECK IN";

            status.innerHTML="❌ GPS gagal didapat.";

        },

        {
            enableHighAccuracy:true,
            timeout:10000,
            maximumAge:0
        }

    );

}
</script>

<div style="display:none">
{{ $total_hadir }}
{{ $terlambat }}
{{ $izin }}
{{ $sakit }}
{{ $alpa }}
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('mainAttendanceChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Hadir', 'Terlambat', 'Izin', 'Sakit', 'Alpa'],
            datasets: [{
                label: 'Total Record',
                data: [
                    {{ $total_hadir ?? 0 }},
                    {{ $terlambat ?? 0 }},
                    {{ $izin ?? 0 }},
                    {{ $sakit ?? 0 }},
                    {{ $alpa ?? 0 }}
                ],

                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: '#3b82f6',
                borderWidth: 2,
                hoverBackgroundColor: '#2563eb',
                borderRadius: 6,
                barThickness: 35
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    min: 0,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)', 
                        drawBorder: false
                    },
                    ticks: {
                        color: '#64748b',
                        font: {
                            family: 'sans-serif',
                            size: 11
                        },
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#475569', 
                        font: {
                            weight: 'bold',
                            size: 11
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection