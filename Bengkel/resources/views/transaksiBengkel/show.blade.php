@extends('layout.main')

@section('title', 'Detail Transaksi')

@section('content')
<div class="col-8 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Detail Transaksi</h4>

            <div class="mb-3">
                <strong>Nama Costumer : </strong>
                <p>{{ $transaksi['nama'] }}</p>
            </div>

            <div class="mb-3" >
                <strong>Tanggal : </strong>
                <p>{{ $transaksi['created_at']->format('d-m-Y') }}</p>
            </div>

            <div class="mb-3">
                <strong>Layanan:</strong>
                <p>{{ $transaksi->layanan->nama_layanan }} - Rp{{ number_format($transaksi->layanan->biaya, 0, ',', '.') }}</p>
            </div>

            <div class="mb-3">
                <strong>Total Biaya:</strong>
                <p>Rp{{ number_format($transaksi->total_biaya, 0, ',', '.') }}</p>
            </div>

            <div class="mb-3">
                <strong>Suku Cadang:</strong>
                @if ($transaksi->sukuCadangs->isEmpty())
                    <p>Tidak ada suku cadang.</p>
                @else
                    <ul>
                        @foreach($transaksi['sukuCadangs'] as $item)
                            <li>
                                {{ $item->nama }} - Rp{{ number_format($item->harga, 0, ',', '.') }} x {{ $item->pivot->jumlah }} = Rp{{ number_format($item->pivot->subtotal, 0, ',', '.') }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('transaksiBengkel.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
