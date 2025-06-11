<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('role:A')->group(function () {
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
});

Route::middleware('role:A')->group(function () {
    Route::get('/pelanggan/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('/pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
});

Route::middleware('role:A,U')->group(function () {
    Route::get('/sukuCadang', [SukuCadangController::class, 'index'])->name('sukuCadang.index');
});

Route::middleware('role:A')->group(function () {
    Route::get('/sukuCadang/create', [SukuCadangController::class, 'create'])->name('sukuCadang.create');
    Route::post('/sukuCadang', [SukuCadangController::class, 'store'])->name('sukuCadang.store');
    Route::get('/sukuCadang/{sukuCadang}/edit', [SukuCadangController::class, 'edit'])->name('sukuCadang.edit');
    Route::put('/sukuCadang/{sukuCadang}', [SukuCadangController::class, 'update'])->name('sukuCadang.update');
});

Route::middleware('role:A,U')->group(function () {
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
});

Route::middleware('role:A')->group(function () {
    Route::get('/layanan/create', [LayananController::class, 'create'])->name('layanan.create');
    Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
    Route::get('/layanan/{layanan}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
    Route::put('/layanan/{layanan}', [LayananController::class, 'update'])->name('layanan.update');
});

Route::middleware('role:A,U')->group(function () {
    Route::get('/transaksiBengkel', [TransaksiBengkelController::class, 'index'])->name('transaksiBengkel.index');
    Route::get('/transaksiBengkel/create', [TransaksiBengkelController::class, 'create'])->name('transaksiBengkel.create');
    Route::post('/transaksiBengkel', [TransaksiBengkelController::class, 'store'])->name('transaksiBengkel.store');
    Route::get('/transaksi-bengkel/{id}', [TransaksiBengkelController::class, 'show'])->name('transaksiBengkel.show');
});

Route::middleware('role:A')->group(function () {
    Route::get('/transaksiBengkel/{transaksiBengkel}/edit', [LayananController::class, 'edit'])->name('transaksiBengkel.edit');
    Route::put('/transaksiBengkel/{transaksiBengkel}', [LayananController::class, 'update'])->name('transaksiBengkel.update');
});
// Route::resource('pelanggan', PelangganController::class);
// Route::resource('sukuCadang', SukuCadangController::class);
// Route::resource('layanan', LayananController::class);
//Route::resource('transaksiBengkel', TransaksiBengkelController::class);
Route::get('/laporan/penjualan-suku-cadang', [LaporanController::class, 'penjualanSukuCadang'])->name('laporan.penjualan_suku_cadang');
Route::get('/laporan/transaksi_layanan', [LaporanController::class, 'transaksiLayanan'])->name('laporan.transaksi_layanan');
Route::get('/laporan/stok_suku_cadang', [LaporanController::class, 'stokSukuCadang'])->name('laporan.stok_suku_cadang');

require __DIR__.'/auth.php';
