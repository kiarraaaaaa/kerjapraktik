@extends('layout.main')

@section('title', 'Edit Transaksi')

@section('content')
<div class="col-10 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5 text-center">Edit Transaksi</h4>
            <form method="POST" action="{{ route('transaksiBengkel.update', $transaksi->id) }}">
                @csrf
                @method('PUT')
                {{-- Pelanggan & Layanan --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Pembeli</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror text-dark"
                            value="{{ old('nama') ? old('nama'): $transaksi['nama'] }}" placeholder="Masukan Nama Pembeli">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="layanan_id">Layanan</label>
                        <select id="layanan_id" name="layanan_id" class="form-control text-dark mt-2" required>
                            @foreach($layanan as $item)
                                <option value="{{ $item['id'] }}" {{ $item['id'] == $transaksi['layanan_id'] ? 'selected' : '' }}>
                                    {{ $item['nama_layanan'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Suku Cadang --}}
                <div class="mt-4">
                    <label class="fw-bold text-dark">Suku Cadang (Opsional)</label>
                    @foreach($sukuCadangs as $item)
                    @php
                        $pivot = $transaksi['sukuCadangs']->firstWhere('id', $item['id']);
                    @endphp
                    <div class="d-flex align-items-center mb-2">
                        <input type="checkbox" class="form-check-input me-2 suku-cadang-check"
                               data-id="{{ $item['id'] }}"
                               {{ $pivot ? 'checked' : '' }}>
                        <label class="me-2">{{ $item['nama'] }} (Rp{{ number_format($item['harga'], 0, ',', '.') }})</label>
                        <input type="hidden" name="sukuCadangs[{{ $item['id'] }}][id]" value="{{ $item['id'] }}">
                        <input type="number" name="sukuCadangs[{{ $item['id'] }}][jumlah]" min="1"
                               value="{{ $pivot ? $pivot['pivot']['jumlah'] : 1 }}"
                               class="form-control w-25 jumlah-input"
                               {{ $pivot ? '' : 'disabled' }}>
                    </div>
                    @endforeach
                </div>
                {{-- Tombol --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy fs-5"></i> Submit
                    </button>
                    <a href="{{ route('transaksiBengkel.index') }}" class="btn btn-transparant ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script enable/disable jumlah --}}
<script>
    document.querySelectorAll('.suku-cadang-check').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let id = this.dataset.id;
            let jumlahInput = document.querySelector(`input[name="sukuCadangs[${id}][jumlah]"]`);
            if (this.checked) {
                jumlahInput.disabled = false;
            } else {
                jumlahInput.disabled = true;
                jumlahInput.value = 1;
            }
        });
    });
</script>
@endsection
