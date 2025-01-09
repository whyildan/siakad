@extends('template.layout')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/bootstrap-table.min.css">
@endsection

@section('content-page')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Nilai Sumatif</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Jurnal</a></li>
                    <li class="breadcrumb-item active">Nilai Sumatif</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3 justify-content-between">
                    <div class="col-md-6 col-12">
                        <table border="0" class="w-100">
                            <tr>
                                <td class="card-title">Kelas </td>
                                <td class="card-title">:</td>
                                <td class="card-title fw-light">{{ $classSubject->class->name }}</td>
                            </tr>
                            <tr>
                                <td class="card-title">Guru </td>
                                <td class="card-title">:</td>
                                <td class="card-title fw-light">{{ $classSubject->teacher->fullname }}</td>
                            </tr>
                            <tr>
                                <td class="card-title">Mata Pelajaran </td>
                                <td class="card-title">:</td>
                                <td class="card-title fw-light">{{ $classSubject->subject->name }}</td>
                            </tr>
                            <tr>
                                <td class="card-title">Tahun Ajaran </td>
                                <td class="card-title">:</td>
                                <td class="card-title fw-light">{{ $classSubject->academicyear->year }}</td>
                            </tr>
                            <tr>
                                <td class="card-title">Semester </td>
                                <td class="card-title">:</td>
                                <td class="card-title fw-light">{{ $semester }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="text-end">
                            <a href="{{ url('classes/journal/grades') . '/' . encryptUrlId($classSubject->id) }}"
                                class="btn btn-primary text-end waves-effect waves-light">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div>
                        <h2>Nilai Sumatif</h2>
                    </div>
                    <div class="ms-4">
                        <a href="?semester=1" class="btn btn-sm <?= $semester == 1 ? 'btn-primary' : 'btn-secondary' ?>">Semester 1</a>
                        <a href="?semester=2" class="btn btn-sm <?= $semester == 2 ? 'btn-primary' : 'btn-secondary' ?>">Semester 2</a>
                    </div>
                </div>
                <form action="{{ route('grade.save') }}" method="post">
                    @csrf
                    @php
$studentIds = [];
                    @endphp
                    <input type="hidden" name="semester" value="{{ $semester }}">
                    <input type="hidden" name="classSubjectId" value="{{ $classSubject->id }}">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama</th>
                                    <th class="text-center">STS</th>
                                    <th class="text-center">SAS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentGrades as $student)
                                    <tr data-id="{{ $student->student_id }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $student->name }}</td>
                                        @foreach ($student->grades as $key => $val)
                                            <td class="text-center">
                                                <input type="text" class="form-control text-center" name="{{ $student->student_id . '-grades[]'}}"
                                                    id="{{ $student->student_id . '-tp' . $key}}" value="{{ $val != null ? $val : '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    @php
    $studentIds[] = $student->student_id
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="studentIds" value="{{ json_encode($studentIds) }}">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/bootstrap-table.min.js"></script>
<script>
    $(document).ready(function () {

    });
</script>
@endsection