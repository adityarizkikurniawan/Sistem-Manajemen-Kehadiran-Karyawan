@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-6">

    <div class="bg-slate-900 rounded-3xl p-6 mb-6 shadow-xl">
        <h1 class="text-3xl font-black text-white">
            EDIT DATA KARYAWAN
        </h1>

        <p class="text-slate-300 mt-2">
            Perbarui informasi karyawan
        </p>
    </div>

    <div class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl shadow-lg p-6">

        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-200 mb-2">
                        Nama Karyawan
                    </label>

                    <input type="text" name="name" value="{{ old('name', $karyawan->name) }}"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-200 mb-2">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email', $karyawan->email) }}"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Divisi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-200 mb-2">
                        Divisi
                    </label>

                    <select name="divisi_id"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        @foreach($divisis as $divisi)

                        <option value="{{ $divisi->id }}" {{ $karyawan->divisi_id == $divisi->id ? 'selected' : '' }}>

                            {{ $divisi->nama_divisi }}

                        </option>

                        @endforeach

                    </select>
                </div>

                {{-- No HP --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-200 mb-2">
                        Nomor HP
                    </label>

                    <input type="text" name="no_hp" value="{{ old('no_hp', $karyawan->no_hp) }}"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Status Pernikahan --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-200 mb-2">
                        Status Pernikahan
                    </label>

                    <select name="status_pernikahan"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        <option value="Belum Menikah"
                            {{ $karyawan->status_pernikahan == 'Belum Menikah' ? 'selected' : '' }}>
                            Belum Menikah
                        </option>

                        <option value="Menikah" {{ $karyawan->status_pernikahan == 'Menikah' ? 'selected' : '' }}>
                            Menikah
                        </option>

                    </select>
                </div>

            </div>

            <div class="flex gap-3 mt-8">

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold">
                    Simpan Perubahan
                </button>

                <a href="{{ route('karyawan.index') }}"
                    class="bg-slate-600 hover:bg-slate-600 text-white px-6 py-3 rounded-xl font-bold">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection