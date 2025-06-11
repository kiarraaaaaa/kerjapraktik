@extends('layout.main')

@section('title', 'Transaksi')

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

            <h4 class="card-title mb-4">Daftar Transaksi</h4>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('transaksiBengkel.create') }}" class="btn btn-primary">
                    <i class="ti ti-credit-card"></i> Tambah Transaksi
                </a>

                <form action="{{ route('transaksiBengkel.index') }}" method="GET" class="d-flex" role="search">
                    <input type="text" name="search" class="form-control me-2"
                        placeholder="Cari Transaksi..." value="{{ request('search') }}">
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
                            <th>Nama Costumer</th>
                            <th>Layanan</th>
                            <th>Suku Cadang</th>
                            <th>Total Biaya</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>{{ $item['layanan']['nama_layanan'] }}</td>
                                <td>
                                    @if($item['sukuCadangs']->count())
                                        <ul>
                                            @foreach($item['sukuCadangs'] as $sc)
                                                <li class="mt-2" style="white-space: pre;">{{ $sc->nama }}  x  {{ $sc->pivot->jumlah }} </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>Rp {{ number_format($item['total_biaya'], 0, ',', '.') }}</td>
                                <td>{{ $item['created_at']->format('d-m-Y') }}</td>
                                <td>
                                    @if (Auth::user()->role === 'A')
                                        <a href="{{ route('transaksiBengkel.edit', $item['id']) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('transaksiBengkel.show', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Belum ada Data transaksi.
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
