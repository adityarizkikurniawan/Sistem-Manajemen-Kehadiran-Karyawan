@extends('layouts.app')

@section('title', 'Manajemen Izin / Ketidakhadiran')

@section('content')
<div class="space-y-8">
    <div
        class="relative overflow-hidden bg-slate-900 border border-white/5 rounded-3xl shadow-xl min-h-[180px] flex items-center">

        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/60 to-transparent z-10"></div>
            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&q=80&w=1000"
                class="w-full h-full object-cover object-center grayscale-[30%] opacity-50"
                alt="Leave Management Decoration">
        </div>

        <!-- Konten Header -->
        <div class="relative z-20 p-8 w-full">
            <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em]">Absensi & Leave
                Management</span>
            <h2 class="text-3xl font-extrabold text-white mt-1">Manajemen Izin & Ketidakhadiran</h2>
            <p class="text-slate-400 text-sm mt-2 max-w-xl">Kelola pengajuan cuti, sakit, dan izin dalam satu pintu
                dengan sistem approval yang terintegrasi.</p>
        </div>
    </div>

    @if(Auth::user()->role == 'karyawan')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-slate-900 border border-white/5 p-8 rounded-3xl shadow-2xl relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-600/10 rounded-full blur-3xl"></div>

                <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-3">
                    <div class="p-2 bg-blue-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    Informasi Kuota Cuti
                </h3>

                <div class="space-y-5">
                    <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Sisa Cuti Saat Ini
                        </p>
                        <h4 class="text-3xl font-black text-white mt-1">
                            {{ $user->sisa_cuti }}
                            <span class="text-xs font-medium text-slate-500">Hari</span>
                        </h4>
                    </div>

                    <div class="grid grid-cols-1 gap-3 text-[11px]">
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-slate-400">Cuti Tahunan</span>
                            <span class="text-white font-bold">{{ $user->sisa_cuti }} Hari</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-slate-400">Cuti Duka</span>
                            <span class="text-white font-bold">2 Hari</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-slate-400">Melahirkan</span>
                            <span class="text-white font-bold">3 Bulan</span>
                        </div>
                    </div>

                    <div class="bg-blue-500/5 p-4 rounded-xl">
                        <p class="text-[10px] font-bold text-blue-400 uppercase mb-2">Cuti Khusus (4 Hari):</p>
                        <ul class="text-[10px] text-slate-400 space-y-1 list-disc ml-3">
                            <li>Menikah / Menikahkan anak</li>
                            <li>Khitan / Baptis anak</li>
                            <li>Istri melahirkan / keguguran</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div
                class="relative overflow-hidden rounded-3xl bg-slate-900 border border-white/5 flex flex-col lg:flex-row min-h-[450px] shadow-2xl">
                <div class="w-full lg:w-3/5 p-8 z-20">
                    <h3 class="font-bold text-white text-lg mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                        Ajukan Izin Baru
                    </h3>
                    @if ($errors->any())
                    <div class="bg-red-500/20 border border-red-500/50 p-4 rounded-xl mb-4 text-[10px] text-red-200">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('success'))
                    <div
                        class="bg-green-500/20 border border-green-500/50 p-4 rounded-xl mb-4 text-[10px] text-green-200">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-5">
                        @csrf

                        {{-- Kategori --}}
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-500 uppercase ml-1">
                                Kategori Izin
                            </label>

                            <select name="kategori" id="kategori"
                                class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-1 focus:ring-blue-500 outline-none"
                                required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Cuti Tahunan">Cuti Tahunan</option>
                                <option value="Cuti Duka">Cuti Duka</option>
                                <option value="Cuti Khusus">Cuti Khusus</option>

                                @if($user->jenis_kelamin == 'Perempuan' && $user->status_pernikahan == 'Menikah')
                                <option value="Cuti Melahirkan">
                                    Cuti Melahirkan
                                </option>
                                @endif
                            </select>
                        </div>

                        {{-- Tanggal --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-500 uppercase ml-1">
                                    Mulai
                                </label>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai" style="color-scheme: dark;"
                                    class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-1 focus:ring-blue-500 outline-none"
                                    required>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-500 uppercase ml-1">
                                    Selesai
                                </label>

                                <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                    style="color-scheme: dark;"
                                    class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-1 focus:ring-blue-500 outline-none"
                                    required>
                            </div>
                        </div>

                        {{-- Alasan --}}
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-500 uppercase ml-1">
                                Alasan
                            </label>

                            <textarea name="alasan" rows="3" placeholder="Tulis alasan..."
                                class="w-full bg-slate-950 border border-white/10 rounded-xl p-4 text-sm text-white focus:ring-1 focus:ring-blue-500 outline-none placeholder:text-slate-700"
                                required></textarea>
                        </div>

                        {{-- Upload + Submit --}}
                        <div class="flex flex-col sm:flex-row gap-4 pt-2">

                            <div class="flex-1">
                                <input type="file" name="image" class="hidden" id="fileInput">
                                <label for="fileInput"
                                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-[10px] text-slate-400 flex items-center justify-center gap-2 cursor-pointer hover:bg-white/10 transition">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    UPLOAD BUKTI
                                </label>
                            </div>
                            <button type="submit"
                                class="w-full sm:w-auto bg-blue-600 hover:bg-blue-500 text-white px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition shadow-lg shadow-blue-600/20">
                                KIRIM
                            </button>
                        </div>
                    </form>
                </div>

                <div class="hidden lg:block w-2/5 relative overflow-hidden border-l border-white/5">
                    <div class="absolute inset-0 z-10 bg-gradient-to-r from-slate-900 via-transparent to-transparent">
                    </div>
                    <img id="categoryPreviewImg"
                        src="https://images.unsplash.com/photo-1584515933487-779824d29309?q=80&w=1000"
                        class="h-full w-full object-cover transition-all duration-500 ease-in-out brightness-[0.6] grayscale-[20%]"
                        alt="Preview">
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--Table Riwayat -->
    <div class="bg-slate-900 border border-white/5 rounded-3xl shadow-2xl overflow-hidden backdrop-blur-md mt-2">
        <div class="p-6 border-b border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-white text-base tracking-tight flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-blue-500 rounded-full"></span>
                    Riwayat Pengajuan Perizinan
                </h3>
                <p class="text-[11px] text-slate-500 mt-0.5">Daftar masuk log perizinan, cuti, dan sakit seluruh staff
                </p>
            </div>
            <span
                class="text-[10px] font-black text-blue-400 bg-blue-500/10 border border-blue-500/20 px-3 py-1.5 rounded-xl uppercase tracking-widest self-start sm:self-center shadow-lg shadow-blue-500/5">
                Total: {{ $izins->count() }} Perizinan
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[800px]">
                <thead
                    class="bg-white/[0.02] font-bold text-slate-400 uppercase text-[10px] tracking-[0.15em] border-b border-white/5">
                    <tr>
                        @if(Auth::user()->role == 'admin')
                        <th class="p-5 text-left font-bold text-slate-400">Karyawan</th>
                        @endif
                        <th class="p-5 text-left font-bold text-slate-400">Periode Tanggal</th>
                        <th class="p-5 text-left font-bold text-slate-400">Kategori</th>
                        <th class="p-5 text-left font-bold text-slate-400">Bukti Dokumen</th>
                        <th class="p-5 text-center font-bold text-slate-400">Status Approval</th>
                        @if(Auth::user()->role == 'admin')
                        <th class="p-5 text-center font-bold text-slate-400">Aksi Kendali</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($izins as $izin)
                    <tr class="hover:bg-white/[0.02] transition-all duration-200 group">
                        @if(Auth::user()->role == 'admin')
                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-xl bg-gradient-to-br from-blue-500/20 to-indigo-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 font-black text-xs">
                                    {{ strtoupper(substr($izin->user->name ?? 'U', 0, 2)) }}
                                </div>
                                <div>
                                    <span
                                        class="text-white font-bold block text-sm tracking-tight group-hover:text-blue-400 transition">{{ $izin->user->name }}</span>
                                    <span class="text-[10px] text-slate-500 font-medium flex items-center gap-1 mt-0.5">
                                        <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                        {{ strtoupper($izin->user->divisi?->nama_divisi ?? 'BELUM SET') }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        @endif

                        <td class="p-5">
                            <div
                                class="flex items-center gap-2 text-slate-300 font-mono text-xs font-semibold bg-white/[0.02] border border-white/5 px-3 py-1.5 rounded-xl w-fit">
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M') }}
                                -
                                {{ \Carbon\Carbon::parse($izin->tanggal_selesai)->format('d M Y') }}
                            </div>
                        </td>

                        <td class="p-5">
                            <span
                                class="font-bold px-3 py-1.5 rounded-xl text-[10px] uppercase tracking-wider shadow-sm
                                {{ $izin->kategori == 'Sakit' ? 'bg-red-500/10 text-red-400 border border-red-500/20' : '' }}
                                {{ $izin->kategori == 'Izin' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : '' }}
                                {{ str_contains($izin->kategori, 'Cuti') ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : '' }}">
                                {{ $izin->kategori }}
                            </span>
                        </td>

                        <td class="p-5">
                            @if($izin->image)
                            <a href="{{ asset('storage/' . $izin->image) }}" target="_blank"
                                class="text-slate-400 hover:text-white font-black flex items-center gap-2 transition group/btn w-fit">
                                <div
                                    class="p-2 bg-white/5 rounded-xl group-hover/btn:bg-blue-600 border border-white/5 group-hover/btn:border-blue-500 transition shadow-md">
                                    <svg class="w-3.5 h-3.5 text-blue-400 group-hover/btn:text-white transition"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat Bukti
                                </div>
                                <span class="text-[10px] tracking-widest font-black uppercase">PREVIEW</span>
                            </a>
                            @else
                            <div
                                class="flex items-center gap-1.5 text-slate-600 italic text-[11px] px-2 py-1 bg-white/[0.01] border border-dashed border-white/5 rounded-lg w-fit">
                                <svg class="w-3.5 h-3.5 text-slate-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                    </path>
                                </svg>
                                No File Attached
                            </div>
                            @endif
                        </td>

                        <td class="p-5 text-center">
                            <span
                                class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-wider shadow-sm border
                                {{ $izin->status == 'pending' ? 'bg-amber-500/10 text-amber-400 border-amber-500/20' : '' }}
                                {{ $izin->status == 'disetujui' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : '' }}
                                {{ $izin->status == 'ditolak' ? 'bg-rose-500/10 text-rose-400 border-rose-500/20' : '' }}">
                                {{ ucfirst($izin->status) }}
                            </span>
                        </td>

                        @if(Auth::user()->role == 'admin')
                        <td class="p-5">
                            <div class="flex justify-center items-center gap-2">
                                @if($izin->status == 'pending')
                                <form action="{{ route('izin.updateStatus', $izin->id) }}" method="POST" class="m-0">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="disetujui">
                                    <button
                                        class="bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-white border border-emerald-500/20 px-3.5 py-2 rounded-xl text-[10px] font-black transition-all duration-200 uppercase tracking-wider shadow-md shadow-emerald-500/5 cursor-pointer">
                                        Setuju
                                    </button>
                                </form>
                                <form action="{{ route('izin.updateStatus', $izin->id) }}" method="POST" class="m-0">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button
                                        class="bg-rose-500/10 hover:bg-rose-500 text-rose-400 hover:text-white border border-rose-500/20 px-3.5 py-2 rounded-xl text-[10px] font-black transition-all duration-200 uppercase tracking-wider shadow-md shadow-rose-500/5 cursor-pointer">
                                        Tolak
                                    </button>
                                </form>
                                @else
                                <div
                                    class="flex items-center gap-1.5 bg-white/[0.03] border border-white/5 text-slate-500 px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest shadow-inner">
                                    <svg class="w-3.5 h-3.5 text-slate-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Processed
                                </div>
                                @endif
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role == 'admin' ? '6' : '4' }}" class="p-16 text-center">
                            <div class="flex flex-col items-center opacity-30">
                                <div class="p-4 bg-white/5 border border-white/5 rounded-2xl mb-3">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 00-2 2H6a2 2 0 00-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-slate-400 italic text-sm font-medium">Belum ada data riwayat pengajuan
                                    izin.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endsection

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategori = document.getElementById('kategori');
        const previewImg = document.getElementById('categoryPreviewImg');

        const categoryImages = {
            'Sakit': 'https://images.unsplash.com/photo-1584515933487-779824d29309?q=80&w=1000',
            'Cuti Khusus': 'https://img.magnific.com/fotos-premium/mano-que-sostiene-papel-familia-cortado-superficie-tela_54178-2418.jpg',
            'Cuti Tahunan': 'https://imagedelivery.net/2MtOYVTKaiU0CCt-BLmtWw/c0c2c991-f11e-44d3-b503-9b8dfbed4800/w=2481',
            'Cuti Duka': 'https://awsimages.detik.net.id/visual/2021/02/26/ilustrasi-duka-cita-foto-istockphotorealpeoplegroup_169.png?w=650&q=80',
            'Cuti Melahirkan': 'https://png.pngtree.com/element_our/png/20181213/deliverytimebabybirthchild-line-icon--vector-isolated-il-png_267883.jpg'
        };

        kategori.addEventListener('change', function() {

            const selected = this.value;

            previewImg.style.opacity = '0';

            setTimeout(() => {

                previewImg.src = categoryImages[selected] || categoryImages['Sakit'];

                previewImg.style.opacity = '1';

            }, 300);

        });

        const mulai = document.getElementById('tanggal_mulai');
        const selesai = document.getElementById('tanggal_selesai');

        const sisaCuti = {{ $user->sisa_cuti }};

        kategori.addEventListener('change', function () {

            selesai.value = '';

            selesai.readOnly = false;

            if (mulai.value) {
                aturTanggal();
            }
        });

        mulai.addEventListener('change', function(){
            aturTanggal();
        });

        const aturanKategori = {
            "Sakit": {
                allowPast: true,
                readonly: false
            },

            "Cuti Tahunan": {
                hari: sisaCuti,
                readonly: false,
                allowPast: false
            },

            "Cuti Duka": {
                hari: 2,
                readonly: true,
                allowPast: false
            },

            "Cuti Khusus": {
                hari: 4,
                readonly: true,
                allowPast: false
            },

            "Cuti Melahirkan": {
                bulan: 3,
                readonly: true,
                allowPast: false
            }
        };

        function aturTanggal() {

            if (!mulai.value) return;
            let start = new Date(mulai.value);
            let end = new Date(start);
            selesai.readOnly = false;

            switch (kategori.value) {
                case 'Sakit':
                    selesai.value = '';
                    selesai.readOnly = false;
                    break;

                case 'Cuti Tahunan':
                    end.setDate(end.getDate() + (sisaCuti - 1));
                    selesai.value = formatTanggal(end);
                    selesai.readOnly = false;
                    break;

                case 'Cuti Duka':
                    end.setDate(end.getDate() + 1);
                    selesai.value = formatTanggal(end);
                    selesai.readOnly = true;
                    break;

                case 'Cuti Khusus':
                    end.setDate(end.getDate() + 3);
                    selesai.value = formatTanggal(end);
                    selesai.readOnly = true;
                    break;

                case 'Cuti Melahirkan':
                    end.setMonth(end.getMonth() + 3);
                    end.setDate(end.getDate() - 1);
                    selesai.value = formatTanggal(end);
                    selesai.readOnly = true;
                    break;
            }
        }

        function formatTanggal(date) {

            let y = date.getFullYear();
            let m = ('0' + (date.getMonth() + 1)).slice(-2);
            let d = ('0' + date.getDate()).slice(-2);

            return `${y}-${m}-${d}`;
        }

    });
    </script>