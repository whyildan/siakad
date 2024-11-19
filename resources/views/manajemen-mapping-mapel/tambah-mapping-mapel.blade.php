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
            <h4 class="fw-bold py-3 mb-4">Tambah Mapping Mapel</h4>
            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-primary"><a href="{{ url('/mapping/subject') }}"
                                    class="text-white text-decoration-none">Kembali</a></button>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/createmapping/subject/') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="kelas_id" class="form-label">Kelas</label>
                                    <select id="kelas_id" name="kelas_id" class="form-select" required>
                                        <option>Pilih Kelas</option>
                                        @foreach ($kelas as $kls)
                                            <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="mapel_id" class="form-label">Mapel</label>
                                    <select id="mapel_id" name="mapel_id" class="form-select" required>
                                        <option>Pilih Mapel</option>
                                        @foreach ($mapels as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                        @endforeach
                                    </select>
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
