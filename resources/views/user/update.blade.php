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
            <h4 class="fw-bold py-3 mb-4">Edit Data User</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-warning"><a href="{{ url('/user') }}"
                                    class="text-white text-decoration-none">Kembali</a></button>
                        </div>
                        <div class="card-body">
                            <form action="{{ url("/updateuser/$user->id") }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload Profile</label>
                                    <input class="form-control" type="file" id="formFile" name="image" />
                                    @if ($user->image)
                                        <div class="mt-2">
                                            <img src="{{ asset($user->image) }}" alt="Foto Profil"
                                                style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Nama" aria-label="Nama"
                                            aria-describedby="basic-icon-default-fullname2" name="name"
                                            value="{{ $user->name }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Email</label>
                                    <div class="input-group input-group-merge">
                                        <input type="email" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="email@email.com" aria-label="email"
                                            aria-describedby="basic-icon-default-fullname2" name="email"
                                            value="{{ $user->email }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-0" for="basic-icon-default-fullname">Password</label><br>
                                    <p class="mb-1 text-danger">*isi jika ingin ganti password</p>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="password" aria-label="password"
                                            aria-describedby="basic-icon-default-fullname2" name="password" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select id="role" name="role" class="form-select" required>
                                        <option disabled>Pilih Role</option>
                                        @foreach ($roles as $key => $value)
                                            <option value="{{ $key }}" {{ $user->role == $key ? 'selected' : '' }}>
                                                {{ $value }}</option>
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
