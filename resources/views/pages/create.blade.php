@extends('layouts.app')

@section('title', 'Tambah Karyawan - Sistem Presensi')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('karyawan.index') }}" class="p-2 bg-white border border-gray-100 rounded-xl shadow-sm hover:bg-gray-50 transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Karyawan Baru</h1>
    </div>

    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        <form action="{{ route('karyawan.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                    placeholder="Masukkan nama lengkap...">
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Perusahaan</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                    placeholder="nama@perusahaan.com">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        placeholder="Min. 8 karakter">
                </div>

                <div>
                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">Role Akses</label>
                    <select name="role" id="role" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition appearance-none bg-white">
                        <option value="karyawan">Karyawan</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
            </div>

            <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-xs text-blue-700 leading-relaxed">
                        Pastikan email yang didaftarkan aktif. Password yang Anda masukkan adalah password sementara yang bisa diubah oleh karyawan nantinya.
                    </p>
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="reset" class="flex-1 px-6 py-3 border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition">
                    Reset
                </button>
                <button type="submit" class="flex-[2] px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection