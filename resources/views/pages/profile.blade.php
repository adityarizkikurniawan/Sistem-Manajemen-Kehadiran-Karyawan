@extends('layouts.app')

@section('title', 'Profil saya')

@section('content')

    <div class="bg-gradient-to-r from-slate-800 to-slate-700 rounded-3xl shadow-lg p-8 text-white">
        <div class="flex flex-col md:flex-row md:items-center gap-5">

            <div class="w-24 h-24 rounded-full bg-white/20 flex items-center justify-center text-3xl font-bold uppercase">
                {{ strtoupper(substr($user->name,0,2)) }}
            </div>

            <div>
                <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                <p>{{ $user->email }}</p>

                <div class="flex gap-2 mt-3">
                    <span class="px-3 py-1 rounded-full bg-white/20 text-sm">
                        {{ ucfirst($user->role) }}
                    </span>

                    @if($user->role == 'karyawan')
                    <span class="px-3 py-1 rounded-full bg-white/20 text-sm">
                        {{ optional($user->divisi)->nama_divisi ?? '-' }}
                    </span>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @if($user->role == 'admin')

    <div class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl shadow border p-6">

        <h2 class="text-xl font-bold mb-6">Informasi Administrator</h2>

        <div class="grid md:grid-cols-2 gap-6">

            <div>
                <label>Nama</label>
                <p>{{ $user->name }}</p>
            </div>

            <div>
                <label>Email</label>
                <p>{{ $user->email }}</p>
            </div>

            <div>
                <label>Role</label>
                <p>{{ ucfirst($user->role) }}</p>
            </div>

            <div>
                <label>Nomor HP</label>
                <p>{{ $user->no_hp ?? '-' }}</p>
            </div>

            <div>
                <label>Jenis Kelamin</label>
                <p>{{ $user->jenis_kelamin ?? '-' }}</p>
            </div>

            <div>
                <label>Status Pernikahan</label>
                <p>{{ $user->status_pernikahan ?? '-' }}</p>
            </div>

        </div>

    </div>

    @else

    <div class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl shadow border p-6">

        <h2 class="text-xl font-bold mb-6">Data Karyawan</h2>

        <div class="grid md:grid-cols-2 gap-6">

            <div><label>Nama</label><p>{{ $user->name }}</p></div>
            <div><label>Email</label><p>{{ $user->email }}</p></div>
            <div><label>Role</label><p>{{ ucfirst($user->role) }}</p></div>
            <div><label>Divisi</label><p>{{ optional($user->divisi)->nama_divisi ?? '-' }}</p></div>
            <div><label>Nomor HP</label><p>{{ $user->no_hp ?? '-' }}</p></div>
            <div><label>Jenis Kelamin</label><p>{{ $user->jenis_kelamin ?? '-' }}</p></div>
            <div><label>Status Pernikahan</label><p>{{ $user->status_pernikahan ?? '-' }}</p></div>

        </div>

    </div>

    @endif

    <div class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl shadow border p-6">
        <h2 class="text-xl font-bold mb-6">Ubah Password</h2>

        <form action="{{ route('profil.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-3 gap-4 text-black">

                <input type="password" name="current_password" placeholder="Password Lama" class="border rounded-xl p-3">
                <input type="password" name="password" placeholder="Password Baru" class="border rounded-xl p-3">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="border rounded-xl p-3">

            </div>

            <button class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-xl">
                Simpan Password
            </button>
        </form>
    </div>

@endsection
