@extends('layouts.app')

@section('title', 'Pengajuan Izin - Presensi')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Pengajuan Izin</h2>
    
    <form action="#" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Izin</label>
            <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
                <option>Sakit (Dengan Surat Dokter)</option>
                <option>Cuti Tahunan</option>
                <option>Cuti Melahirkan</option>
                <option>Cuti Duka</option>
                <option>Cuti Hari Raya</option>
                <option>Keperluan Mendesak</option>
            </select>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mulai Tanggal</label>
                <input type="date" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                <input type="date" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
            <textarea rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Alasan izin..."></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition duration-300">
            Kirim Pengajuan
        </button>
    </form>
</div>
@endsection 