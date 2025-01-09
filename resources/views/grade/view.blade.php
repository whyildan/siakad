@extends('template.layout')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/bootstrap-table.min.css">
@endsection

@section('content-page')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Lihat Nilai</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Jurnal</a></li>
                    <li class="breadcrumb-item active">Lihat Nilai</li>
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
                        <h2>Lihat Nilai</h2>
                    </div>
                    <div class="ms-4">
                        <a href="?semester=1"
                            class="btn btn-sm <?= $semester == 1 ? 'btn-primary' : 'btn-secondary' ?>">Semester 1</a>
                        <a href="?semester=2"
                            class="btn btn-sm <?= $semester == 2 ? 'btn-primary' : 'btn-secondary' ?>">Semester 2</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama</th>
                                <th colspan="7">Nilai Proyek</th>
                                <th colspan="7">Nilai Formatif</th>
                                <th colspan="2">Nilai Sumatif</th>
                                <th rowspan="2">x̄</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>x̄</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>x̄</th>
                                <th>STS</th>
                                <th>SAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                @php
                                    if($studentGrades){
                                        $list = (object) $studentGrades[$student->student_id]->grades;
                                        $nilaiKd = (($list->project->summary->average + $list->formative->summary->average) * 0.75) / 3;
                                        $nilaiSts = ($list->summative->lists[0] != null ? $list->summative->lists[0] : 0) * 0.15;
                                        $nilaiSas = ($list->summative->lists[1] != null ? $list->summative->lists[1] : 1) * 0.10;
                                        $nilaiRata = $nilaiKd + $nilaiSts + $nilaiSas;
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $student->student_name }}</td>
                                    @if($studentGrades)
                                        @foreach ($list->project->lists as $project)
                                            @if ($project != null)
                                                <td class="text-center">{{ $project }}</td>
                                            @else
                                                <td class="text-center">-</td>
                                            @endif
                                        @endforeach
                                        <td class="text-center">{{ $list->project->summary->average }}</td>
                                        @foreach ($list->formative->lists as $project)
                                            @if ($project != null)
                                                <td class="text-center">{{ $project }}</td>
                                            @else
                                                <td class="text-center">-</td>
                                            @endif
                                        @endforeach
                                        <td class="text-center">{{ $list->formative->summary->average }}</td>
                                        @foreach ($list->summative->lists as $project)
                                            @if ($project != null)
                                                <td class="text-center">{{ $project }}</td>
                                            @else
                                                <td class="text-center">-</td>
                                            @endif
                                        @endforeach
                                        <td class="text-center">{{ $nilaiRata }}</td>
                                    @else
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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