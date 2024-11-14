@extends('template.layout')

@section('content-page')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Manajemen Data Siswa</h4>
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <button type="button" class="btn btn-primary"><a href="{{ url('/addstudent') }}"
                        class="text-white text-decoration-none">Tambah</a></button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nis</th>
                            <th>Kelas</th>
                            <th>Orang Tua</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>1</td>
                            <td>Udin</td>
                            <td>55354</td>
                            <td>Albert Cook</td>
                            <td>Orang Tua</td>
                            <td><span class="badge bg-label-primary me-1">Active</span></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning"><a
                                        class="text-white text-decoration-none" href="{{ url('/editstudent') }}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Edit</a></button>
                                <button type="button" class="btn btn-sm btn-danger"><a
                                        class="text-white text-decoration-none" href="javascript:void(0);"><i
                                            class="bx bx-trash me-1"></i>
                                        Delete</a></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
