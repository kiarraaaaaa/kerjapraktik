@extends('layout.main')

@section('title', "Laporan Transaksi Layanan Bengkel")

@section('content')
<div class="container my-4">
  <div class="card shadow rounded-3">
    <div class="card-body">
      <h2 class="mb-4 fw-bold text-primary">Laporan Transaksi Layanan Bengkel</h2>

      <div class="table-responsive border rounded-2">
        <table class="table text-nowrap mb-0 align-middle">
          <thead class="text-dark fs-5 bg-light">
            <tr>
              <th><h6 class="fs-5 fw-semibold mb-0 text-center">Tanggal</h6></th>
              <th><h6 class="fs-5 fw-semibold mb-0 text-center">Jenis Layanan</h6></th>
              <th><h6 class="fs-5 fw-semibold mb-0 text-center">Suku Cadang Terpakai</h6></th>
              <th><h6 class="fs-5 fw-semibold mb-0 text-center">Total Transaksi</h6></th>
            </tr>
          </thead>
          <tbody>
            @foreach($laporan as $item)
            <tr>
              <td class="text-center">
                <p class="mb-0 fw-normal fs-5">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</p>
              </td>
              <td class="text-center">
                <h6 class="fs-5 fw-semibold mb-0">{{ $item->layanan->nama_layanan }}</h6>
              </td>
              <td class="text-center">
                @if($item->sukuCadangs->count() > 0)
                  @foreach($item->sukuCadangs as $sc)
                    <span class="d-block">{{ $sc->nama }} ({{ $sc->pivot->jumlah }})</span>
                  @endforeach
                @else
                  <span>-</span>
                @endif
              </td>
              <td class="text-center">
                <h6 class="fs-5 fw-semibold mb-0 text-success">Rp. {{ number_format($item->total_biaya) }}</h6>
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
