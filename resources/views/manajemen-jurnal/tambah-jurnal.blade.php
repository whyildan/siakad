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
            <h4 class="fw-bold py-3 mb-4">Tambah Data Jurnal</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-primary"><a href="{{ url('/journal') }}"
                                    class="text-white text-decoration-none">Kembali</a></button>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/createjournal') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="mapping_mapel_id" class="form-label">Mapping Mapel</label>
                                    <select id="mapping_mapel_id" name="mapping_mapel_id" class="form-select" required>
                                        <option>Pilih Mapping</option>
                                        @foreach ($mappings as $mapping)
                                            <option value="{{ $mapping->id }}">{{ $mapping->kelas->nama_kelas }} ~
                                                {{ $mapping->mapel->nama_mapel }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-phone">Tanggal</label>
                                    <div class="input-group input-group-merge">
                                        <input type="date" id="basic-icon-default-date" class="form-control date-mask"
                                            placeholder="xx/xx/xxxx" aria-label="xx/xx/xxxx"
                                            aria-describedby="basic-icon-default-phone2" name="tanggal" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
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
