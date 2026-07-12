@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <div class="bg-slate-800 rounded-3xl p-6">

        <h2 class="text-2xl text-white font-bold">
            👥 Anggota Divisi
        </h2>

        <p class="text-slate-400">
            {{ $divisi->nama_divisi }}
        </p>

    </div>

    <div class="bg-slate-800 rounded-3xl p-6">
        <table class="w-full">

            <thead>
                <tr class="border-b border-slate-700">
                    <th class="text-left text-slate-400 py-3">Nama</th>
                    <th class="text-left text-slate-400">No HP</th>
                    <th class="text-left text-slate-400">Status</th>
                    <th class="text-left text-slate-400">Kehadiran Hari Ini</th>
                </tr>

            </thead>

            <tbody>
                @foreach($anggota as $item)
                <tr class="border-b border-slate-800">

                    <td class="py-4 text-white">
                        {{ $item->name }}
                    </td>

                    <td class="py-4 text-white">
                        {{ $item->no_hp }}
                    </td>

                    <td>
                        @if($item->id == $divisi->ketua_id)
                        <span class="bg-slate-700 text-slate-200 px-3 py-1 rounded-full text-xs font-bold">
                            Ketua Divisi
                        </span>

                        @else
                        <span class="bg-slate-700 text-slate-200 px-3 py-1 rounded-full text-xs">
                            Karyawan
                        </span>

                        @endif
                    </td>

                    <td>
                        @if($item->status_hari_ini == 'Hadir')
                        <span class="bg-emerald-500/20 text-emerald-400 px-3 py-1 rounded-full text-xs font-bold">
                            🟢 Hadir
                        </span>

                        @elseif($item->status_hari_ini == 'Terlambat')

                        <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-xs font-bold">
                            🟡 Terlambat
                        </span>

                        @elseif($item->status_hari_ini == 'Izin')

                        <span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-xs font-bold">
                            🔵 Izin
                        </span>

                        @elseif($item->status_hari_ini == 'Sakit')

                        <span class="bg-orange-500/20 text-orange-400 px-3 py-1 rounded-full text-xs font-bold">
                            🟠 Sakit
                        </span>

                        @elseif($item->status_hari_ini == 'Alpa')

                        <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-xs font-bold">
                            🔴 Alpa
                        </span>

                        @else

                        <span class="bg-slate-700 text-slate-300 px-3 py-1 rounded-full text-xs">
                            ⚪ Belum Absen
                        </span>

                        @endif
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection