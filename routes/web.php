<?php
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

// Halaman Daftar Kehadiran
Route::get('/presensi', [PresensiController::class, 'index']);
// Tambahkan ini di routes/web.php
Route::view('/home', 'home');
Route::view('/dashboard', 'dashboard');
Route::view('/product', 'product');