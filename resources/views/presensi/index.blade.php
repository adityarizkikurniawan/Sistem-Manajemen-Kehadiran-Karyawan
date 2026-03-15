<!-- resources/views/presensi/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kehadiran</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        .status-late { color: red; font-weight: bold; }
        .status-on-time { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Log Kehadiran Karyawan - PBL Team</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Jam Masuk</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataKehadiran as $log)
            <tr>
                <td>{{ $log['nama'] }}</td>
                <td>{{ $log['jam_masuk'] }}</td>
                <td class="{{ $log['status'] == 'Terlambat' ? 'status-late' : 'status-on-time' }}">
                    {{ $log['status'] }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>