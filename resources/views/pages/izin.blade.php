@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Izin / Ketidakhadiran</h1>


    @if(Auth::user()->role == 'karyawan')
    <div class="lg:col-span-2 space-y-8 p-6">
        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Informasi Sisa Cuti
        </h3>
        <i>Sisa cuti yang anda miliki berjumlah : ... Hari</i>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100"> 
            <h2><b>Catatan Umum Cuti</b></h2>
            <br>
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Cuti Tahunan</p>
                <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">12 Hari</p>
            </div><br>
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Cuti Duka</p>
                <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">2 Hari</p>
            </div><br>
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Cuti Melahirkan/Keguguran</p>
                <p class="text-gray-700 font-medium border-b border-gray-50 pb-2">3 bulan</p>
            </div><br>
            <div class="md:col-span-2">
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Cuti Khusus</p>
                <p class="text-gray-700 font-medium">4 Hari</p>
                <p>-Karyawan menikah</p>
                <p>-Menikahkan anaknya</p>
                <p>-Mengkhitankan/Membaptis anak</p>
                <p>-Istri melahirkan/keguguran</p>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user()->role == 'karyawan')
    {{-- FORM INPUT UNTUK KARYAWAN --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="font-bold mb-4 text-blue-600">Ajukan Izin Baru</h3>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
            <p class="font-bold">Waduh, ada yang salah:</p>
            <ul class="list-disc ml-5 text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="tanggal"
                        class="border p-3 rounded-xl w-full focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Tanggal Selesai</label>
                    <input type="date" name="tanggal"
                        class="border p-3 rounded-xl w-full focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Kategori</label>
                    <select name="kategori"
                        class="border p-3 rounded-xl w-full focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="Sakit">Sakit</option>
                        <option value="Izin">Izin (Keperluan Keluarga)</option>
                        <option value="Cuti">Cuti Tahunan</option>
                        <option value="Cuti">Cuti Melahirkan/Keguguran</option>
                        <option value="Cuti">Cuti Khusus</option>
                        <option value="Cuti">Cuti Duka</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Alasan</label>
                <textarea name="alasan" placeholder="Jelaskan alasan detail..."
                    class="border p-3 rounded-xl w-full focus:ring-2 focus:ring-blue-500 outline-none" rows="3"
                    required></textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Upload Bukti (Foto Surat Sakit/Dokter)</label>
                <input type="file" name="image" class="border p-2 rounded-xl w-full text-sm bg-gray-50">
                <p class="text-xs text-gray-400">*Format: JPG, PNG. Maksimal 2MB</p>
            </div>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition w-full md:w-auto">
                Kirim Pengajuan
            </button>
        </form>
    </div>
    @endif

    {{-- TABEL RIWAYAT (ADMIN & KARYAWAN) --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100 font-bold text-gray-700 uppercase text-xs">
                <tr>
                    @if(Auth::user()->role == 'admin') <th class="p-4 text-left">Karyawan</th> @endif
                    <th class="p-4 text-left">Tanggal</th>
                    <th class="p-4 text-left">Kategori</th>
                    <th class="p-4 text-left">Bukti</th>
                    <th class="p-4 text-left">Status</th>
                    @if(Auth::user()->role == 'admin') <th class="p-4 text-center">Aksi</th> @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($izins as $izin)
                <tr class="hover:bg-gray-50 transition">
                    @if(Auth::user()->role == 'admin') <td class="p-4 font-bold">{{ $izin->user->name }}</td> @endif
                    <td class="p-4">{{ $izin->tanggal }}</td>
                    <td class="p-4">{{ $izin->kategori }}</td>

                    <td class="p-4">
                        @if($izin->image)
                        <a href="{{ asset('storage/' . $izin->image) }}" target="_blank"
                            class="text-blue-600 font-medium hover:underline flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Lihat Bukti
                        </a>
                        @else
                        <span class="text-gray-400 italic">No File</span>
                        @endif
                    </td>

                    <td class="p-4">
                        <span class="px-2 py-1 rounded-md text-[10px] font-black uppercase
                            {{ $izin->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $izin->status == 'disetujui' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $izin->status == 'ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $izin->status }}
                        </span>
                    </td>

                    @if(Auth::user()->role == 'admin')
                    <td class="p-4 flex justify-center gap-2">
                        @if($izin->status == 'pending')
                        <form action="{{ route('izin.updateStatus', $izin->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="disetujui">
                            <button
                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-bold transition">Setuju</button>
                        </form>
                        <form action="{{ route('izin.updateStatus', $izin->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="ditolak">
                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-bold transition">Tolak</button>
                        </form>
                        @else
                        <span class="text-gray-400 text-[10px]">SELESAI</span>
                        @endif
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400 italic">Belum ada data pengajuan izin.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection