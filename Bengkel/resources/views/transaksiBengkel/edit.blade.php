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
                    <label class="fw-bold mb-2">Layanan</label>
                    <div id="layananContainer"></div>
                    <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="tambahLayanan()">Tambah Layanan</button>
                </div>

                {{-- Suku Cadang --}}
                <div class="mt-4">
                    <label class="fw-bold mb-2">Suku Cadang (Opsional)</label>
                    <div id="sukuCadangContainer"></div>
                    <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="tambahSukuCadang()">Tambah Suku Cadang</button>
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

{{-- SCRIPT --}}
<script>
    const layananList = @json($layanan);
    const sukuCadangList = @json($sukuCadangs);

    const preselectedLayanan = @json($selectedLayanans ?? []);
    const preselectedSukuCadang = @json($selectedSukuCadangs ?? []);

    document.addEventListener('DOMContentLoaded', function() {
        if (preselectedLayanan.length > 0) {
            preselectedLayanan.forEach(item => {
                tambahLayananWithValue(item.id, item.jumlah);
            });
        } else {
            // tambahLayanan(); // default satu layanan kosong
        }

        if (preselectedSukuCadang.length > 0) {
            preselectedSukuCadang.forEach(item => {
                tambahSukuCadangWithValue(item.id, item.jumlah);
            });
        }
    });

    function tambahLayananWithValue(selectedId = '', jumlahVal = '') {
        const container = document.getElementById('layananContainer');
        const index = container.children.length;

        const row = document.createElement('div');
        row.className = 'd-flex align-items-center gap-2 mb-2';

        const select = document.createElement('select');
        select.name = `layanans[${index}][id]`;
        select.className = 'form-select w-50';
        select.required = true;

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = '-- Pilih Layanan --';
        select.appendChild(defaultOption);

        layananList.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.text = `${item.nama_layanan} (Rp${item.biaya.toLocaleString()})`;
            if (item.id == selectedId) option.selected = true;
            select.appendChild(option);
        });

        const jumlah = document.createElement('input');
        jumlah.type = 'number';
        jumlah.name = `layanans[${index}][jumlah]`;
        jumlah.className = 'form-control w-25';
        jumlah.placeholder = 'Jumlah';
        jumlah.min = 1;
        jumlah.required = true;
        jumlah.value = jumlahVal || '';

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

    function tambahLayanan() {
        tambahLayananWithValue();
    }

    function tambahSukuCadangWithValue(selectedId = '', jumlahVal = '') {
        const container = document.getElementById('sukuCadangContainer');
        const index = container.children.length;

        const row = document.createElement('div');
        row.className = 'd-flex align-items-center gap-2 mb-2';

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

        const jumlah = document.createElement('input');
        jumlah.type = 'number';
        jumlah.name = `sukuCadangs[${index}][jumlah]`;
        jumlah.className = 'form-control w-25';
        jumlah.placeholder = 'Jumlah';
        jumlah.min = 1;
        jumlah.required = true;
        jumlah.value = jumlahVal || '';

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
