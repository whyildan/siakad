@extends('template.layout')

@section('content-page')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (Session::has('sukses'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Success!</strong> {{ Session::get('sukses') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(Session::has('gagal'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>Error!</strong> {{ Session::get('gagal') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h4 class="fw-bold py-3 mb-4">Manajemen Mapping Mapel</h4>
    <div class="card">
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-md-6 col-12">
                    <table border="0" class="w-50">
                        <tr>
                            <td class="card-title">Kelas </td>
                            <td class="card-title">:</td>
                            <td class="card-title fw-light">{{ $mapClass->name }}</td>
                        </tr>
                        <tr>
                            <td class="card-title">Walikelas </td>
                            <td class="card-title">:</td>
                            <td class="card-title fw-light">{{ $mapClass->advisor->name }}</td>
                        </tr>
                        <tr>
                            <td class="card-title">Tahun Ajaran </td>
                            <td class="card-title">:</td>
                            <td class="card-title fw-light">{{ $mapClass->academicyear->year }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 col-12">
                    <form id="insertMapping">
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="class_id" value="{{ $mapClass->id }}">
                        <div class="mb-1">
                            <label for="subject_id" class="form-label">Tambah Mapel</label>
                            <select name="subject_id" id="subject_id" class="form-control select2" required></select>
                        </div>
                        <div class="mb-1">
                            <label for="teacher_id" class="form-label">Guru Mapel</label>
                            <select name="teacher_id" id="teacher_id" class="form-control select2" required></select>
                        </div>
                        <div class="mb-1">
                            <label for="schedules" class="form-label">Jam Pelajaran</label>
                            <input type="text" name="schedules" id="schedules" class="form-control">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h4 class="fw-bold py-3 mb-4">Daftar Mapping Mapel</h4>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Jadwal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($classSubjects as $classSubject)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $classSubject->subject->name }}</td>
                        <td>{{ $classSubject->teacher->fullname }}</td>
                        <td>
                            @foreach (json_decode($classSubject->schedule) as $key => $val)
                                @foreach ($val as $time)
                                    <p>{{ dayIndo($key) . ", " . $time->start_time . "-" . $time->end_time }}</p>
                                @endforeach
                            @endforeach
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td colspan="4"><i>Tidak Ada Data Tersedia</i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/vendor/libs/select2/js/select2.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $("#subject_id").select2({
            ajax: {
                url: '/api/v1/map/subjects',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        }),
                        pagination: {
                            more: data.current_page < data.last_page
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Pilih Mata Pelajaran',
            minimumInputLength: 1,
        })

        $("#teacher_id").select2({
            ajax: {
                url: '/api/v1/map/subject_teachers',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                text: item.fullname,
                                id: item.id
                            }
                        }),
                        pagination: {
                            more: data.current_page < data.last_page
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Pilih Guru',
            minimumInputLength: 1,
        })

        $("#insertMapping").submit(function (e) {
            e.preventDefault()

            var formData = {
                _token: $("#_token").val(),
                class_id: $('#class_id').val(),
                subject_id: $('#subject_id').val(),
                teacher_id: $('#teacher_id').val(),
                schedules: $('#schedules').val(),
            }

            axios.post('/api/v1/map/subject', formData)
                .then(function (res) {
                    Swal.fire({
                        title: "Sukses!",
                        text: res.data.msg,
                        icon: "success",
                        confirmButtonColor: "#556ee6",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload()
                        }
                    })
                })
                .catch(function (error) {
                    console.log(error)

                    Swal.fire({
                        title: "Gagal!",
                        text: "Data gagal ditambahkan!",
                        icon: "error",
                        confirmButtonColor: "#556ee6",
                    })
                })
        })
    })
</script>
@endsection