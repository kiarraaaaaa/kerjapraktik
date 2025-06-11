@extends('layout.main')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="col-10 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5 text-center">Form Tambah Transaksi</h4>
            @if (session('warning_html'))
                <div class="alert alert-warning">
                    {!! session('warning_html') !!}
                </div>
            @endif
            <form method="POST" action="{{ route('transaksiBengkel.store') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Pembeli</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}" placeholder="Masukan Nama Pembeli">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="layanan_id" class="form-label">Layanan</label>
                        <select id="layanan_id" name="layanan_id" class="form-control text-dark" required>
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($layanan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('layanan_id', $selectedLayanan ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_layanan }} - Rp{{ number_format($item->biaya, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="fw-bold mb-3">Suku Cadang (Opsional)</label>
                    @foreach($sukuCadangs as $index => $item)
                        @php
                            $checked = request()->get('sukuCadang_id') == $item->id ? 'checked' : '';
                            $disabled = request()->get('sukuCadang_id') == $item->id ? '' : 'disabled';
                        @endphp

                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" class="form-check-input me-2 suku-cadang-check"
                                id="sc{{ $index }}"
                                name="sukuCadangs[{{ $index }}][selected]" value="1"
                                {{ $checked }}>

                            <label for="sc{{ $index }}" class="me-2">
                                {{ $item->nama }} (Rp{{ number_format($item->harga,0,',','.') }})
                            </label>

                            {{-- Hidden input id --}}
                            <input type="hidden" name="sukuCadangs[{{ $index }}][id]" value="{{ $item->id }}">

                            {{-- Input jumlah --}}
                            <input type="number" name="sukuCadangs[{{ $index }}][jumlah]" value="1" min="1"
                                class="form-control w-25 jumlah-input"
                                {{ $disabled }}>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary hstack gap-2">
                        <i class="ti ti-send fs-5"></i> Submit
                    </button>
                    <a href="{{ url('transaksiBengkel') }}" class="btn btn-transparant ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script untuk enable/disable jumlah saat centang --}}
<script>
    document.querySelectorAll('.suku-cadang-check').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let id = this.id.replace('sc', ''); // ambil index
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
