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
    <h4 class="fw-bold py-3 mb-4">Manajemen Mapping Kelas</h4>
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <button type="button" class="btn btn-primary"><a href="{{ url('/addmapping/subject') }}"
                    class="text-white text-decoration-none"><i class='bx bx-plus-circle me-1'></i>Tambah</a></button>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Kelas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($classes as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama_kelas }}</td>
                            <td>{{ $data->guru->nama }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning"><a
                                        class="text-white text-decoration-none"
                                        href="{{ url("/map/classes/$data->id") }}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Mapping Siswa</a></button>
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