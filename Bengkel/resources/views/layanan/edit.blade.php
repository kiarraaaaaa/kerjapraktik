@extends('layout.main')

@section('title', 'Edit Layanan')

@section('content')
<div class="col-10 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5 text-center ">Form Edit Layanan</h4>
            <form method="POST" action="{{ route('layanan.update', $layanan['id']) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror"
                                   id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan') ? old('nama_layanan'): $layanan['nama_layanan'] }}" placeholder="Masukan Nama Layanan">
                            <label class="fw-bold text-dark" for="nama_layanan"> Nama Layanan </label>
                            @error('nama_layanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('biaya') is-invalid @enderror"
                                   id="biaya" name="biaya" value="{{ old('biaya') ? old('biaya'): $layanan['biaya'] }}" placeholder="Masukan Biaya Layanan">
                            <label class="fw-bold text-dark" for="biaya"> Biaya Layanan </label>
                            @error('biaya')
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
                    <a href="{{ url('layanan') }}" class="btn btn-transparans ms-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
