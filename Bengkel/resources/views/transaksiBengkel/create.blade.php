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
                    <div id="sukuCadangContainer"></div>
                    <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="tambahSukuCadang()">Tambah Suku Cadang</button>
                </div>

                {{-- SUBMIT --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary hstack gap-2">
                        <i class="ti ti-send fs-5"></i> Submit
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-light ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    const sukuCadangList = @json($sukuCadangs);
    const preselected = @json($selectedSukuCadangs);

    document.addEventListener('DOMContentLoaded', function () {
        if (preselected.length > 0) {
            preselected.forEach(item => {
                tambahSukuCadangWithValue(item.id, item.jumlah);
            });
        }
    });

    function tambahSukuCadangWithValue(selectedId = '', jumlahVal = '') {
        const container = document.getElementById('sukuCadangContainer');
        const index = container.children.length;

        const row = document.createElement('div');
        row.className = 'd-flex align-items-center gap-2 mb-2';

        // Select suku cadang
        const select = document.createElement('select');
        select.name = `sukuCadangs[${index}][id]`;
        select.className = 'form-select w-50';
        select.required = true;

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = '-- Pilih Suku Cadang --';
        select.appendChild(defaultOption);

        sukuCadangList.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.text = `${item.nama} (Rp${item.harga.toLocaleString()})`;
            if (item.id == selectedId) option.selected = true;
            select.appendChild(option);
        });

        // Input jumlah
        const jumlah = document.createElement('input');
        jumlah.type = 'number';
        jumlah.name = `sukuCadangs[${index}][jumlah]`;
        jumlah.className = 'form-control w-25';
        jumlah.placeholder = 'Jumlah';
        jumlah.min = 1;
        jumlah.required = true;
        jumlah.value = jumlahVal || '';

        // Tombol hapus baris
        const btnHapus = document.createElement('button');
        btnHapus.type = 'button';
        btnHapus.className = 'btn btn-danger btn-sm';
        btnHapus.innerText = 'Hapus';
        btnHapus.onclick = () => row.remove();

        row.appendChild(select);
        row.appendChild(jumlah);
        row.appendChild(btnHapus);
        container.appendChild(row);
    }

    function tambahSukuCadang() {
        tambahSukuCadangWithValue();
    }
</script>
@endsection
