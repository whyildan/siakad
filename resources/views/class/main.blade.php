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
        <h4 class="fw-bold py-3 mb-4">Daftar Jurnal Kelas</h4>

        <!-- Basic Layout -->
        <div class="row">
            @if ($role == 'teacher' || $role == 'student')
                @foreach ($classes as $kelas)
                    <div class="col-md-6 col-xl-4">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="{{ randomCardBackground() }}"
                                style="height: 100px; object-fit: cover;" alt="Card image cap">
                            <div class="floating">
                                <h4 class="card-title text-light m-0 p-0">{{ $kelas->subject->name }}</h4>
                                <h5 class="card-title text-light m-0 p-0">{{ $kelas->class->name }}</h5>
                                <h5 class="card-title text-light m-0 p-0">{{ $kelas->teacher->fullname }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="m-0 p-0 fw-bold">Jadwal :</p>
                                @foreach (json_decode($kelas->schedule) as $key => $val)
                                    @foreach ($val as $time)
                                        <p class="m-0 p-0">{{ dayIndo($key) . ", " . $time->start_time . "-" . $time->end_time }}</p>
                                    @endforeach
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ url('/classes') . '/' . Crypt::encryptString($kelas->id) }}"
                                        class="btn btn-sm btn-primary">Kelas</a>
                                    @if ($role == 'teacher')
                                        <a href="{{ url('/classes/journal') . '/' . Crypt::encryptString($kelas->id) }}"
                                            class="btn btn-sm btn-primary ms-2">Jurnal</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection