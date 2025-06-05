@extends('layout.main')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="col-10 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5 text-center ">Form Tambah Pelanggan</h4>
            <form method="POST" action="{{ route('pelanggan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukan Nama Pelanggan">
                            <label class="fw-bold text-dark" for="nama">Nama Pelanggan</label>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('nohp') is-invalid @enderror"
                                   id="nohp" name="nohp" value="{{ old('nohp') }}" placeholder="Masukan No Telepon Pelanggan">
                            <label class="fw-bold text-dark" for="nohp">No Telepon</label>
                            @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                   id="alamat" name="alamat" value="{{ old('alamat') }}" placeholder="Masukan Alamat Pelanggan">
                            <label class="fw-bold text-dark" for="alamat">Alamat</label>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('kendaraan') is-invalid @enderror"
                                   id="kendaraan" name="kendaraan" value="{{ old('kendaraan') }}" placeholder="Masukan Kendaraan Pelanggan">
                            <label class="fw-bold text-dark" for="kendaraan">Kendaraan</label>
                            @error('kendaraan')
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
                    <a href="{{ url('pelanggan') }}" class="btn btn-transparans ms-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
