@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div
        class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl p-8 text-white shadow-xl">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <div class="flex items-center gap-5">

                <div
                    class="w-24 h-24 rounded-full bg-blue-500 flex items-center justify-center text-3xl font-black uppercase shadow-lg">
                    {{ substr($karyawan->name,0,2) }}
                </div>

                <div>

                    <h1 class="text-3xl font-black uppercase tracking-wide">
                        {{ $karyawan->name }}
                    </h1>

                    <p class="text-slate-300 mt-1">
                        {{ $karyawan->email }}
                    </p>

                    @if($karyawan->divisi)
                        <span
                            class="inline-block mt-3 px-3 py-1 bg-blue-500 rounded-full text-xs font-bold uppercase">
                            {{ $karyawan->divisi->nama_divisi }}
                        </span>
                    @endif

                </div>

            </div>

        </div>

    </div>


    <!-- DETAIL -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- DATA PRIBADI -->
        <div class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl shadow border border-slate-200">

            <div class="px-6 py-5 border-b">
                <h2 class="font-black text-slate-300 uppercase">
                    Informasi Pribadi
                </h2>
            </div>

            <div class="p-6 space-y-5">

                <div>
                    <label class="text-xs text-slate-200 font-bold uppercase">
                        Nama Lengkap
                    </label>

                    <p class="mt-1 text-slate-300 font-semibold">
                        {{ $karyawan->name }}
                    </p>
                </div>

                <div>
                    <label class="text-xs text-slate-300 font-bold uppercase">
                        Email
                    </label>

                    <p class="mt-1 text-slate-200 font-semibold">
                        {{ $karyawan->email }}
                    </p>
                </div>

                <div>
                    <label class="text-xs text-slate-300 font-bold uppercase">
                        Nomor HP
                    </label>

                    <p class="mt-1 text-slate-200 font-semibold">
                        {{ $karyawan->no_hp ?? '-' }}
                    </p>
                </div>

                <div>
                    <label class="text-xs text-slate-300 font-bold uppercase">
                        Jenis Kelamin
                    </label>

                    <p class="mt-1 text-slate-200 font-semibold">
                        {{ $karyawan->jenis_kelamin ?? '-' }}
                    </p>
                </div>

                <div>
                    <label class="text-xs text-slate-300 font-bold uppercase">
                        Status Pernikahan
                    </label>

                    <p class="mt-1 text-slate-200 font-semibold">
                        {{ $karyawan->status_pernikahan ?? '-' }}
                    </p>
                </div>

            </div>

        </div>


        <!-- DATA PEKERJAAN -->
        <div class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl shadow border border-slate-200">

            <div class="px-6 py-5 border-b">
                <h2 class="font-black text-slate-300 uppercase">
                    Informasi Pekerjaan
                </h2>
            </div>

            <div class="p-6 space-y-5">

                <div>
                    <label class="text-xs text-slate-300 font-bold uppercase">
                        Divisi
                    </label>

                    <p class="mt-1 text-slate-200 font-semibold">
                        {{ $karyawan->divisi->nama_divisi ?? '-' }}
                    </p>
                </div>

                <div>
                    <label class="text-xs text-slate-300 font-bold uppercase">
                        Role
                    </label>

                    <p class="mt-1">
                        <span
                            class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold uppercase">
                            {{ $karyawan->role }}
                        </span>
                    </p>
                </div>

                <div>
                    <label class="text-xs text-slate-300 font-bold uppercase">
                        Bergabung Sejak
                    </label>

                    <p class="mt-1 text-slate-200 font-semibold">
                        {{ $karyawan->created_at->format('d F Y') }}
                    </p>
                </div>

                <div>
                    <label class="text-xs text-slate-300 font-bold uppercase">
                        Terakhir Diupdate
                    </label>

                    <p class="mt-1 text-slate-200 font-semibold">
                        {{ $karyawan->updated_at->format('d F Y H:i') }}
                    </p>
                </div>

            </div>

        </div>

    </div>


    <!-- AKSI -->
    <div
        class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl border border-slate-200 shadow p-6 flex justify-end gap-3">

        <a href="{{ route('karyawan.index') }}"
            class="px-5 py-3 rounded-xl hover:bg-slate-300 font-bold transition">
            Kembali
        </a>

        <a href="{{ route('karyawan.EditKaryawan',$karyawan->id) }}"
            class="px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold transition">
            Edit Data
        </a>

    </div>

</div>
@endsection