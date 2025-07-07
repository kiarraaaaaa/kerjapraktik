@extends('layout.main')

@section('title', 'Laporan Transaksi Layanan Bengkel')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Laporan Transaksi Layanan Bengkel</h3>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis Layanan</th>
                        <th>Suku Cadang Terpakai</th>
                        <th>Total Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                            <td>{{ $item->layanan->nama_layanan }}</td>
                            <td>
                                @if($item->sukuCadangs->count() > 0)
                                    <ul class="mb-0 ps-3">
                                        @foreach($item->sukuCadangs as $sc)
                                            <li>{{ $sc->nama }} ({{ $sc->pivot->jumlah }})</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-end">Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada transaksi layanan bengkel.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
