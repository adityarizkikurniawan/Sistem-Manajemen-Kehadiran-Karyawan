<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Presensi Bulan Ini</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #1e293b; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #cbd5e1; padding: 10px; text-align: left; }
        th { background-color: #f8fafc; font-weight: bold; text-transform: uppercase; font-size: 10px; tracking: 0.1em; }
        .header { text-align: center; margin-bottom: 30px; }
        .nama-bulan { text-transform: uppercase; font-weight: bold; color: #2563eb; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN RIWAYAT PRESENSI BULANAN</h2>
        <p>Periode: <span class="nama-bulan">{{ \Carbon\Carbon::create()->month($bulanSekarang)->translatedFormat('F') }} {{ $tahunSekarang }}</span></p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                {{-- REKAP KHUSUS ADMIN: TAMBAH KOLOM KARYAWAN & DIVISI --}}
                @if(Auth::user()->role == 'admin')
                    <th>Karyawan</th>
                    <th>Divisi</th>
                @endif
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataPresensi as $key => $presensi)
            <tr>
                <td>{{ $key + 1 }}</td>
                {{-- REKAP KHUSUS ADMIN: TAMPILKAN DATA KARYAWAN & DIVISI --}}
                @if(Auth::user()->role == 'admin')
                    <td style="font-weight: bold;">{{ $presensi->user->name ?? 'User Terhapus' }}</td>
                    <td>{{ strtoupper($presensi->user->divisi ?? 'Belum Set') }}</td>
                @endif
                <td>{{ \Carbon\Carbon::parse($presensi->tanggal)->translatedFormat('d F Y') }}</td>
                <td>{{ $presensi->jam_masuk ?? '--:--' }}</td>
                <td>{{ $presensi->jam_pulang ?? '--:--' }}</td> 
            </tr>
            @empty
            <tr>
                {{-- JIKA ADMIN COLSPAN JADI 6, JIKA KARYAWAN TETAP 4 --}}
                <td colspan="{{ Auth::user()->role == 'admin' ? '6' : '4' }}" style="text-align: center; padding: 20px; color: #94a3b8;">
                    Tidak ada data presensi pada bulan ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>