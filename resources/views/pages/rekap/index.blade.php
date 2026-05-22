@extends('layouts.app')

@section('title', 'Rekap Absensi Seluruh Karyawan')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Rekap Absensi Semua Karyawan</h1>
            <p class="text-gray-500">Pantau kehadiran seluruh tim secara real-time</p>
        </div>
        <div class="flex gap-2">
            {{-- Tombol Export jika nanti dibutuhkan --}}
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                Export Excel
            </button>
        </div>
    </div>

    {{-- Tabel Rekap --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-bold text-gray-700">Nama Karyawan</th>
                        <th class="px-6 py-4 font-bold text-gray-700">Tanggal</th>
                        <th class="px-6 py-4 font-bold text-gray-700">Jam Masuk</th>
                        <th class="px-6 py-4 font-bold text-gray-700">Jam Pulang</th>
                        <th class="px-6 py-4 font-bold text-gray-700">Lokasi</th>
                        <th class="px-6 py-4 font-bold text-gray-700">Keterangan</th>
                        <th class="px-6 py-4 font-bold text-gray-700">Divisi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @forelse($semua_presensi as $p)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-semibold text-blue-600">
                            {{ $p->user->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="{{ $p->jam_masuk > '08:00:00' ? 'text-red-600' : 'text-green-600' }} font-bold">
                                {{ $p->jam_masuk ?? '--:--' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $p->jam_pulang ?? '--:--' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($p->location)
                                <a href="https://www.google.com/maps?q={{ $p->location }}" target="_blank" class="text-blue-500 hover:underline flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Lihat Map
                                </a>
                            @else
                                <span class="text-gray-300 italic">No GPS</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $p->keterangan == 'Hadir' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $p->keterangan }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                            Belum ada data presensi yang masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection