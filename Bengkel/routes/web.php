<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SukuCadangController;
use App\Http\Controllers\TransaksiBengkelController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('pelanggan', PelangganController::class);
Route::resource('sukuCadang', SukuCadangController::class);
Route::resource('layanan', LayananController::class);
Route::resource('transaksiBengkel', TransaksiBengkelController::class);
Route::get('/laporan/penjualan-suku-cadang', [LaporanController::class, 'penjualanSukuCadang'])->name('laporan.penjualan_suku_cadang');
Route::get('/laporan/transaksi_layanan', [LaporanController::class, 'transaksiLayanan'])->name('laporan.transaksi_layanan');
Route::get('/laporan/stok_suku_cadang', [LaporanController::class, 'stokSukuCadang'])->name('laporan.stok_suku_cadang');

require __DIR__.'/auth.php';
