<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiBengkel;
use App\Models\SukuCadang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    // Laporan Penjualan Suku Cadang
    public function penjualanSukuCadang()
    {
        $laporan = DB::table('transaksi_suku_cadangs')
            ->join('suku_cadangs', 'transaksi_suku_cadangs.suku_cadang_id', '=', 'suku_cadangs.id')
            ->select(
                DB::raw('DATE(transaksi_suku_cadangs.created_at) as tanggal'),
                'suku_cadangs.nama',
                DB::raw('SUM(transaksi_suku_cadangs.jumlah) as total_terjual'),
                DB::raw('SUM(transaksi_suku_cadangs.subtotal) as total_pendapatan')
            )
            ->groupBy('tanggal', 'suku_cadangs.nama')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('laporan.penjualan_suku_cadang', compact('laporan'));
    }

    // Laporan Transaksi Layanan Bengkel
    public function transaksiLayanan()
    {
        $laporan = TransaksiBengkel::with('layanan', 'sukuCadangs')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('laporan.transaksi_layanan', compact('laporan'));
    }

    // Laporan Stok Suku Cadang
    public function stokSukuCadang()
    {
        $sukuCadangs = SukuCadang::all();

        return view('laporan.stok_suku_cadang', compact('sukuCadangs'));
    }
}
