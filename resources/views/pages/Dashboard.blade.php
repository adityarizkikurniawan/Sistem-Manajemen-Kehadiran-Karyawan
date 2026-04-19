@extends('layouts.app')

@section('title', 'Dashboard - Presensi Karyawan')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-xl">
                Ark
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Halo, Aditya r k</h1>
                <div class="flex gap-2 mt-1">
                    <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded-md font-semibold uppercase tracking-wider">Divisi: HR</span>
                    <span class="text-xs bg-gray-50 text-gray-500 px-2 py-1 rounded-md font-semibold uppercase tracking-wider">Jabatan: Ketua Divisi HR & GA</span>
                </div>
            </div>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">Senin, 19 April 2026</p>
            <p class="text-2xl font-mono font-bold text-blue-600" id="clock">00:00:00</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-fit">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Presensi Hari Ini</h3>
                <div class="space-y-4">
                    <div class="flex flex-col gap-2">
                        <button class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-xl transition">
                            Check In (Masuk)
                        </button>
                        <button class="w-full bg-gray-100 text-gray-400 font-bold py-3 rounded-xl cursor-not-allowed" disabled>
                            Check Out (Pulang)
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
                <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                    Lokasi Kantor Anda
                </h3>
                <div class="rounded-xl overflow-hidden h-48 bg-gray-100">
                    <iframe 
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        style="border:0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15956.123456789!2d104.048!3d1.123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMcKwMDcnMjIuOCJOIDEwNMKwMDInNTIuOCJF!5e0!3m2!1sen!2sid!4v1234567890" 
                        allowfullscreen>
                    </iframe>
                </div>
                <p class="text-[10px] text-gray-400 mt-2 text-center italic">*Pastikan GPS aktif sebelum melakukan presensi</p>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-blue-600 text-white p-4 rounded-2xl shadow-lg shadow-blue-100 text-center">
                    <p class="text-xs opacity-80 uppercase">Hadir</p>
                    <p class="text-2xl font-bold">20</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-gray-100 text-center">
                    <p class="text-xs text-gray-400 uppercase">Izin</p>
                    <p class="text-2xl font-bold text-gray-800">2</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-gray-100 text-center">
                    <p class="text-xs text-gray-400 uppercase">Telat</p>
                    <p class="text-2xl font-bold text-gray-800">1</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden text-sm">
                <div class="p-4 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800">Riwayat Terakhir</h3>
                </div>
                <table class="w-full">
                    <tbody class="divide-y divide-gray-50">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">18 Apr 2026</td>
                            <td class="px-6 py-4 text-green-600 font-medium">07:55 (Masuk)</td>
                            <td class="px-6 py-4 text-gray-400">17:05 (Pulang)</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">17 Apr 2026</td>
                            <td class="px-6 py-4 text-red-600 font-medium">08:15 (Telat)</td>
                            <td class="px-6 py-4 text-gray-400">17:00 (Pulang)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID');
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection