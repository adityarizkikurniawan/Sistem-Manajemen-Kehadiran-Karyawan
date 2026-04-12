<?php
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

// Halaman Daftar Kehadiran
Route::get('/presensi', [PresensiController::class, 'index']);

Route::view('/home', 'home');
Route::view('/dashboard', 'dashboard');
Route::view('/product', 'product');
Route::get('/app', function () 
{
    return view('app');
});