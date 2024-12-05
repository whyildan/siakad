<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path=""
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>SIAKAD</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    {{--
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" /> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('css')
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <span class="app-brand-text demo menu-text fw-bolder ms-2">SIAKAD</span>

                    <a href="{{ '/dashboard' }}"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>
                    @can('admin')
                        <li class="menu-item  {{ Request::is('user') ? 'active' : '' }}">
                            <a href="{{ url('/user') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div data-i18n="Without menu">User</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ Request::is('map/classes') ? 'active open' : '' }} {{ Request::is('map/subjects') ? 'active open' : '' }} {{ Request::is('map/extracurricular') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-layout"></i>
                                <div data-i18n="Mappings">Mappings</div>
                            </a>

                            <ul class="menu-sub">
                                <li class="menu-item {{ Request::is('map/classes') ? 'active' : '' }}">
                                    <a href="{{ url('map/classes') }}" class="menu-link">
                                        <div data-i18n="Without menu">Kelas</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is(patterns: 'map/subjects') ? 'active' : '' }}">
                                    <a href="{{ url('map/subjects') }}" class="menu-link">
                                        <div data-i18n="Without navbar">Mapel</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('map/extracurricular') ? 'active' : '' }}">
                                    <a href="{{ url('map/extracurricular') }}" class="menu-link">
                                        <div data-i18n="Without navbar">Ekstrakurikuler</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    <li class="menu-item  {{ Request::is('student') ? 'active' : '' }}">
                        <a href="{{ url('/student') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div data-i18n="Without menu">Siswa</div>
                        </a>
                    </li>
                    <li class="menu-item  {{ Request::is('class') ? 'active' : '' }}">
                        <a href="{{ url('/class') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-group"></i>
                            <div data-i18n="Without navbar">Kelas</div>
                        </a>
                    </li>
                    <li class="menu-item  {{ Request::is('parent') ? 'active' : '' }}">
                        <a href="{{ url('/parent') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user-pin"></i>
                            <div data-i18n="Container">Orang Tua</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('extracurricular') ? 'active' : '' }}">
                        <a href="{{ url('/extracurricular') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-football"></i>
                            <div data-i18n="Container">Ekstrakurikuler</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('teacher') ? 'active' : '' }}">
                        <a href="{{ url('/teacher') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-briefcase"></i>
                            <div data-i18n="Without menu">Guru</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('journal') ? 'active' : '' }}">
                        <a href="{{ url('/journal') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book-content"></i>
                            <div data-i18n="Without navbar">Jurnal</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('subject') ? 'active' : '' }}">
                        <a href="{{ url('/subject') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book"></i>
                            <div data-i18n="Without navbar">Mapel</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @if (!isset($hideNavbar) || !$hideNavbar)
                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                        id="layout-navbar">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-4">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                            <ul class="navbar-nav flex-row align-items-center ms-auto">

                                <!-- User -->
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                        data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online">
                                            <img src="{{ auth()->user()->image != null ? asset(auth()->user()->image) : asset('assets/images/default-profile.png') }}"
                                                alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-online">
                                                            <img src="{{ auth()->user()->image != null ? asset(auth()->user()->image) : asset('assets/images/default-profile.png') }}"
                                                                alt class="w-px-40 h-auto rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span
                                                            class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                                                        <small class="text-muted">{{ auth()->user()->role }}</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ '/logout' }}">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Log Out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!--/ User -->
                            </ul>
                        </div>
                    </nav>
                @endif
                <!-- / Navbar -->
                @yield('content-page')
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    {{-- content --}}

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script>
        @if (session('success'))
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: "#556ee6",
            })
        @endif

        @if (session(key: 'errors'))
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('errors') }}",
                icon: "error",
                confirmButtonColor: "#556ee6",
            })
        @endif
    </script>
    @yield('script')
    @yield('js')
</body>

</html>
