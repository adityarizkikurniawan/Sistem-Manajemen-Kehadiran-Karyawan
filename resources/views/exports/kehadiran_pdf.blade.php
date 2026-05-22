<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kehadiran - {{ $user->name }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #3b82f6; color: white; padding: 10px; border: 1px solid #ddd; }
        td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 30px; text-align: right; font-size: 10px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin-bottom: 5px;">LAPORAN KEHADIRAN KARYAWAN</h1>
        <p style="margin: 0;">Sistem Manajemen Kehadiran - PBL Team</p>
    </div>

    <div class="info">
        <p><strong>Nama Karyawan:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Dicetak pada:</strong> {{ date('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Tanggal</th>
                <th width="20%">Jam Masuk</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($presensi as $key => $p)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d F Y') }}</td>
                <td>{{ $p->jam_masuk ?? '--:--' }}</td>
                <td>{{ $p->keterangan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">Belum ada data kehadiran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dihasilkan secara otomatis oleh sistem.</p>
    </div>
</body>
</html>