<?php
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

// Halaman Daftar Kehadiran
Route::get('/presensi', [PresensiController::class, 'index']);