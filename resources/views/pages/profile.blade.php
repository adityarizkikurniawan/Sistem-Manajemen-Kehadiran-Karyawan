@extends('layouts.app')

@section('title', 'Profil Karyawan')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 h-40"></div>
        
        <div class="px-8 pb-10">
            <div class="relative flex flex-col md:flex-row items-center md:items-end -mt-16 gap-6">
                <div class="h-32 w-32 bg-white p-2 rounded-3xl shadow-lg">
                    <div class="h-full w-full bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 text-4xl font-bold">
                        ARK
                    </div>
                </div>
                <div class="text-center md:text-left mb-2">
                    <h2 class="text-3xl font-bold text-gray-800">Aditya Rizki Kurniawan</h2>
                    <p class="text-gray-500 font-medium">Ketua Divisi HR & GA • HR</p>
                </div>
            </div>

            <hr class="my-8 border-gray-100">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <div class="lg:col-span-2 space-y-8">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Informasi Pribadi
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
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">NIK / No. KTP</p>
                            <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">2171012345678901</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Tempat, Tanggal Lahir</p>
                            <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">Batam, 20 Mei 2006</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Alamat Domisili</p>
                            <p class="text-gray-700 font-medium">Jl. Trans Barelang, Taman cipta asri 2 Blok Pinus No.36</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50/50 p-6 rounded-3xl border border-gray-100 flex flex-col items-center">
                    <h3 class="text-sm font-bold text-gray-700 mb-6 uppercase tracking-widest">Statistik Kehadiran</h3>
                    
                    <div class="relative w-full h-64">
                        <canvas id="presenceChart"></canvas>
                    </div>

                    <div class="mt-6 w-full space-y-2">
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 bg-blue-500 rounded-full"></span> Hadir</span>
                            <span class="font-bold text-gray-700">85%</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 bg-yellow-400 rounded-full"></span> Izin/Sakit</span>
                            <span class="font-bold text-gray-700">10%</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 bg-red-500 rounded-full"></span> Alfa</span>
                            <span class="font-bold text-gray-700">5%</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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