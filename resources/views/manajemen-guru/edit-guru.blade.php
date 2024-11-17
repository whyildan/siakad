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
            <h4 class="fw-bold py-3 mb-4">Edit Data Guru</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-warning"><a href="{{ url('/teacher') }}"
                                    class="text-white text-decoration-none">Kembali</a></button>
                        </div>
                        <div class="card-body">
                            <form action="{{ url("/updateteacher/$guru->id") }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="nama">Nama</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <input type="text" name="nama" class="form-control"
                                            id="basic-icon-default-fullname" placeholder="Masukkan Nama" aria-label="Nama"
                                            aria-describedby="basic-icon-default-fullname2" value="{{ $guru->nama }}"
                                            required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="mapel_id" class="form-label">Mapel</label>
                                    <select id="mapel_id" name="mapel_id" class="form-select" required>
                                        <option disabled>Pilih Mapel</option>
                                        @foreach ($mapels as $mapel)
                                            <option value="{{ $mapel->id }}"
                                                {{ $guru->mapel_id == $mapel->id ? 'selected' : '' }}>
                                                {{ $mapel->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for=telepon">Telepon</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <input type="number" name="telepon" class="form-control"
                                            id="basic-icon-default-fullname" placeholder="08xxxxxx" aria-label="Telepon"
                                            aria-describedby="basic-icon-default-fullname2" value="{{ $guru->telepon }}"
                                            required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $guru->alamat }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
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
