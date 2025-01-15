@extends('template.layout')

@section('content-page')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if(Session::has('gagal'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>Error!</strong> {{ Session::get('gagal') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h4 class="fw-bold py-3 mb-4">Data Orang Tua</h4>
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Siswa</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($parents as $parent)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $parent->name }}</td>
                                <td>
                                    @foreach ($parent->students as $student)
                                    {{$student->name}}
                                    @endforeach
                                </td>
                                <td>{{ $parent->email }}</td>
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
