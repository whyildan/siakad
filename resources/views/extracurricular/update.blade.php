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
            <h4 class="fw-bold py-3 mb-4">Edit Data Ekstrakurikuler</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-warning"><a href="{{ url('/extracurricular') }}"
                                    class="text-white text-decoration-none">Kembali</a></button>
                        </div>
                        <div class="card-body">
                            <form action="{{ url("/updateextracurricular/$ekskul->id") }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Ekstrakurikuler</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Masukkan Nama Ekskul" aria-label="Ekstrakurikuler"
                                            aria-describedby="basic-icon-default-fullname2" name="extracurricular_name"
                                            value="{{ $ekskul->extracurricular_name }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="teacher_id" class="form-label">Pembina</label>
                                    <select id="teacher_id" name="teacher_id" class="form-select" required>
                                        <option disabled>Pilih Guru</option>
                                        @foreach ($gurus as $guru)
                                            <option value="{{ $guru->id }}"
                                                {{ $ekskul->teacher_id == $guru->id ? 'selected' : '' }}>
                                                {{ $guru->name }}</option>
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
