@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- HEADER UTAMA -->
    <div
        class="bg-slate-900 p-6 rounded-3xl text-white shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black tracking-tight uppercase">Kelola Data Karyawan</h1>
            <p class="text-xs text-slate-400 mt-1 font-medium">Manajemen data staf, penempatan divisi, dan riwayat
                bergabung</p>
        </div>
    </div>

    <!-- PANEL REKAP & EXPORT BERDASARKAN DIVISI -->
    <div
        class="bg-gradient-to-r from-slate-900 to-slate-700 p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h4 class="text-sm font-black text-slate-300 uppercase tracking-wider">Rekap Karyawan</h4>
            <p class="text-xs text-slate-400 mt-1 font-medium">Tampilkan dan unduh laporan data staf berdasarkan divisi
                kerja</p>
        </div>

        <!-- Area Aksi (Filter + Export) -->
        <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
            <!-- Form Filter Pencarian -->
            <form action="{{ route('karyawan.index') }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
                <select name="filter_divisi"
                    class="w-full sm:w-auto text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500 min-w-[200px]">
                    <option value="">-- Semua Divisi --</option>
                    <option value="IT / Engineering"
                        {{ request('filter_divisi') == 'IT / Engineering' ? 'selected' : '' }}>IT / ENGINEERING</option>
                    <option value="Core Business" {{ request('filter_divisi') == 'Core Business' ? 'selected' : '' }}>
                        CORE BUSINESS</option>
                    <option value="Production" {{ request('filter_divisi') == 'Production' ? 'selected' : '' }}>
                        PRODUCTION</option>
                    <option value="Marketing" {{ request('filter_divisi') == 'Marketing' ? 'selected' : '' }}>MARKETING
                    </option>
                </select>

                <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-black tracking-wider transition uppercase shrink-0 shadow-sm">
                    FILTER
                </button>

                @if(request('filter_divisi_id'))
                <a href="{{ route('karyawan.index') }}"
                    class="px-3 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs font-bold transition shrink-0">
                    RESET
                </a>
                @endif
            </form>

            <!-- Garis Pembatas Vertikal Ringan -->
            <div class="hidden lg:block w-px h-6 bg-slate-200 mx-1"></div>

            <!-- TOMBOL EXPORT PDF KARYAWAN BERDASARKAN DIVISI -->
            {{-- Mengirimkan query filter_divisi yang sedang aktif ke route export agar datanya sinkron --}}
            <a href="{{ route('karyawan.export', ['filter_divisi' => request('filter_divisi')]) }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-black tracking-wider uppercase transition-all duration-200 shadow-sm w-full sm:w-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16v1a2 2 0 002 2h14a2 2 0 002-2v-1M16 9l-4-4m0 0L8 9m4-4v12" />
                </svg>
                Export PDF {{ request('filter_divisi') ? 'Divisi' : '' }}
            </a>
        </div>
    </div>

    <!-- TABEL DATA KARYAWAN -->
    <div
        class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl shadow-sm border border-slate-900 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gradient-to-r from-slate-700 to-slate-500 border-b border-slate-900">
                        <th class="px-6 py-4 text-xs font-black text-slate-200 uppercase tracking-wider">Nama Karyawan
                        </th>
                        <th class="px-6 py-4 text-xs font-black text-slate-200 uppercase tracking-wider">Alamat Email
                        </th>
                        <th class="px-6 py-4 text-xs font-black text-slate-200 uppercase tracking-wider">Divisi</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-200 uppercase tracking-wider text-center">
                            Tanggal Bergabung</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-200 uppercase tracking-wider text-center">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-00 text-xs">
                    @foreach($karyawan as $k)
                    <tr class="hover:bg-slate-50/50 transition duration-150">
                        <td class="px-6 py-4 font-bold text-slate-200">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 font-black flex items-center justify-center border border-blue-100 uppercase">
                                    {{ substr($k->name, 0, 2) }}
                                </div>
                                <span>{{ $k->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-300 font-medium">{{ $k->email }}</td>
                        <td class="px-6 py-4">
                            @if($k->divisi)
                            <span
                                class="inline-flex items-center px-2.5 py-1 bg-blue-50 border border-blue-100 text-blue-700 font-black rounded-md uppercase tracking-wide text-[10px]">
                                {{ strtoupper($k->divisi->nama_divisi) }}
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-2.5 py-1 bg-slate-50 border border-slate-200 text-slate-400 font-bold rounded-md uppercase tracking-wide text-[10px]">
                                Belum Set
                            </span>
                            @endif
                        </td>
                        </td>
                        <td class="px-6 py-4 text-slate-400 font-bold text-center">
                            {{ $k->created_at ? $k->created_at->format('d M Y') : '-' }}
                        </td>

                        <td>

                            <div class="flex gap-2">

                                <a href="{{ route('karyawan.show', $k->id) }}"
                                    class="px-3 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-xs font-bold">
                                    Detail
                                </a>

                                <a href="{{ route('karyawan.EditKaryawan', $k->id) }}"
                                    class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-xs font-bold">
                                    Edit
                                </a>

                                <form action="{{ route('karyawan.destroy', $k->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="px-3 py-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg text-xs font-bold">
                                        Hapus
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($karyawan->hasPages())
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
            {{ $karyawan->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection