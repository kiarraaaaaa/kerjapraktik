@extends('layout.main')

@section('title', 'Pelanggan')

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

            <h4 class="card-title mb-4">Daftar Pelanggan</h4>

            <div class="d-flex justify-content-between align-items-center mb-3">

                <form action="{{ route('pelanggan.index') }}" method="GET" class="d-flex" role="search">
                    <input type="text" name="search" class="form-control me-2"
                        placeholder="Cari pelanggan..." value="{{ request('search') }}">
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
                            <th>Nama</th>
                            <th>email</th>
                            <th>No Hp</th>
                            <th>Alamat</th>
                            <th>Kendaraan</th>
                            @if (Auth::user()->role === 'A')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>{{ $item['nohp'] }}</td>
                                <td>{{ $item['alamat'] }}</td>
                                <td>{{ $item['kendaraan'] }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        @if (Auth::user()->role === 'A')
                                            <a href="{{ route('pelanggan.edit', $item['id']) }}" class="btn btn-sm btn-warning">
                                                <i class="ti ti-pencil"></i> Edit
                                            </a>
                                        @endif

                                        @if (Auth::user()->role === 'A')
                                            <form action="{{ route('pelanggan.destroy', $item['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Data pelanggan belum tersedia.
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
