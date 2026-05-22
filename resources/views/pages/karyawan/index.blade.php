@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Data Karyawan</h1>
    </div>

    {{-- FORM TAMBAH KARYAWAN --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="font-bold mb-4 text-blue-600">Tambah Karyawan Baru</h3>
        <form action="{{ route('karyawan.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf
            <input type="text" name="name" placeholder="Nama Lengkap" class="border p-3 rounded-xl w-full" required>
            <input type="email" name="email" placeholder="Email" class="border p-3 rounded-xl w-full" required>
            <input type="text" name="divisi" placeholder="Divisi" class="border p-3 rounded-xl w-full" required>
            <input type="number" name="Notelp" placeholder="Nomor telepon" class="border p-3 rounded-xl w-full" required>
            <input type="password" name="password" placeholder="Password (Min. 8 Karakter)" class="border p-3 rounded-xl w-full" required>
            <div class="md:col-span-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold w-full md:w-auto">
                    + Simpan Karyawan
                </button>
            </div>
        </form>
    </div>

    {{-- TABEL DAFTAR KARYAWAN --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($karyawans as $k)
                <tr>
                    <td class="p-4 font-medium">{{ $k->name }}</td>
                    <td class="p-4 text-gray-500">{{ $k->email }}</td>
                    <td class="p-4 text-gray-400 text-xs">{{ $k->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection