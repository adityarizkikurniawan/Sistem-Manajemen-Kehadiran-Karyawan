<!DOCTYPE html>
<html>

<head>
    <title>Laporan Kehadiran</title>
    <style>
    body {
        font-family: sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Kehadiran Bulanan</h2>
        <p>Bulan: {{ $bulan }} | Tahun: {{ $tahun }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataPresensi as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->jam_masuk }}</td>
                <td>{{ $item->jam_pulang ?? '-' }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>