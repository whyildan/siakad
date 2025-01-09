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
    <h4 class="fw-bold py-3 mb-4">Jurnal Harian</h4>
    <div class="card">
        <div class="card-header">
            <div class="row mb-3 justify-content-between">
                <div class="col-md-6 col-12">
                    <table border="0" class="w-100">
                        <tr>
                            <td class="card-title">Kelas </td>
                            <td class="card-title">:</td>
                            <td class="card-title fw-light">{{ $classSubject->class->class_name }}</td>
                        </tr>
                        <tr>
                            <td class="card-title">Guru </td>
                            <td class="card-title">:</td>
                            <td class="card-title fw-light">{{ $classSubject->teacher->fullname }}</td>
                        </tr>
                        <tr>
                            <td class="card-title">Mata Pelajaran </td>
                            <td class="card-title">:</td>
                            <td class="card-title fw-light">{{ $classSubject->subject->subject_name }}</td>
                        </tr>
                        <tr>
                            <td class="card-title">Tahun Ajaran </td>
                            <td class="card-title">:</td>
                            <td class="card-title fw-light">{{ $classSubject->academicyear->year }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 col-12">
                    <div class="text-end">
                        <a href="{{ url('classes/journal/export') . '/' . encryptUrlId($classSubject->id)  }}"
                            class="btn btn-success text-end waves-effect waves-light">Export Jurnal</a>
                        <a href="{{ url('classes/journal/grades') . '/' . encryptUrlId($classSubject->id)  }}"
                            class="btn btn-info text-end waves-effect waves-light">Isi Nilai</a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#insertDataModal"
                            class="btn btn-primary text-end waves-effect waves-light">Isi Jurnal</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hari / Tanggal</th>
                        <th>Jam Ke</th>
                        <th>Kelas</th>
                        <th>Pertemuan Ke</th>
                        <th>Materi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Scrollable modal -->
<div class="modal fade" id="insertDataModal" role="dialog" aria-labelledby="insertDataModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertDataModalTitle">Isi Jurnal Harian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formJournal">
                <div class="modal-body">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="class_subject_id" id="class_subject_id" value="{{ $classSubject->id }}">
                    <input type="hidden" name="teacher_id" id="teacher_id" value="{{ $classSubject->teacher_id }}">
                    <div class="mb-3">
                        <label for="date" class="form-label">Hari / Tanggal</label>
                        <input class="form-control" type="date" id="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="schedule" class="form-label">Jam Ke</label>
                        <select class="form-select" name="schedule" id="schedule" disabled required>
                            <option selected disabled>Pilih Jam Pelajaran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="meet" class="form-label">Pertemuan Ke</label>
                        <input class="form-control" type="number" id="meet" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Materi</label>
                        <textarea name="content" id="content" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal for Attendance -->
<div class="modal fade" id="attendanceModal" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendanceModalLabel">Absensi Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="attendanceList">
                <div class="modal-body">
                    <table id="attendanceTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="saveAttendance">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection