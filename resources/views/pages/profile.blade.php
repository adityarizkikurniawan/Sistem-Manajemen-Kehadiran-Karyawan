@extends('layouts.app')

@section('title', 'Profil Karyawan')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 h-40"></div>

        <div class="px-8 pb-10">
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
                                {{-- Tambahkan info divisi jika ada di database --}}
                            </div>
                        </div>
                    </div>
                </div>
            <hr class="my-8 border-gray-100">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                @if(Auth::user()->role == 'admin')
                <div class="lg:col-span-2 space-y-8">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Perusahaan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Email Perusahaan</p>
                            <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">ark@perusahaan.com</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Nomor WhatsApp</p>
                            <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">+62 822-8680-3782</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Tempat, Tanggal Didirikan
                            </p>
                            <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">Batam, 20 Mei 2006</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Alamat Domisili Perusahaan</p>
                            <p class="text-gray-700 font-medium">Jl. Trans Barelang, Taman cipta asri 2 Blok Pinus No.36
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::user()->role == 'karyawan')
                <div class="lg:col-span-2 space-y-8">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Data Karyawan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Email</p>
                            <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">samuel123@perusahaan.com</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Nomor WhatsApp</p>
                            <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">+62 822-8680-3782</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Tempat, Tanggal lahir
                            </p>
                            <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">Batam, 20 Mei 2006</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Alamat Domisili</p>
                            <p class="text-gray-700 font-medium">Jl. Trans Barelang, Taman cipta asri 2 Blok Pinus No.36
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::user()->role == 'admin')
                <div class="bg-gray-50/50 p-6 rounded-3xl border border-gray-100 flex flex-col items-center">
                    <h3 class="text-sm font-bold text-gray-700 mb-6 uppercase tracking-widest">Total Statistik Kehadiran Karyawan</h3>

                    <div class="relative w-full h-64">
                        <canvas id="presenceChart"></canvas>
                    </div>

                    <div class="mt-6 w-full space-y-2">
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                Hadir</span>
                            <span class="font-bold text-gray-700">85%</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center gap-2"><span
                                    class="w-3 h-3 bg-yellow-400 rounded-full"></span> Izin/Sakit</span>
                            <span class="font-bold text-gray-700">10%</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                Alfa</span>
                            <span class="font-bold text-gray-700">5%</span>
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::user()->role == 'karyawan')
                <div class="bg-gray-50/50 p-6 rounded-3xl border border-gray-100 flex flex-col items-center">
                    <h3 class="text-sm font-bold text-gray-700 mb-6 uppercase tracking-widest">Statistik Kehadiran</h3>

                    <div class="relative w-full h-64">
                        <canvas id="presenceChart"></canvas>
                    </div>

                    <div class="mt-6 w-full space-y-2">
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                Hadir</span>
                            <span class="font-bold text-gray-700">85%</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center gap-2"><span
                                    class="w-3 h-3 bg-yellow-400 rounded-full"></span> Izin/Sakit</span>
                            <span class="font-bold text-gray-700">10%</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                Alfa</span>
                            <span class="font-bold text-gray-700">5%</span>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    <div class="md:col-span-2">
        <button class="p-6 text-xs bg-lime-600 uppercase">Download Rekap Kehadiran Bulan ini</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('presenceChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Hadir', 'Izin/Sakit', 'Alfa'],
            datasets: [{
                data: [85, 10, 5],
                backgroundColor: ['#3b82f6', '#facc15', '#ef4444'],
                hoverOffset: 10,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endsection