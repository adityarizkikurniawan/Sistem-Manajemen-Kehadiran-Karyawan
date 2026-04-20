<?php

use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

Route::prefix('pages')->group(function () {
    Route::view('/home', 'pages.home')->name('home');
    Route::view('/login', 'pages.login')->name('login');
    Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
    Route::view('/jadwal', 'pages.jadwal')->name('jadwal');
    Route::view('/izin', 'pages.izin')->name('izin');
    Route::view('/profile', 'pages.profile')->name('profile');
    Route::get('/profil/export-pdf', [PresensiController::class, 'exportPdf'])->name('profil.export_pdf');
});

Route::get('/', function () {
    return redirect()->route('home');
});