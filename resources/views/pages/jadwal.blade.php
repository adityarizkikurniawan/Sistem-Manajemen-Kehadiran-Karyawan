@extends('layouts.app')

@section('title', 'Jadwal Kerja Per Divisi')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gradient-to-r from-slate-900 to-slate-700 p-6 rounded-3xl shadow-2xl">
        <div>
            <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em]">Division Leader</span>
            <h2 class="text-xl font-extrabold text-white mt-1">Ketua Divisi</h2>
            <p class="text-sm text-gray-300 mt-2 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Samuel Ambar Pasaribu
            </p>
            <p class="text-xs text-gray-400 font-mono mt-1">No HP: +62 821-7037-8193</p>
        </div>
    </div>

    <div class="relative overflow-hidden rounded-3xl bg-slate-900 border flex flex-col lg:flex-row min-h-[350px] shadow-2xl">
        <div class="w-full lg:w-1/2 p-10 flex flex-col justify-center">
            <div class="space-y-1 mb-6">
                <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em]">Shift Information</span>
                <h2 class="text-3xl font-extrabold text-white tracking-tight mt-1">Jadwal Kerja Divisi Operational</h2>
                <p class="text-slate-400 text-sm">Silakan cek secara berkala jadwal mingguan</p>
                <div class="pt-2">
                    <span class="bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-bold px-3 py-1.5 rounded-xl uppercase tracking-wider">
                        Senin - Jumat
                    </span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                @if(Auth::user()->role == 'karyawan')
                    <div class="flex-1 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold py-4 rounded-2xl text-center flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        08.00 (Masuk)
                    </div>
                    <div class="flex-1 bg-white/5 text-white/50 border border-white/5 font-bold py-4 rounded-2xl text-center flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        17.00 (Pulang)
                    </div>
                @endif
            </div>
        </div>

        <div class="hidden lg:block w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 z-10 bg-gradient-to-r from-slate-900 via-slate-900/40 to-transparent"></div>
            <img src="https://www.kantorkita.co.id/wp-content/uploads/2025/04/Screenshot_2-5-1080x675.jpg" 
                 class="h-full w-full object-cover grayscale-[20%] brightness-75" alt="Office Background">
        </div>
    </div>

    <div class="bg-gradient-to-r from-slate-900 to-slate-800 border border-white/5 p-6 rounded-3xl shadow-2xl">
        <div class="mb-6">
            <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em]">Monthly Schedule</span>
            <h3 class="text-xl font-bold text-white mt-1">Kalender Agenda</h3>
        </div>
        
        <div id="calendar" class="text-white min-h-[550px]"></div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.min.css" rel="stylesheet">
<style>
    /* Styling khusus biar FullCalendar melebur dengan bg-slate-900 kamu */
    .fc { --fc-border-color: rgba(255, 255, 255, 0.05); --fc-page-bg-color: transparent; }
    .fc .fc-toolbar-title { font-size: 1.1rem !important; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: #ffff; }
    .fc .fc-button-primary { background-color: rgba(255,255,255,0.05); border-color: rgba(255, 255, 255, 0.05); font-size: 0.75rem; font-weight: bold; text-transform: uppercase; border-radius: 12px !important; transition: all 0.2s; }
    .fc .fc-button-primary:hover { background-color: #3b82f6 !important; border-color: #3b82f6 !important; }
    .fc .fc-button-primary:disabled { background-color: #0f172a !important; border-color: transparent !important; opacity: 0.4; }
    .fc .fc-col-header-cell-cushion { color: #64748b; font-size: 11px; font-weight: 900; text-transform: uppercase; padding: 10px 0 !important; }
    .fc .fc-daygrid-day-number { color: #94a3b8; font-family: monospace; font-size: 12px; padding: 8px !important; }
    .fc .fc-day-today { background: rgba(59, 130, 246, 0.08) !important; }
    .fc-theme-standard td, .fc-theme-standard th { border: 1px solid rgba(255, 255, 255, 0.05) !important; }
    .fc-event { border-radius: 6px !important; padding: 2px 4px !important; font-size: 11px !important; font-weight: 600; }
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
            // Array Agenda/Event - nanti kembangkan untuk ambil data dinamis dari backend Laravel
            events: [
                {
                    title: 'Sprint 1: Desain ERD & DB',
                    start: '2026-06-01',
                    end: '2026-06-06',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: '#3b82f6',
                    textColor: '#60a5fa'
                },
                {
                    title: 'Testing Integrasi GPS',
                    start: '2026-06-10',
                    backgroundColor: 'rgba(16, 185, 129, 0.2)',
                    borderColor: '#10b981',
                    textColor: '#34d399'
                },
                {
                    title: 'Review PBL Bersama Dosen',
                    start: '2026-06-17',
                    backgroundColor: 'rgba(245, 158, 11, 0.2)',
                    borderColor: '#f59e0b',
                    textColor: '#fbbf24'
                }
            ]
        });
        calendar.render();
    });
</script>
@endsection