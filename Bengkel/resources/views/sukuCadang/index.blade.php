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

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('sukuCadang.create') }}" class="btn btn-primary">
                    <i class="ti ti-tools"></i> Tambah Suku Cadang
                </a>

                <form action="{{ route('sukuCadang.index') }}" method="GET" class="d-flex" role="search">
                    <input type="text" name="search" class="form-control me-2"
                        placeholder="Cari Suku Cadang..." value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="ti ti-search"></i>
                    </button>
                </form>
            </div>

            <div class="table-responsive rounded-4">
                <table class="table table-hover table-bordered border-primary align-middle text-center mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sukuCadang as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['kode'] }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>Rp.{{ $item['harga'] }}</td>
                                <td>{{ $item['stok'] }}</td>
                                <td>
                                    <a href="{{ route('sukuCadang.edit', $item['id']) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="ti ti-pencil"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Data Suku Cadang belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection
