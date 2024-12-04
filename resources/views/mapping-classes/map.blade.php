@extends('template.layout')
@section('css')
<link href="{{ asset('assets/vendor/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
    <h4 class="fw-bold py-3 mb-4">Manajemen Mapping Kelas</h4>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 col-12">
                    <table border="0" class="w-50">
                        <tr>
                            <td class="card-title">Kelas </td>
                            <td class="card-title">:</td>
                            <td class="card-title fw-light">{{ $mapClass->nama_kelas }}</td>
                        </tr>
                        <tr>
                            <td class="card-title">Walikelas </td>
                            <td class="card-title">:</td>
                            <td class="card-title fw-light">{{ $mapClass->guru->nama }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 col-12">
                    <form id="insertStudent">
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="class_id" value="{{ $mapClass->id }}">
                        <div class="mb-1">
                            <label for="student_id" class="form-label">Tambah Siswa</label>
                            <select name="student_id" id="student_id" class="form-control select2 w-100" required></select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h4 class="card-title">Daftar Siswa Kelas</h4>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Peserta Didik</th>
                        <th>NIS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classStudents as $classStudent)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $classStudent->student->nis }}</td>
                            <td>{{ $classStudent->student->nama }}</td>
                            <td align="center">
                                <button class="btn btn-sm btn-danger" type="button" id="removeStudent">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="4"><i>Tidak Ada Data Tersedia</i></td>
                        </tr>
                    @endforelse
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
        $("#student_id").select2({
            ajax: {
                url: '/api/v1/map/students',
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
                                text: item.nama,
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
            placeholder: 'Pilih siswa',
            minimumInputLength: 1,
        })

        $("#insertStudent").submit(function (e) {
            e.preventDefault()

            var formData = {
                _token: $("#_token").val(),
                student_id: $('#student_id').val(),
                class_id: $('#class_id').val(),
            }

            axios.post('/api/v1/map/class', formData)
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