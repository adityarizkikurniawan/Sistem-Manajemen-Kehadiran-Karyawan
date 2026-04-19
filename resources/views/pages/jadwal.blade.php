@extends('layouts.app')

@section('title', 'Jadwal Kerja Per Divisi')

@section('content')
<div class="space-y-6">
    <div
        class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Jadwal Kerja</h2>
            <p class="text-sm text-gray-500">jadwal operasional berdasarkan divisi</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow-sm border-t-4 border-blue-500 overflow-hidden">
            <div class="p-5 border-b border-gray-50 bg-blue-50/30">
                <h3 class="font-bold text-blue-700">IT Development</h3>
                <p class="text-xs text-blue-500 uppercase font-bold tracking-widest mt-1">Shift A (Pagi)</p>
            </div>

            <div class="p-5 space-y-4">
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Senin - Jumat</span>
                        <span class="font-semibold text-gray-700">08:00 - 17:00</span>
                    </div>
                </div>
                <i>Notes:</i>
                <i>Toleransi Terlambat hanya 5 menit</i>

                <div class="pt-4 border-t border-gray-100">
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-2">Ketua Divisi</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="h-8 w-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                            SAP
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Samuel Ambar Pasaribu</p>
                            <p class="text-[10px] text-gray-500">No HP = +62 821-7037-8193</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border-t-4 border-purple-500 overflow-hidden">
            <div class="p-5 border-b border-gray-50 bg-purple-50/30">
                <h3 class="font-bold text-purple-700">HR & GA</h3>
                <p class="text-xs text-purple-500 uppercase font-bold tracking-widest mt-1">Shift Regular</p>
            </div>
            <div class="p-5 space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Senin - Jumat</span>
                    <span class="font-semibold text-gray-700">08:30 - 17:30</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Sabtu & Minggu</span>
                    <span class="font-bold text-red-500">OFF / Libur</span>
                </div>
                <i>Notes:</i>
                <i>Toleransi Terlambat hanya 5 menit</i>
                <div class="pt-4 border-t border-gray-100">
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-2">Ketua Divisi</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="h-8 w-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                            ARK
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Aditya Rizki Kurniawan</p>
                            <p class="text-[10px] text-gray-500">No HP = +62 822-8680-3782</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-2xl shadow-sm border-t-4 border-orange-500 overflow-hidden">
            <div class="p-5 border-b border-gray-50 bg-orange-50/30">
                <h3 class="font-bold text-orange-700">Security & Operational</h3>
                <p class="text-xs text-orange-500 uppercase font-bold tracking-widest mt-1">Shift Rolling (24/7)</p>
            </div>
            <div class="p-5 space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Pagi</span>
                    <span class="font-semibold text-gray-700">07:00 - 15:00</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Sore</span>
                    <span class="font-semibold text-gray-700">15:00 - 23:00</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Malam</span>
                    <span class="font-semibold text-gray-700">23:00 - 07:00</span>
                </div>
                <i>Notes:</i>
                <i>Toleransi Terlambat hanya 5 menit</i>
                <div class="pt-4 border-t border-gray-100">
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-2">Ketua Divisi</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="h-8 w-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                            SAP
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Muhammad Hoirul Farhan</p>
                            <p class="text-[10px] text-gray-500">No HP = +62 813-7438-1387</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
@endsection