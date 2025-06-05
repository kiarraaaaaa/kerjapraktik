<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SukuCadangController;
use App\Http\Controllers\TransaksiBengkelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});

Route::resource('pelanggan', PelangganController::class);
Route::resource('sukuCadang', SukuCadangController::class);
Route::resource('layanan', LayananController::class);
Route::resource('transaksiBengkel', TransaksiBengkelController::class);
Route::get('/laporan/penjualan-suku-cadang', [LaporanController::class, 'penjualanSukuCadang'])->name('laporan.penjualan_suku_cadang');
Route::get('/laporan/transaksi_layanan', [LaporanController::class, 'transaksiLayanan'])->name('laporan.transaksi_layanan');
