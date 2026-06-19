@extends('layouts.app')

@section('content')
<div class="space-y-6 pb-2">

    <div class="grid grid-cols-1 {{ auth()->user()->role == 'admin' ? 'lg:grid-cols-2' : '' }} gap-6">

        <div
            class="bg-gradient-to-r from-slate-900 to-slate-700 p-6 rounded-3xl shadow-2xl flex flex-col justify-center">
            @if($divisi)
            <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em]">Division Leader</span>
            <h2 class="text-xl font-extrabold text-white mt-1">{{ $divisi->nama_divisi }}</h2>
            <p class="text-sm text-gray-300 mt-2 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                {{ $divisi->ketua->name ?? 'Belum ada ketua' }}
            </p>
            <p class="text-xs text-gray-400 font-mono mt-1">No HP: {{ $divisi->ketua->no_hp ?? '-' }}</p>
            @else
            <h2 class="text-white font-bold">Informasi Divisi</h2>
            <p class="text-gray-400 text-sm">Anda belum terdaftar dalam divisi.</p>
            @endif
        </div>

        @if(auth()->user()->role == 'admin')
        <div class="bg-slate-800 border border-slate-700 p-6 rounded-3xl flex flex-col justify-center">
            <h3 class="text-white font-bold mb-3 text-sm">Admin Control: Atur Ketua Divisi</h3>
            @if($divisi)
            <form action="{{ route('divisi.update', $divisi->id) }}" method="POST" class="flex gap-2">
                @csrf @method('PUT')
                <select name="ketua_id"
                    class="flex-1 bg-slate-900 text-white text-sm rounded-xl p-2 border border-slate-700">
                    @foreach($semuaKaryawan as $karyawan)
                    <option value="{{ $karyawan->id }}" {{ $divisi->ketua_id == $karyawan->id ? 'selected' : '' }}>
                        {{ $karyawan->name }}
                    </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-xl text-sm font-bold">Update</button>
            </form>
            @else
            <p class="text-red-400 text-xs">Pilih divisi di tabel divisi terlebih dahulu.</p>
            @endif
        </div>
        @endif
    </div>

    <div
        class="relative overflow-hidden rounded-3xl bg-slate-900 border border-slate-700 flex flex-col lg:flex-row min-h-[250px] shadow-2xl">
        <div class="w-full p-10 flex flex-col justify-center">
            <h2 class="text-3xl font-extrabold text-white tracking-tight mt-1">Jadwal Kerja
                {{ $divisi->nama_divisi ?? '' }}</h2>

            @if(auth()->user()->role == 'admin' && $divisi)
            <form action="{{ route('jadwal.update-kerja', $divisi->id) }}" method="POST" class="pt-4 flex gap-4">
                @csrf @method('PUT')
                <input type="time" name="jam_masuk_kerja" value="{{ $divisi->jam_masuk_kerja ?? '08:00' }}" ...>
                <input type="time" name="jam_pulang_kerja" value="{{ $divisi->jam_pulang_kerja ?? '17:00' }}" ...>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-6 rounded-2xl font-bold">Simpan</button>
            </form>
            @else
            <div class="pt-4 flex gap-4">
                <div
                    class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-bold py-4 px-6 rounded-2xl">
                    {{ \Carbon\Carbon::parse($divisi->jam_masuk ?? '08:00')->format('H.i') }} (Masuk)
                </div>
                <div class="bg-white/5 text-white/50 border border-white/5 font-bold py-4 px-6 rounded-2xl">
                    {{ \Carbon\Carbon::parse($divisi->jam_pulang ?? '17:00')->format('H.i') }} (Pulang)
                </div>
            </div>
            @endif
        </div>
    </div>

    @if(auth()->user()->role == 'admin')

    <div class="mt-6 bg-slate-900 border border-slate-700 rounded-3xl p-6 shadow-xl">

        <h3 class="text-white text-lg font-bold mb-4">
            Jadwal Seluruh Divisi
        </h3>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b border-slate-700 text-slate-400 uppercase">
                        <th class="text-left py-3">Divisi</th>
                        <th class="text-center py-3">Jam Masuk</th>
                        <th class="text-center py-3">Jam Pulang</th>
                        <th class="text-center py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($divisis as $item)

                    <tr class="border-b border-slate-800">

                        <td class="py-4 text-white font-semibold">
                            {{ $item->nama_divisi }}
                        </td>

                        <td class="text-center text-emerald-400">
                            {{ \Carbon\Carbon::parse($item->jam_masuk_kerja)->format('H:i') }}
                        </td>

                        <td class="text-center text-orange-400">
                            {{ \Carbon\Carbon::parse($item->jam_pulang_kerja)->format('H:i') }}
                        </td>

                        <td class="text-center">

                            <form action="{{ route('jadwal.update', $item->id) }}" method="POST"
                                class="flex justify-center gap-2">

                                @csrf
                                @method('PUT')

                                <input type="time" name="jam_masuk_kerja" value="{{ $item->jam_masuk_kerja }}"
                                    class="bg-slate-800 text-white rounded-lg px-2 py-1">

                                <input type="time" name="jam_pulang_kerja" value="{{ $item->jam_pulang_kerja }}"
                                    class="bg-slate-800 text-white rounded-lg px-2 py-1">

                                <button type="submit" class="bg-blue-600 hover:bg-blue-500 px-3 rounded-lg text-white">

                                    Simpan

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    @endif

</div>


<div class="bg-gradient-to-r from-slate-900 to-slate-800 border border-white/5 p-6 rounded-3xl shadow-2xl">
    <div class="mb-6">
        <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em]">Monthly Schedule</span>
        <h3 class="text-xl font-bold text-white mt-1">Kalender Agenda</h3>
    </div>

    <div id="calendar" class="text-white min-h-[550px]"></div>
</div>

@if(Auth::user()->role == 'admin')
<form action="{{ route('jadwal.store') }}" method="POST"
    class="bg-slate-950 p-6 rounded-2xl border border-white/5 mb-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        <div>
            <label class="text-[10px] text-slate-500 font-bold uppercase">Tanggal Libur</label>
            <input type="date" name="tanggal"
                class="w-full bg-slate-900 border border-white/10 rounded-xl p-3 text-white" required>
        </div>
        <div>
            <label class="text-[10px] text-slate-500 font-bold uppercase">Keterangan</label>
            <input type="text" name="keterangan"
                class="w-full bg-slate-900 border border-white/10 rounded-xl p-3 text-white" placeholder="..." required>
        </div>
        <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-bold py-3 px-6 rounded-xl transition">
            TAMBAH LIBUR
        </button>
    </div>
</form>
@endif
</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.min.css" rel="stylesheet">
<style>
/* Styling khusus biar FullCalendar melebur dengan bg-slate-900 kamu */
.fc {
    --fc-border-color: rgba(255, 255, 255, 0.05);
    --fc-page-bg-color: transparent;
}

.fc .fc-toolbar-title {
    font-size: 1.1rem !important;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #ffff;
}

.fc .fc-button-primary {
    background-color: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.05);
    font-size: 0.75rem;
    font-weight: bold;
    text-transform: uppercase;
    border-radius: 12px !important;
    transition: all 0.2s;
}

.fc .fc-button-primary:hover {
    background-color: #3b82f6 !important;
    border-color: #3b82f6 !important;
}

.fc .fc-button-primary:disabled {
    background-color: #0f172a !important;
    border-color: transparent !important;
    opacity: 0.4;
}

.fc .fc-col-header-cell-cushion {
    color: #64748b;
    font-size: 11px;
    font-weight: 900;
    text-transform: uppercase;
    padding: 10px 0 !important;
}

.fc .fc-daygrid-day-number {
    color: #94a3b8;
    font-family: monospace;
    font-size: 12px;
    padding: 8px !important;
}

.fc .fc-day-today {
    background: rgba(59, 130, 246, 0.08) !important;
}

.fc-theme-standard td,
.fc-theme-standard th {
    border: 1px solid rgba(255, 255, 255, 0.05) !important;
}

.fc-event {
    border-radius: 6px !important;
    padding: 2px 4px !important;
    font-size: 11px !important;
    font-weight: 600;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id',
        headerToolbar: {
            left: 'title',
            right: 'prev,next today'
        },

        events: {
            url: '{{ route("jadwal.api") }}', // Mengambil data libur dari database
            method: 'GET',
            failure: function() {
                alert('Gagal memuat data libur!');
            }
        },
    });
    calendar.render();
});
</script>
@endsection