@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Karyawan</h1>
        <a href="{{ route('karyawan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl font-bold hover:bg-blue-700 transition">
            + Tambah Karyawan
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left font-bold text-gray-600">Nama</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-600">Email</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-600">Role</th>
                    <th class="px-6 py-4 text-center font-bold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-md text-xs font-bold uppercase">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button class="text-blue-600 hover:underline mr-3">Edit</button>
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection