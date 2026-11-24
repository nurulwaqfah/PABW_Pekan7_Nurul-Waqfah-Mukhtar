<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;

// Halaman masyarakat
Route::get('/', [LaporanController::class, 'create'])
    ->name('laporan.create');

Route::post('/laporan', [LaporanController::class, 'store'])
    ->name('laporan.store');

// Login petugas
Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

// Logout petugas
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Halaman pengelolaan laporan khusus petugas
Route::middleware('auth')->group(function () {
    Route::resource('laporan', LaporanController::class)
        ->except(['create', 'store']);
});