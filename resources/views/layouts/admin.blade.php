<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Joey">
    <meta name="author" content="Joeyz">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem penjadwalan') }}</title>

    <!-- Fonts -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

    @stack('css')
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
     
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-icon rotate-n-0">
                <i class="fas fa-laptop-code"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Sistem Penjadwalan <sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

<!-- menampilkan menu untuk super admin -->
        @if(Auth::check() && Auth::user()->role === 'superadmin')
    <li class="nav-item {{ Nav::isRoute('basic.index') }}">
        <a class="nav-link" href="{{ route('basic.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('User') }}</span>
        </a>
    </li>
    @endif

        <!-- Divider -->
        <hr class="sidebar-divider">

                <!-- menu untuk admin -->
        @if(Auth::check() && Auth::user()->role === 'admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Menu') }}
        </div>

                <!-- Nav Item - Dashboard -->

                <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Dashboard') }}</span></a>
        </li>
        <!-- Nav Item - Matakuliah -->
        <li class="nav-item {{ Nav::isRoute('matakuliah.index') }}">
            <a class="nav-link" href="{{ route('matakuliah.index') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>{{ __('Matakuliah') }}</span>
            </a>
        </li>

        <!-- Nav Item - Dosen -->
        <li class="nav-item {{ Nav::isRoute('dosen.index') }}">
            <a class="nav-link" href="{{ route('dosen.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Dosen') }}</span>
            </a>
        </li>

        <!-- Nav Item - Ruangan -->
        <li class="nav-item {{ Nav::isRoute('ruangan.index') }}">
            <a class="nav-link" href="{{  route('ruangan.index') }}">
                <i class="fas fa-fw fa-building"></i>
                <span>{{ __('Ruangan') }}</span>
            </a>
        </li>

        <!-- Nav Item - Periode -->
        <li class="nav-item {{ Nav::isRoute('periode.index') }}">
            <a class="nav-link" href="{{ route('periode.index') }}">
                <i class="fas fa-fw fa-clock"></i>
                <span>{{ __('Periode') }}</span>
            </a>
        </li>

        <!-- Nav Item - Data Jadwal -->
        <li class="nav-item {{ Nav::isRoute('jadwal.index') }}">
            <a class="nav-link" href="{{ route('jadwal.index') }}">
            <i class="fas fa-fw fa-book"></i>
                <span>{{ __('Data Jadwal') }}</span>
            </a>
        </li>

        <!-- Nav Item - Hari -->
        <li class="nav-item {{ Nav::isRoute('hari.index') }}">
            <a class="nav-link" href="{{ route('hari.index') }}">
                <i class="fas fa-fw fa-clock"></i>
                <span>{{ __('Hari') }}</span>
            </a>
        </li>

        <!-- Nav Item - Jam -->
        <li class="nav-item {{ Nav::isRoute('waktu.index') }}">
            <a class="nav-link" href="{{ route('waktu.index') }}">
                <i class="fas fa-fw fa-clock"></i>
                <span>{{ __('Waktu') }}</span>
            </a>
        </li>

        <!-- Nav Item - Jadwal -->
        <li class="nav-item {{ Nav::isRoute('scheduler.index') }}">
    <a class="nav-link" href="{{ route('scheduler.index') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>{{ __('Sesi') }}</span>
    </a>
</li>
@endif

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                    <!-- Nav Item - Messages -->
                   
                    <!-- Nav Item - User Information -->
                    <style>
                    .nav-item.dropdown {
                         margin-left: auto; /* Menggeser item ke sebelah kanan */
                           }
                           </style>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Profile') }}
                            </a>
                            <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-link" href="{{ route('basic.index') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('User') }}
                            </a> -->
                            <!-- <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Settings') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Activity Log') }}
                            </a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @stack('notif')
                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Joey</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Logout Modal-->
<!-- <a class="dropdown-item" href="{{ route('login') }}">
    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
    {{ __('Login') }}
</a> -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Yakin Ingin Keluar?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" Untuk Mengakhiri.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
@stack('js')
</body>
</html>
