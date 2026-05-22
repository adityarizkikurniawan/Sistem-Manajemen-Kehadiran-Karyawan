@extends('layouts.app')

@section('title', 'Dashboard - Presensi Karyawan')

@section('content')
<div class="space-y-6">
    <div
        class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div
                class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-xl uppercase">
                {{ substr(Auth::user()->name, 0, 2) }}
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}</h1>
                
                <div class="flex gap-2 mt-1">
                    <span
                        class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded-md font-semibold uppercase tracking-wider">Role:
                        {{ Auth::user()->role }}</span>
                    <span
                        class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded-md font-semibold uppercase tracking-wider">Divisi :
                        {{ Auth::user()->Divisi }}</span>
                </div>
            </div>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">{{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
            <p class="text-2xl font-mono font-bold text-blue-600" id="clock">00:00:00</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 space-y-6">
            {{-- MENU KHUSUS ADMIN --}}
            @if(Auth::user()->role == 'admin')
            <div class="bg-white p-6 rounded-2xl border border-blue-100 shadow-sm shadow-blue-50 h-fit">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Panel Kontrol Admin
                </h3>
                <div class="space-y-3">
                    <a href="{{ route('karyawan.index') }}"
                        class="w-full flex items-center justify-between p-3 bg-blue-50 text-blue-700 rounded-xl font-semibold hover:bg-blue-100 transition border border-blue-100 group">
                        <span>Kelola Data Karyawan</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                    <a href="{{ route('rekap.index') }}"
                        class="w-full flex items-center justify-between p-3 bg-gray-50 text-gray-700 rounded-xl font-semibold hover:bg-gray-100 transition border border-gray-100 group">
                        <span>Rekap Absensi Semua</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
            @endif

            {{-- MENU PRESENSI (Muncul cuma buat Karyawan) --}}
            @if(Auth::user()->role == 'karyawan')
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-fit">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Presensi Hari Ini</h3>
                <div class="space-y-4">
                    <div class="flex flex-col gap-2">
                        @if(!$cek_absen_hari_ini)
                        {{-- FORM DENGAN GPS --}}
                        <form action="{{ route('presensi.store') }}" method="POST" id="formAbsen">
                            @csrf
                            {{-- Input tersembunyi untuk menyimpan koordinat --}}
                            <input type="hidden" name="location" id="locationInput">

                            <button type="button" onclick="getLocation()" id="btnAbsen"
                                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-xl transition flex items-center justify-center gap-2">
                                <span id="btnText">Check In (Masuk)</span>
                            </button>
                            <p id="statusLokasi" class="text-[10px] text-gray-400 mt-2 text-center italic">Izin lokasi
                                akan diminta saat tombol diklik</p>
                        </form>
                        @else
                        {{-- ... kode tombol disabled kamu ... --}}
                        @endifon>
                        @endif
                        <button class="w-full bg-gray-100 text-gray-400 font-bold py-3 rounded-xl cursor-not-allowed"
                            disabled>
                            Check Out (Pulang)
                        </button>
                    </div>
                </div>
            </div>
            @endif

            {{-- Peta Lokasi --}}
            <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
                {{-- ... kode peta kamu ... --}}
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="grid grid-cols-3 gap-4">
                @if(Auth::user()->role == 'admin')
                <div class="bg-blue-600 text-white p-4 rounded-2xl shadow-lg text-center">
                    <p class="text-xs opacity-80 uppercase">Total Hadir</p>
                    <p class="text-2xl font-bold">{{ $hadir_hari_ini }}</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-gray-100 text-center">
                    <p class="text-xs text-gray-400 uppercase">Izin Pending</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $izin_pending }}</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-gray-100 text-center">
                    <p class="text-xs text-gray-400 uppercase">Telat</p>
                    <p class="text-2xl font-bold text-red-600">{{ $terlambat }}</p>
                </div>
                @else
                <div class="bg-blue-600 text-white p-4 rounded-2xl shadow-lg text-center">
                    <p class="text-xs opacity-80 uppercase">Kehadiran Saya</p>
                    <p class="text-2xl font-bold">{{ $total_kehadiran }}</p>
                </div>
                @endif
            </div>

            {{-- Table Riwayat --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden text-sm">
                <div class="p-4 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800">
                        {{ Auth::user()->role == 'admin' ? 'Monitoring Kehadiran Terbaru' : 'Riwayat Presensi Saya' }}
                    </h3>
                </div>
                <table class="w-full">
                    <tbody class="divide-y divide-gray-50">
                        @php
                        $list = Auth::user()->role == 'admin' ? $recent_presences : $riwayat_absensi;
                        @endphp

                        @forelse($list as $presensi)
                        <tr class="hover:bg-gray-50 transition">
                            @if(Auth::user()->role == 'admin')
                            <td class="px-6 py-4 font-bold">
                                {{-- Admin bisa klik nama karyawan untuk lihat profil lengkap mereka --}}
                                <a href="{{ route('admin.user.profile', $presensi->user->id) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $presensi->user->name }}
                                </a>
                            </td>
                            @endif

                            <td class="px-6 py-4 text-gray-600">
                                {{ \Carbon\Carbon::parse($presensi->tanggal)->format('d M Y') }}
                            </td>

                            {{-- INI BAGIAN JAM MASUK --}}
                            <td class="px-6 py-4">
                                <span
                                    class="font-bold {{ $presensi->jam_masuk > '08:00:00' ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $presensi->jam_masuk ?? '--:--' }}
                                </span>
                                <span class="text-[10px] text-gray-400"> (Masuk)</span>
                            </td>

                            <td class="px-6 py-4">
                                @if($presensi->location)
                                <a href="https://www.google.com/maps?q={{ $presensi->location }}" target="_blank"
                                    class="text-blue-500 hover:text-blue-700 flex items-center gap-1 text-xs font-semibold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Lihat Lokasi
                                </a>
                                @else
                                <span class="text-gray-300 text-xs italic">Tanpa GPS</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-gray-400">
                                {{ $presensi->jam_pulang ?? '--:--' }} <span class="text-[10px]">(Pulang)</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-400">Belum ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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

function getLocation() {
    const status = document.getElementById('statusLokasi');
    const locationInput = document.getElementById('locationInput');
    const btn = document.getElementById('btnAbsen');
    const btnText = document.getElementById('btnText');

    if (!navigator.geolocation) {
        status.textContent = "Browser tidak mendukung GPS";
        return;
    }

    btn.disabled = true;
    btn.classList.replace('bg-green-500', 'bg-gray-400');
    btnText.textContent = "Mencari Lokasi...";
    status.textContent = "Menunggu koordinat satelit... ⏳";

    navigator.geolocation.getCurrentPosition(
        (position) => {
            const lat = position.coords.latitude;
            const long = position.coords.longitude;

            locationInput.value = lat + "," + long;

            status.textContent = "Lokasi terkunci! Mengirim data... ✅";
            status.style.color = "green";

            document.getElementById('formAbsen').submit();
        },
        (error) => {
            btn.disabled = false;
            btn.classList.replace('bg-gray-400', 'bg-green-500');
            btnText.textContent = "Check In (Masuk)";

            status.style.color = "red";
            if (error.code === 1) {
                status.textContent = "Gagal: Berikan izin lokasi di browser!";
            } else {
                status.textContent = "Gagal mengambil lokasi. Coba lagi.";
            }
            alert("Absen gagal karena lokasi tidak ditemukan.");
        }, {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}
</script>
@endsection