@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex flex-col items-center justify-center">
    
    <div class="text-center mb-10">
        <h1 class="text-6xl font-black text-blue-600 tracking-tighter">14.26.02</h1>
        <p class="text-lg text-gray-500 font-medium mt-2">Sunday, 26 April 2026</p>
    </div>

    <div class="w-full max-w-2xl bg-white p-10 rounded-3xl shadow-2xl shadow-blue-100 border border-gray-100 text-center">
        <div class="inline-block p-3 bg-blue-50 rounded-2xl mb-6">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-10V4m0 10V4m-4 11h.01M11 11h.01M11 7h.01M14 7h.01M14 11h.01M14 15h.01M11 15h.01"></path>
            </svg>
        </div>
        
        <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Portal Absensi Internal</h2>
        <p class="text-gray-500 leading-relaxed mb-8 px-10">
            Selamat datang di sistem manajemen kehadiran PT. Polibatam. 
            Silakan gunakan akun Anda untuk melakukan presensi masuk/pulang hari ini.
        </p>

        @guest
            <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-12 rounded-2xl transition duration-300 transform hover:scale-105 shadow-lg shadow-blue-200">
                Masuk ke Akun
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-12 rounded-2xl transition duration-300">
                Lanjut ke Dashboard
            </a>
        @endguest
    </div>


</div>
@endsection