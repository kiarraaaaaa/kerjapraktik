@extends('layout.main')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="col-10 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5 text-center">Form Tambah Transaksi</h4>

            @if (session('warning_html'))
                <div class="alert alert-warning">{!! session('warning_html') !!}</div>
            @endif

            <form method="POST" action="{{ route('transaksiBengkel.store') }}">
                @csrf

                {{-- NAMA & LAYANAN --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Pembeli</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}" placeholder="Masukkan nama pembeli">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="layanan_id" class="form-label">Layanan</label>
                        <select id="layanan_id" name="layanan_id"
                            class="form-control text-dark @error('layanan_id') is-invalid @enderror">
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($layanan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('layanan_id', $selectedLayanan ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_layanan }} - Rp{{ number_format($item->biaya, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('layanan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- ALAMAT --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="2"
                        class="form-control @error('alamat') is-invalid @enderror"
                        placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- SUKU CADANG --}}
                <div class="mt-4">
                    <label class="fw-bold mb-3">Suku Cadang (Opsional)</label>
                    @php
                        $urlSelectedId = request()->get('sukuCadang_id');
                        $urlSukuCadangs = request()->get('sukuCadangs', []);
                    @endphp

                    @foreach($sukuCadangs as $index => $item)
                        @php
                            $itemId = $item->id;

                            // Check dari input sebelumnya (misal saat form error)
                            $fromOld = old("sukuCadangs.{$index}.selected");

                            // Check dari parameter sukuCadang_id (pesan langsung)
                            $fromUrlSingle = ($urlSelectedId == $itemId);

                            // Check dari parameter sukuCadangs (checkout keranjang)
                            $fromUrlMulti = array_key_exists($itemId, $urlSukuCadangs) && isset($urlSukuCadangs[$itemId]['selected']);

                            // Final check aktif jika salah satu true
                            $isChecked = $fromOld || $fromUrlSingle || $fromUrlMulti;

                            // Ambil jumlah dari old input, atau dari parameter URL jika ada
                            $jumlah = old("sukuCadangs.{$index}.jumlah")
                                ?? ($fromUrlMulti ? $urlSukuCadangs[$itemId]['jumlah'] : ($fromUrlSingle ? 1 : ''));
                        @endphp

                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" class="form-check-input me-2 suku-cadang-check"
                                id="sc{{ $index }}"
                                name="sukuCadangs[{{ $index }}][selected]"
                                value="1"
                                {{ $isChecked ? 'checked' : '' }}>

                            <label for="sc{{ $index }}" class="me-2">
                                {{ $item->nama }} (Rp{{ number_format($item->harga, 0, ',', '.') }})
                            </label>

                            {{-- ID --}}
                            <input type="hidden" name="sukuCadangs[{{ $index }}][id]" value="{{ $itemId }}">

                            {{-- Jumlah --}}
                            <input type="number"
                                name="sukuCadangs[{{ $index }}][jumlah]"
                                class="form-control w-25 jumlah-input"
                                min="1" placeholder="Jumlah"
                                value="{{ $jumlah }}"
                                {{ $isChecked ? '' : 'disabled' }}>
                        </div>
                    @endforeach
                </div>

                {{-- SUBMIT --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary hstack gap-2">
                        <i class="ti ti-send fs-5"></i> Submit
                    </button>
                    <a href="{{ route('transaksiBengkel.index') }}" class="btn btn-light ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS Enable/Disable Jumlah --}}
<script>
    document.querySelectorAll('.suku-cadang-check').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const index = this.id.replace('sc', '');
            const jumlahInput = document.querySelector(`input[name="sukuCadangs[${index}][jumlah]"]`);
            if (this.checked) {
                jumlahInput.disabled = false;
            } else {
                jumlahInput.disabled = true;
                jumlahInput.value = '';
            }
        });
    });
</script>
@endsection
