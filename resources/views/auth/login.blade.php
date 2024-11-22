@extends('template.template-auth')

@section('content')
    <div class="modal fade" id="loginErrorModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <i class="bx bx-x-circle" style="font-size: 5rem; color: red;"></i>
                </div>
                <div class="modal-body text-center">
                    <p>Gagal Login, Silahkan Coba Lagi.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="logoutSuccessModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <i class="bx bx-check-circle" style="font-size: 5rem; color: green;"></i>
                </div>
                <div class="modal-body text-center">
                    <p>Sukses! Anda Berhasil Logout</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <span class="app-brand-text demo text-body fw-bolder">siakad</span>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Login Akun Siakad🚀</h4>
                        <p class="mb-4">Aplikasi manajemen sistem informasi akademik</p>

                        <form id="formAuthentication" class="mb-3" action="{{ url('/login/auth') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan email" autofocus required />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="{{ url('/forgot_password') }}">
                                        <small>Lupa Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Belum punya akun?</span>
                            <a href="{{ url('/register') }}">
                                <span>Buat Akun</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tampilkan modal jika ada session login_error
            @if (session('login_error'))
                var errorModal = new bootstrap.Modal(document.getElementById('loginErrorModal'));
                errorModal.show();
            @endif

            @if (session('logout_success'))
                var logoutModal = new bootstrap.Modal(document.getElementById('logoutSuccessModal'));
                logoutModal.show();
            @endif
        });
    </script>
@endsection
