@extends('template.layout')

@section('content-page')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            @if (Session::has('gagal'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>Error!</strong> {{ Session::get('gagal') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h4 class="fw-bold py-3 mb-4">Edit Data Orang Tua</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-warning"><a href="{{ url('/parent') }}"
                                    class="text-white text-decoration-none">Kembali</a></button>
                        </div>
                        <div class="card-body">
                            <form action="{{ url("updateparent/$orangtua->id") }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Masukkan Nama" aria-label="Nama"
                                            aria-describedby="basic-icon-default-fullname2" name="nama"
                                            value="{{ $orangtua->nama }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-company">Telepon</label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" id="basic-icon-default-company" class="form-control"
                                            placeholder="08xxxxxxxx" aria-label="telepon"
                                            aria-describedby="basic-icon-default-company2" name="telepon"
                                            value="{{ $orangtua->telepon }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $orangtua->alamat }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="siswa_id" class="form-label">Nama Siswa</label>
                                    <select id="siswa_id" name="siswa_id" class="form-select" required>
                                        <option disabled>Pilih Siswa</option>
                                        @foreach ($siswas as $siswa)
                                            <option value="{{ $siswa->id }}"
                                                {{ $orangtua->siswa_id == $siswa->id ? 'selected' : '' }}>
                                                {{ $siswa->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
