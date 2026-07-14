<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\AuthController;

// ==========================================
// ROUTE AUTENTIKASI (LOGIN & REGISTER)
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// ROUTE YANG WAJIB LOGIN (DIPROTEKSI MIDDLEWARE)
// ==========================================
Route::middleware(['auth'])->group(function () {

    // Halaman Utama / Dashboard Menu
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');

    // Route Kendaraan
    Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
    Route::post('/kendaraan', [KendaraanController::class, 'store'])->name('kendaraan.store');

    // Route Servis
    Route::get('/servis', [ServisController::class, 'index'])->name('servis.index');
    Route::post('/servis', [ServisController::class, 'store'])->name('servis.store');

    // Route Tambahan untuk Update Status dan Cetak Nota
    Route::patch('/servis/{id}/update-status', [ServisController::class, 'updateStatus'])->name('servis.updateStatus');
    Route::get('/servis/{id}/cetak-nota', [ServisController::class, 'cetakNota'])->name('servis.cetakNota');

    // Route untuk Laporan Keuangan (Poin 10)
    Route::get('/laporan', [ServisController::class, 'laporanKeuangan'])->name('servis.laporan');
    
});