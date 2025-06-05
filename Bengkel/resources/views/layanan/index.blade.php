@extends('layout.main')

@section('title', 'Layanan Bengkel')

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

            <h4 class="card-title mb-4">Daftar Layanan Bengkel</h4>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('layanan.create') }}" class="btn btn-primary">
                    <i class="ti ti-car"></i> Tambah Layanan
                </a>

                <form action="{{ route('layanan.index') }}" method="GET" class="d-flex" role="search">
                    <input type="text" name="search" class="form-control me-2"
                        placeholder="Cari Layanan Bengkel..." value="{{ request('search') }}">
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
                            <th>Nama Layanan</th>
                            <th>Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($layanan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['nama_layanan'] }}</td>
                                <td>Rp.{{ $item['biaya'] }}</td>
                                <td>
                                    <a href="{{ route('layanan.edit', $item['id']) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="ti ti-pencil"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Data Layanan Bengkel belum tersedia.
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
