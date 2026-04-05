<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Presensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Admin Panel Presensi</span>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Hadir Hari Ini</h5>
                        <p class="card-text fs-2 fw-bold">45 Orang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Izin/Sakit</h5>
                        <p class="card-text fs-2 fw-bold">3 Orang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Tanpa Keterangan</h5>
                        <p class="card-text fs-2 fw-bold">2 Orang</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-white fw-bold">Log Kehadiran Terbaru</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Waktu Masuk</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Aditya Rizki</td>
                            <td>07:55 WIB</td>
                            <td><span class="badge bg-success">Tepat Waktu</span></td>
                        </tr>
                        <tr>
                            <td>Samuel Ambar</td>
                            <td>08:15 WIB</td>
                            <td><span class="badge bg-warning text-dark">Terlambat</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="/home" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>
</html>