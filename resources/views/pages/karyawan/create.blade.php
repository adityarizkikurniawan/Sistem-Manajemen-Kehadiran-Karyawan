@extends('layouts.app')

@section('title', 'Tambah Karyawan - Sistem Presensi')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('karyawan.index') }}"
            class="p-2 bg-gradient-to-r from-slate-900 to-slate-700 border border-gray-100 rounded-xl shadow-sm hover:bg-gray-50 transition">
            <svg class="w-5 h-5 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Karyawan Baru</h1>
    </div>

    <div class="bg-gradient-to-r from-slate-900 to-slate-700 p-8 rounded-2xl border border-gray-100 shadow-sm">
        <form action="{{ route('karyawan.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Input Nama --}}
            <div>
                <label class="block text-xs font-black text-slate-300 uppercase tracking-wider mb-2">Nama
                    Lengkap</label>
                <input type="text" name="name" required placeholder="Masukkan nama karyawan"
                    class="w-full text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
            </div>

            {{-- Input Email --}}
            <div>
                <label class="block text-xs font-black text-slate-300 uppercase tracking-wider mb-2">Alamat
                    Email</label>
                <input type="email" name="email" required placeholder="karyawan@perusahaan.com"
                    class="w-full text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
            </div>

            {{-- Input No. Telepon --}}
            <div>
                <label class="block text-xs font-black text-slate-300 uppercase tracking-wider mb-2">
                    No. Telepon
                </label>
                <input
                    type="text"
                    name="no_hp"
                    placeholder="+62"
                    class="w-full text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
            </div>

            {{-- Input Jenis Kelamin --}}
            <div>
                <label class="block text-xs font-black text-slate-300 uppercase tracking-wider mb-2">Jenis
                    Kelamin</label>
                <select name="jenis_kelamin" required
                    class="w-full text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            {{-- Input Status Pernikahan --}}
            <div>
                <label class="block text-xs font-black text-slate-300 uppercase tracking-wider mb-2">Status
                    Pernikahan</label>
                <select name="status_pernikahan" required
                    class="w-full text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih Status --</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                </select>
            </div>

            {{-- Input Divisi (Dropdown Terintegrasi) --}}
            <div>
                <label class="block text-xs font-black text-slate-300 uppercase tracking-wider mb-2">Divisi
                    Kerja</label>
                <select name="divisi_id" required
                    class="w-full text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">

                    <option value="">-- Pilih Divisi --</option>

                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id }}">
                            {{ strtoupper($divisi->nama_divisi) }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Input Password --}}
            <div>
                <label class="block text-xs font-black text-slate-300 uppercase tracking-wider mb-2">Password
                    Akun</label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter"
                    class="w-full text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
            </div>

            {{-- Tombol Submit --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-black tracking-wider uppercase transition duration-200 shadow-sm">
                    Daftarkan Karyawan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection