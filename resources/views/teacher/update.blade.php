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
                                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Nama" aria-label="Nama"
                                            aria-describedby="basic-icon-default-fullname2" name="name"
                                            value="{{ $guru->user->name }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Email</label>
                                    <div class="input-group input-group-merge">
                                        <input type="email" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="email@email.com" aria-label="email"
                                            aria-describedby="basic-icon-default-fullname2" name="email"
                                            value="{{ $guru->user->email }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Password</label><br>
                                    <p class="mb-1 text-danger">*isi jika ingin ganti password</p>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="password" aria-label="password"
                                            aria-describedby="basic-icon-default-fullname2" name="password" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="phone_number">Telepon</label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" name="phone_number" class="form-control"
                                            id="basic-icon-default-fullname" placeholder="08xxxxxx" aria-label="Telepon"
                                            aria-describedby="basic-icon-default-fullname2" required
                                            value="{{ $guru->phone_number }}" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ $guru->address }}</textarea>
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
