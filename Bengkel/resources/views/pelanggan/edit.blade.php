@extends('layout.main')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="col-10 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5 text-center ">Form Edit Pelanggan</h4>
            <form method="POST" action="{{ route('pelanggan.update', $pelanggan['id']) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') ? old('name') : $pelanggan['name'] }}" placeholder="Masukan Nama Pelanggan">
                            <label class="fw-bold text-dark" for="name">Nama Pelanggan</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') ? old('email') : $pelanggan['email'] }}" placeholder="Masukan Email Pelanggan">
                            <label class="fw-bold text-dark" for="email">Nama Pelanggan</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('nohp') is-invalid @enderror"
                                   id="nohp" name="nohp" value="{{ old('nohp') ? old('nohp') : $pelanggan['nohp'] }}" placeholder="Masukan No Telepon Pelanggan">
                            <label class="fw-bold text-dark" for="nohp">No Telepon</label>
                            @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                   id="alamat" name="alamat" value="{{ old('alamat') ? old('alamat') : $pelanggan['alamat'] }}" placeholder="Masukan Alamat Pelanggan">
                            <label class="fw-bold text-dark" for="alamat">Alamat</label>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('kendaraan') is-invalid @enderror"
                                   id="kendaraan" name="kendaraan" value="{{ old('kendaraan') ? old('kendaraan') : $pelanggan['kendaraan'] }}" placeholder="Masukan Kendaraan Pelanggan">
                            <label class="fw-bold text-dark" for="kendaraan">Kendaraan</label>
                            @error('kendaraan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary hstack gap-2">
                        <i class="ti ti-device-floppy fs-5"></i>
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
