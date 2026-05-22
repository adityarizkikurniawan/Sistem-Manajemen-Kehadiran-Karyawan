<?php

use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KaryawanController; 
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\ProfilController;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::prefix('pages')->group(function () {
    
    Route::view('/home', 'pages.home')->name('home');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');

    // akses login
    Route::middleware(['auth'])->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::view('/jadwal', 'pages.jadwal')->name('jadwal');
        Route::view('/profile', 'pages.profile')->name('profile');

        Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');

        Route::get('/admin/profil-karyawan/{id}', [ProfilController::class, 'show'])->name('admin.user.profile');

        // Izin
        Route::get('/izin', [IzinController::class, 'index'])->name('izin');
        Route::post('/izin/store', [IzinController::class, 'store'])->name('izin.store');
        Route::patch('/izin/{id}/status', [IzinController::class, 'updateStatus'])->name('izin.updateStatus');

        // Presensi & Export
        Route::get('/presensi/rekap', [PresensiController::class, 'rekap'])->name('presensi.rekap'); // TAMBAHKAN INI
        Route::get('/profil/export-pdf', [PresensiController::class, 'exportPdf'])->name('profil.export_pdf');
        Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
        Route::put('/presensi/update/{id}', [PresensiController::class, 'updateStatus'])->name('presensi.update');

        // Manajemen Karyawan
        Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('/karyawan/tambah', [KaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('/karyawan/simpan', [KaryawanController::class, 'store'])->name('karyawan.store');

        // Logout
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        // Rekap
        Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
    });
});

Route::get('/paksa-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return "Berhasil Logout! Silakan balik ke halaman login.";
});