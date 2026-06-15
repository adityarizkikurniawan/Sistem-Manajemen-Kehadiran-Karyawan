<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Data Karyawan</title>
    <style>
        /* Gaya CSS Khusus DomPDF agar layout stabil dan tidak berantakan */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #334155;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #64748b;
            font-size: 11px;
        }
        .meta-info {
            margin-bottom: 20px;
            font-size: 11px;
        }
        .meta-info table {
            width: 100%;
        }
        .meta-info td {
            padding: 2px 0;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table-data th {
            background-color: #0f172a;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px;
            border: 1px solid #1e293b;
            text-align: left;
        }
        .table-data td {
            padding: 10px;
            border: 1px solid #e2e8f0;
        }
        .table-data tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .badge {
            display: inline-block;
            padding: 3px 6px;
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1d4ed8;
            font-weight: bold;
            font-size: 9px;
            border-radius: 4px;
            text-transform: uppercase;
        }
        .footer-date {
            text-align: right;
            margin-top: 40px;
            font-size: 10px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Sistem Manajemen Kehadiran</h2>
        <p>Laporan Resmi Rekapitulasi Data Staf Karyawan Perusahaan</p>
    </div>

    <div class="meta-info">
        <table>
            <tr>
                <td style="width: 12%;"><strong>Kriteria Cetak</strong></td>
                <td style="width: 2%;">:</td>
                <td>
                    {{ $request->filter_divisi ? 'Divisi ' . strtoupper($request->filter_divisi) : 'Semua Divisi Karyawan' }}
                </td>
                <td style="text-align: right; color: #64748b;">
                    Total Karyawan: <strong>{{ $karyawan->count() }} Orang</strong>
                </td>
            </tr>
        </table>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 35%;">Nama Karyawan</th>
                <th style="width: 35%;">Alamat Email</th>
                <th style="width: 25%;">Divisi Kerja</th>
            </tr>
        </thead>
        <tbody>
            @forelse($karyawan as $index => $k)
            <tr>
                <td style="text-align: center; color: #64748b;">{{ $index + 1 }}</td>
                <td style="font-weight: bold; color: #1e293b;">{{ $k->name }}</td>
                <td>{{ $k->email }}</td>
                <td>
                    @if($k->divisi)
                        <span class="badge">{{ $k->divisi }}</span>
                    @else
                        <span style="color: #94a3b8; italic">- Belum Set -</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #94a3b8; padding: 20px;">
                    Tidak ada data karyawan yang terdaftar pada kriteria divisi ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-date">
        Dokumen diunduh otomatis pada: {{ now()->format('d F Y, H:i') }} WIB
    </div>

</body>
</html>