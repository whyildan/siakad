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
            <h4 class="fw-bold py-3 mb-4">Edit Data Siswa</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-warning"><a href="{{ url('/student') }}"
                                    class="text-white text-decoration-none">Kembali</a></button>
                        </div>
                        <div class="card-body">
                            <form action="{{ url("/updatestudent/$siswa->id") }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Nama" aria-label="Nama"
                                            aria-describedby="basic-icon-default-fullname2" name="name"
                                            value="{{ $siswa->name }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">NIS</label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="NIS" aria-label="NIS"
                                            aria-describedby="basic-icon-default-fullname2" name="student_identification_number"
                                            value="{{ $siswa->student_identification_number }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="class_id" class="form-label">Kelas</label>
                                    <select id="class_id" name="class_id" class="form-select" required>
                                        <option>Pilih Kelas</option>
                                        @foreach ($kelas as $kls)
                                            <option value="{{ $kls->id }}"
                                                {{ $siswa->class_id == $kls->id ? 'selected' : '' }}>
                                                {{ $kls->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-phone">Tanggal Lahir</label>
                                    <div class="input-group input-group-merge">
                                        <input type="date" id="basic-icon-default-phone" class="form-control phone-mask"
                                            placeholder="xx/xx/xxxx" aria-label="xx/xx/xxxx"
                                            aria-describedby="basic-icon-default-phone2" name="date_of_birth"
                                            value="{{ $siswa->date_of_birth }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="orang_tua_nama">Nama Orang Tua</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Nama" aria-label="Nama"
                                            aria-describedby="basic-icon-default-fullname2" name="parent_name" required
                                            value="{{ $siswa->user->name }}" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="orang_tua_email">Email Orang Tua</label>
                                    <div class="input-group input-group-merge">
                                        <input type="email" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="email@email.com" aria-label="email"
                                            aria-describedby="basic-icon-default-fullname2" name="parent_email" required
                                            value="{{ $siswa->user->email }}" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Password</label><br>
                                    <p class="mb-1 text-danger">*isi jika ingin ganti password</p>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="password" aria-label="password"
                                            aria-describedby="basic-icon-default-fullname2" name="parent_password" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-phone">Telepon</label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" id="basic-icon-default-phone"
                                            class="form-control phone-mask" placeholder="08xxxxxx" aria-label="08xxxxxx"
                                            aria-describedby="basic-icon-default-phone2" name="phone_number"
                                            value="{{ $siswa->phone_number }}" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ $siswa->address }}</textarea>
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
