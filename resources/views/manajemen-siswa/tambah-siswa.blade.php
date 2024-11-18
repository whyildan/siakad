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
            <h4 class="fw-bold py-3 mb-4">Tambah Data Siswa</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-primary"><a href="{{ url('/student') }}"
                                    class="text-white text-decoration-none">Kembali</a></button>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/createstudent') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Nama" aria-label="Nama"
                                            aria-describedby="basic-icon-default-fullname2" name="nama" required />
                                    </div>
                                </div>
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
                                    <label class="form-label" for="basic-icon-default-phone">Tanggal Lahir</label>
                                    <div class="input-group input-group-merge">
                                        <input type="date" id="basic-icon-default-phone" class="form-control phone-mask"
                                            placeholder="xx/xx/xxxx" aria-label="xx/xx/xxxx"
                                            aria-describedby="basic-icon-default-phone2" name="tanggal_lahir" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-phone">Telepon</label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" id="basic-icon-default-phone" class="form-control phone-mask"
                                            placeholder="08xxxxxx" aria-label="08xxxxxx"
                                            aria-describedby="basic-icon-default-phone2" name="telepon" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
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
