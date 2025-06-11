<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBengkel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
         $totalTransaksi = TransaksiBengkel::count();
        $totalPendapatan = TransaksiBengkel::whereMonth('created_at', now()->month)->sum('total_biaya');
        $recentTransaksi = TransaksiBengkel::latest()->take(5)->get();

        // Pendapatan per bulan (1-12)
        $pendapatanBulanan = [];
        $bulan = [];

        for ($i = 1; $i <= 12; $i++) {
            $pendapatan = TransaksiBengkel::whereMonth('created_at', $i)->whereYear('created_at', now()->year)->sum('total_biaya');
            $pendapatanBulanan[] = $pendapatan;
            $bulan[] = Carbon::create()->month($i)->translatedFormat('F'); // Nama bulan dalam Bahasa Indonesia
        }

        return view('dashboard', compact(
            'totalTransaksi',
            'totalPendapatan',
            'recentTransaksi',
            'pendapatanBulanan',
            'bulan'
        ));
    }
}
