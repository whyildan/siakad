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
            <h4 class="fw-bold py-3 mb-4">Edit Data Mapel</h4>
            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-warning"><a href="{{ url('/subject') }}"
                                    class="text-white text-decoration-none">Kembali</a></button>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url("/updatesubject/$mapel->id") }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="nama_mapel"></label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="nama_mapel" class="form-control"
                                            id="nama_mapel basic-icon-default-fullname" placeholder="Masukkan Mapel"
                                            aria-label="Mapel" aria-describedby="basic-icon-default-fullname2"
                                            value="{{ $mapel->nama_mapel }}" />
                                    </div>
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
