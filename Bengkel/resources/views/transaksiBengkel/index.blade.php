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
                    @if (Auth::user()->role === 'A')
                        <a href="{{ route('transaksiBengkel.create') }}" class="btn btn-primary">
                            <i class="ti ti-credit-card"></i> Tambah Transaksi
                        </a>
                    @endif

                    <form action="{{ route('transaksiBengkel.index') }}" method="GET" class="d-flex" role="search">
                        <input type="text" name="search" class="form-control me-2" placeholder="Cari Transaksi..."
                            value="{{ request('search') }}">
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
                                <th>No Handphone</th>
                                <th>Alamat</th>
                                <th>Layanan</th>
                                <th>Suku Cadang</th>
                                <th>Total Biaya</th>
                                <th>Tanggal</th>
                                @if(auth()->user()->role !== 'U')
                                    <th>Status</th>
                                @endif
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item['nohp'] }}</td>
                                    <td>{{ $item['alamat'] }}</td>
                                    <td>
                                        @if ($item->layanans->count())
                                            <ul>
                                                @foreach ($item->layanans as $layanan)
                                                    <li>{{ $layanan->nama_layanan }} x {{ $layanan->pivot->jumlah }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-muted">Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item['sukuCadangs']->count())
                                            <ul>
                                                @foreach ($item['sukuCadangs'] as $sc)
                                                    <li class="mt-2" style="white-space: pre;">{{ $sc->nama }} x {{ $sc->pivot->jumlah }} </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-muted">Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($item['total_biaya'], 0, ',', '.') }}</td>
                                    <td>{{ $item['created_at']->format('d-m-Y') }}</td>
                                    @if(auth()->user()->role !== 'U')
                                        <td>
                                            @if ($item->status === 'completed')
                                                <select class="form-select form-select-sm" disabled>
                                                    @foreach (['pending' => 'Pending', 'in_progress' => 'Sedang Dikerjakan', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $key => $label)
                                                        <option value="{{ $key }}" {{ $item->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <form action="{{ route('transaksiBengkel.updateStatus', $item->id) }}" method="POST" onsubmit="return handleStatusChange(this)">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-select form-select-sm" onchange="handleStatusChange(this)">
                                                        @foreach (['pending' => 'Pending', 'in_progress' => 'Sedang Dikerjakan', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $key => $label)
                                                            <option value="{{ $key }}" {{ $item->status === $key ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                    <td class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('transaksiBengkel.show', $item->id) }}"
                                            class="btn btn-info btn-sm" title="Lihat"><i class="ti ti-eye"></i></a>
                                    
                                        @if ($item->status !== 'completed')
                                            <a href="{{ route('transaksiBengkel.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit"><i class="ti ti-pencil"></i></a>
                                    
                                            <form action="{{ route('transaksiBengkel.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        @endif
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

    <script>
        function handleStatusChange(selectElement) {
            const form = selectElement.closest('form');
            const selectedValue = selectElement.value;
    
            if (selectedValue === 'completed') {
                if (!confirm('Status akan diubah menjadi SELESAI. Setelah itu, data tidak dapat diedit, dihapus, atau diubah statusnya lagi. Lanjutkan?')) {
                    // Reset ke value sebelumnya jika dibatalkan
                    selectElement.value = selectElement.getAttribute('data-current');
                    return;
                }
            }
    
            form.submit();
        }
    
        // Simpan nilai awal sebagai data-current agar bisa di-rollback kalau user batal
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('select[name="status"]').forEach(function (el) {
                el.setAttribute('data-current', el.value);
            });
        });
    </script>    
@endsection
