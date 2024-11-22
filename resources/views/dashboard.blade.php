@extends('template.layout')

@section('content-page')
    <div class="modal fade" id="loginSuccessModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <i class="bx bx-check-circle" style="font-size: 5rem; color: green;"></i>
                </div>
                <div class="modal-body text-center">
                    <p>Selamat datang! Anda berhasil login.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                                    <p class="mb-4">
                                        You have done <span class="fw-bold">72%</span> more sales today.
                                        Check
                                        your new badge in
                                        your profile.
                                    </p>

                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">View
                                        Badges</a>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    </div>
    <!-- Content wrapper -->
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tampilkan modal jika ada session login_error
            @if (session('login_success'))
                var errorModal = new bootstrap.Modal(document.getElementById('loginSuccessModal'));
                errorModal.show();
            @endif
        });
    </script>
@endsection
