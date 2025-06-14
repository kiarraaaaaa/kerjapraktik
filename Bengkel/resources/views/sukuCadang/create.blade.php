@extends('layout.main')

@section('title', 'Tambah Suku Cadang')

@section('content')
<div class="col-10 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5 text-center ">Form Tambah Suku Cadang</h4>
            <form method="POST" action="{{ route('sukuCadang.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('foto') is-invalid @enderror"
                                   id="foto" name="foto" value="{{ old('foto') }}" placeholder="Masukan URL Foto Suku Cadang">
                            <label class="fw-bold text-dark" for="foto">URL Foto</label>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                   id="kode" name="kode" value="{{ old('kode') }}" placeholder="Masukan Kode Suku Cadang">
                            <label class="fw-bold text-dark" for="kode">Kode Suku Cadang</label>
                            @error('kode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukan Nama Suku Cadang">
                            <label class="fw-bold text-dark" for="nama">Nama Suku Cadang</label>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                   id="harga" name="harga" value="{{ old('harga') }}" placeholder="Masukan Harga Suku Cadang">
                            <label class="fw-bold text-dark" for="harga">Harga Suku Cadang</label>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                   id="stok" name="stok" value="{{ old('stok') }}" placeholder="Masukan Stok Suku Cadang">
                            <label class="fw-bold text-dark" for="stok">Stok Suku Cadang</label>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary hstack gap-2">
                        <i class="ti ti-send fs-5"></i>
                        Submit
                    </button>
                    <a href="{{ url('sukuCadang') }}" class="btn btn-transparans ms-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
