@extends('layout.main')

@section('title', 'Suku Cadang')

@section('content')

<div class="container-fluid">
    <div class="card mb-4 shadow-sm rounded-4">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ti ti-check"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h4 class="card-title mb-4">Daftar Suku Cadang</h4>

            <div class="d-flex justify-content-between align-items-center mb-4">
                @if (Auth::user()->role === 'A')
                    <a href="{{ route('sukuCadang.create') }}" class="btn btn-primary">
                        <i class="ti ti-tools"></i> Tambah Suku Cadang
                    </a>
                @endif

                <form action="{{ route('sukuCadang.index') }}" method="GET" class="d-flex" role="search">
                    <input type="text" name="search" class="form-control me-2"
                        placeholder="Cari Suku Cadang..." value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="ti ti-search"></i>
                    </button>
                </form>
            </div>

            <hr>

            <div class="row">
                @forelse ($sukuCadang as $item)
                    <div class="col-md-4 col-lg-3 mb-4 mt-4">
                        <div class="card h-100 shadow-sm rounded-4">
                            <img src="{{ $item['foto'] }}" class="card-img-top" alt="{{ $item['nama'] }}" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-center mb-3">{{ $item['nama'] }}</h5>

                                <div class="mb-1 d-flex">
                                    <div style="width: 90px;">Kode</div>
                                    <div style="width: 10px;">:</div>
                                    <div class="fw-bold">{{ $item['kode'] }}</div>
                                </div>

                                <div class="mb-1 d-flex">
                                    <div style="width: 90px;">Harga</div>
                                    <div style="width: 10px;">:</div>
                                    <div class="fw-bold">Rp. {{ number_format($item['harga'], 0, ',', '.') }}</div>
                                </div>

                                <div class="mb-3 d-flex">
                                    <div style="width: 90px;">Stok </div>
                                    <div style="width: 10px;">:</div>
                                    <div class="fw-bold">
                                        @if ($item['stok'] == 0)
                                            <span class="text-danger">Out of Stock</span>
                                        @else
                                            {{ $item['stok'] }}
                                        @endif
                                    </div>
                                </div>


                                <div class="text-center">
                                    @if (Auth::user()->role === 'A')
                                        <a href="{{ route('sukuCadang.edit', $item->id) }}" class="btn btn-warning btn-sm w-100 mb-1">
                                            <i class="ti ti-pencil"></i> Edit
                                        </a>
                                        <a href="{{ route('transaksiBengkel.create', ['sukuCadang_id' => $item->id]) }}" class="btn btn-success btn-sm w-100">
                                            <i class="ti ti-shopping-cart"></i> Pesan
                                        </a>
                                    @else
                                        @if ($item['stok'] > 0)
                                            <a href="{{ route('transaksiBengkel.create', ['sukuCadang_id' => $item['id']]) }}" class="btn btn-success btn-sm w-100">
                                                <i class="ti ti-shopping-cart"></i> Pesan
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Data suku cadang belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
