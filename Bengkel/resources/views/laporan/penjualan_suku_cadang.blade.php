@extends('layout.main')

@section('title', "Laporan Penjualan Suku Cadang")

@section('content')
<div class="container my-4">
  <div class="card shadow rounded-3">
    <div class="card-body">
      <h2 class="mb-4 fw-bold text-primary">Laporan Penjualan Suku Cadang</h2>

      <div class="table-responsive border rounded-2">
        <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-5 bg-light">
                <tr>
                    <th><h6 class="fs-5 fw-semibold mb-0 text-center">Tanggal</h6></th>
                    <th><h6 class="fs-5 fw-semibold mb-0 text-center">Nama Suku Cadang</h6></th>
                    <th><h6 class="fs-5 fw-semibold mb-0 text-center">Jumlah Terjual</h6></th>
                    <th><h6 class="fs-5 fw-semibold mb-0 text-center">Total Pendapatan</h6></th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $item)
                <tr>
                    <td class="text-center">
                        <p class="mb-0 fw-normal fs-5">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</p>
                    </td>
                    <td class="text-center">
                        <h6 class="fs-5 fw-semibold mb-0 text-center">{{ $item->nama }}</h6>
                    </td>
                    <td class="text-center">
                        <h6 class="fs-5 fw-semibold mb-0">{{ $item->total_terjual }}</h6>
                    </td>
                    <td class="text-center">
                        <h6 class="fs-5 fw-semibold mb-0 text-success">Rp. {{ number_format($item->total_pendapatan) }}</h6>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection
