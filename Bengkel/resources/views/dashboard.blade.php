@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid mt-4">
    <h3 class="mb-4">Dashboard</h3>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Total Transaksi</h6>
                    <h3 class="card-text">{{ $totalTransaksi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Pendapatan Bulan Ini</h6>
                    <h3 class="card-text">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Pendapatan Bulanan --}}
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Grafik Pendapatan Tahunan</h5>
            <canvas id="pendapatanChart" height="100"></canvas>
        </div>
    </div>
</div>

{{-- Script Chart.js langsung di sini --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pendapatanChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bulan) !!},
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: {!! json_encode($pendapatanBulanan) !!},
                backgroundColor: '#0d6efd',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>

@endsection
