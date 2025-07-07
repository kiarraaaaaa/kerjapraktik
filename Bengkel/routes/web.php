<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeranjangController;
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
    ->middleware(['auth', 'verified', 'role:A'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('role:A')->group(function () {
    Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');

});
Route::middleware('role:A,U')->group(function () {
    Route::get('/pelanggan/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('/pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.update');
});

Route::middleware('role:A,U')->group(function () {
    Route::get('/sukuCadang', [SukuCadangController::class, 'index'])->name('sukuCadang.index');
});

Route::middleware('role:A')->group(function () {
    Route::delete('sukuCadang/{id}', [SukuCadangController::class, 'destroy'])->name('sukuCadang.destroy');
    Route::get('/sukuCadang/create', [SukuCadangController::class, 'create'])->name('sukuCadang.create');
    Route::post('/sukuCadang', [SukuCadangController::class, 'store'])->name('sukuCadang.store');
    Route::get('/sukuCadang/{sukuCadang}/edit', [SukuCadangController::class, 'edit'])->name('sukuCadang.edit');
    Route::put('/sukuCadang/{sukuCadang}', [SukuCadangController::class, 'update'])->name('sukuCadang.update');
});

Route::middleware('role:A,U')->group(function () {
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
});

Route::middleware('role:A')->group(function () {
    Route::delete('layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');
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

Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{sukuCadangId}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::get('/keranjang/tambah/{sukuCadang_id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');

    // Route::post('/keranjang/update/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::post('/keranjang/{id}/update', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::post('/keranjang/hapus-terpilih', [KeranjangController::class, 'hapusTerpilih'])->name('keranjang.hapusTerpilih');

    Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

Route::get('/laporan/penjualan-suku-cadang', [LaporanController::class, 'penjualanSukuCadang'])->name('laporan.penjualan_suku_cadang');
Route::get('/laporan/transaksi_layanan', [LaporanController::class, 'transaksiLayanan'])->name('laporan.transaksi_layanan');
Route::get('/laporan/stok_suku_cadang', [LaporanController::class, 'stokSukuCadang'])->name('laporan.stok_suku_cadang');

require __DIR__.'/auth.php';
