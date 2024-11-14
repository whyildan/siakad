@extends('template.layout')

@section('content-page')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Edit Data Absen</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-warning"><a href="{{ url('/') }}"
                                    class="text-white text-decoration-none">Kembali</a></button>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Kelas</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Masukkan Kelas" aria-label="Kelas"
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-company">Jurusan</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                class="bx bx-buildings"></i></span>
                                        <input type="text" id="basic-icon-default-company" class="form-control"
                                            placeholder="Masukkan Jurusan" aria-label="jurusan"
                                            aria-describedby="basic-icon-default-company2" />
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
