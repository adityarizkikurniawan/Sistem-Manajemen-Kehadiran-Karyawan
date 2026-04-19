@extends('layouts.app')

@section('title', 'Beranda - Sistem Presensi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm p-8 mb-8 border border-gray-100 text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Selamat Datang di Sistem Presensi</h1>
        <p class="text-gray-600 mb-6">Kelola kehadiran Anda dengan mudah, cepat, dan transparan.</p>
        
        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                Masuk Sekarang
            </a>
            <a href="#fitur" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-2 px-6 rounded-lg transition">
                Pelajari Fitur
            </a>
        </div>
    </div>

    <div id="fitur" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="text-blue-500 mb-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="font-bold text-gray-800">Presensi Real-time</h3>
            <p class="text-sm text-gray-500 mt-2">Catat kehadiran Anda secara instan kapan saja.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="text-green-500 mb-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="font-bold text-gray-800">Rekap Laporan</h3>
            <p class="text-sm text-gray-500 mt-2">Lihat riwayat kehadiran bulanan dengan satu klik.</p>
        </div>

    </div>
</div>
@endsection