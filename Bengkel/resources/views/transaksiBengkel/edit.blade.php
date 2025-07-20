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
                        <label for="nohp" class="form-label">No. HP</label>
                        <input type="number" name="nohp" id="nohp" class="form-control @error('nohp') is-invalid @enderror text-dark"
                            value="{{ old('nohp') ? old('nohp'): $transaksi['nohp'] }}" placeholder="Masukan Nomor Handphone">
                        @error('nohp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>        
                </div>

                <div class="col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror text-dark"
                        value="{{ old('alamat') ? old('alamat'): $transaksi['alamat'] }}" placeholder="Masukan Alamat">
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Layanan --}}
                <div class="mt-4">
                    <label class="fw-bold text-dark mb-2">Layanan (Wajib Dipilih Minimal 1)</label>
                    @foreach($layanan as $item)
                        @php
                            $pivot = $transaksi['layanans']->firstWhere('id', $item['id']);
                        @endphp
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" class="form-check-input me-2 layanan-check"
                                data-id="{{ $item['id'] }}"
                                {{ $pivot ? 'checked' : '' }}>
                            <label class="me-2">{{ $item['nama_layanan'] }} (Rp{{ number_format($item['biaya'], 0, ',', '.') }})</label>
                            
                            {{-- Input hidden id --}}
                            <input type="hidden" name="layanans[{{ $item['id'] }}][id]" value="{{ $item['id'] }}">
                            
                            {{-- Input jumlah --}}
                            <input type="number" name="layanans[{{ $item['id'] }}][jumlah]" min="1"
                                value="{{ $pivot ? $pivot['pivot']['jumlah'] : 1 }}"
                                class="form-control w-25 jumlah-layanan-input"
                                {{ $pivot ? '' : 'disabled' }}>
                        </div>
                    @endforeach
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
                        <label class="me-2">{{ $item['nama'] }} ( Rp.{{ number_format($item['harga'], 0, ',', '.') }} )</label>
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

{{-- Script enable/disable jumlah input berdasarkan checkbox --}}
<script>
    // Untuk Layanan
    document.querySelectorAll('.layanan-check').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let id = this.dataset.id;
            let jumlahInput = document.querySelector(`input[name="layanans[${id}][jumlah]"]`);
            if (this.checked) {
                jumlahInput.disabled = false;
            } else {
                jumlahInput.disabled = true;
                jumlahInput.value = 1;
            }
        });
    });

    // Untuk Suku Cadang
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
