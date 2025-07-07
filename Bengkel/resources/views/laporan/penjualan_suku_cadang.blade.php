@extends('layout.main')

@section('title', 'Laporan Penjualan Suku Cadang')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Laporan Penjualan Suku Cadang</h3>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Suku Cadang</th>
                        <th>Jumlah Terjual</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $item->nama }}</td>
                            <td class="text-center">{{ $item->total_terjual }}</td>
                            <td class="text-end">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data penjualan belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
