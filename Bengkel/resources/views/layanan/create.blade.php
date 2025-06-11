@extends('layout.main')

@section('title', 'Tambah Layanan Bengkel')

@section('content')
<div class="col-10 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5 text-center ">Form Tambah Layanan Bengkel</h4>
            <form method="POST" action="{{ route('layanan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror"
                                   id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan') }}" placeholder="Masukan Nama Layanan ">
                            <label class="fw-bold text-dark" for="nama_layanan"> Nama Layanan </label>
                            @error('nama_layanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('biaya') is-invalid @enderror"
                                   id="biaya" name="biaya" value="{{ old('biaya') }}" placeholder="Masukan Biaya Layanan">
                            <label class="fw-bold text-dark" for="biaya">Biaya Layanan</label>
                            @error('biaya')
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
                    <a href="{{ url('layanan') }}" class="btn btn-transparans ms-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
