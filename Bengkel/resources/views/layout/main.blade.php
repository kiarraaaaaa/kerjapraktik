
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ url('assets/images/logos/logo.png') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css" />
    <style>
        .logo-img {
            width: 230px; /* Sesuaikan ukuran yang diinginkan */
            height: auto;
        }

        @media (max-width: 768px) {
            .logo-img {
            width: 180px; /* Ukuran lebih kecil di layar mobile */
            }
        }
        .app-topstrip {
            padding-top: 1.5rem;  /* py-6 sekitar 1.5rem */
            padding-bottom: 1.5rem;
            padding-left: 1rem;   /* px-3 sekitar 1rem */
            padding-right: 1rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background-color: #212529; /* sesuai bg-dark */
            color: #0dcaf0; /* text-info */
            gap: 0.75rem;
        }

        .app-topstrip h1 {
            font-size: 1.25rem;
            flex: 1 1 100%;
            margin-bottom: 0.5rem;
        }

        @media (min-width: 992px) {
        /* untuk layar lg ke atas (>=992px) */
        .app-topstrip {
            flex-wrap: nowrap;
        }

        .app-topstrip h1 {
            flex: 0 0 auto;
            margin-bottom: 0;
            font-size: 1.75rem;
        }
        }

        .nav-item.d-block.d-xl-none {
            display: block !important;  /* tombol menu untuk mobile */
            order: -1; /* letakkan di awal baris */
        }

        .navbar-nav.flex-row {
            flex: 0 0 auto;
            margin-left: auto;
        }

        .dropdown-menu {
            min-width: 12rem;
        }

        .dropdown-item p {
            margin: 0;
            font-size: 0.9rem;
        }

        .content {
            height: 650px; /* supaya ada scroll */
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
        <!--  App Topstrip -->
        <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
            <!-- Kiri -->
            <h1 class="text-info mb-0">~ REA MANDIRI SUKSES ~</h1>

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>

            <!-- Kanan -->
            <ul class="navbar-nav flex-row align-items-center list-unstyled m-0">
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center gap-2" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/images/profile/user1.jpg" alt="User" width="35" height="35" class="rounded-circle">
                        <span class="fw-semibold text-info">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-mail fs-6"></i>
                                <p class="mb-0 fs-3">My Account</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-list-check fs-6"></i>
                                <p class="mb-0 fs-3">My Task</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline-primary mx-3 mt-2 d-block">
                                    Logout
                                </a>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="#" class="text-nowrap">
                    <img src="{{ url('assets/images/logos/logoku.png') }}" alt="" class="logo-img" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <div class="content">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                        <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link primary-hover-bg" href="./index.html" aria-expanded="false">
                            <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
                            <span class="hide-menu">Beranda</span>
                        </a>
                        </li>
                        <li>
                        <span class="sidebar-divider lg"></span>
                        </li>
                        <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                        <span class="hide-menu">Data Master</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link primary-hover-bg justify-content-between"
                            href="{{ url('pelanggan') }}" aria-expanded="false">
                                <div class="d-flex align-items-center gap-6">
                                    <span class="d-flex">
                                        <iconify-icon icon="solar:user-line-duotone" class=""></iconify-icon>
                                    </span>
                                    <span class="hide-menu">Pelanggan</span>
                                </div>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link primary-hover-bg justify-content-between"
                            href="{{ url('sukuCadang') }}" aria-expanded="false">
                                <div class="d-flex align-items-center gap-6">
                                    <span class="d-flex">
                                        <iconify-icon icon="solar:settings-outline" class=""></iconify-icon>
                                    </span>
                                    <span class="hide-menu">Suku Cadang</span>
                                </div>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link primary-hover-bg justify-content-between"
                            href="{{ url('layanan') }}" aria-expanded="false">
                                <div class="d-flex align-items-center gap-6">
                                    <span class="d-flex">
                                        <iconify-icon icon="solar:wheel-line-duotone" class=""></iconify-icon>
                                    </span>
                                    <span class="hide-menu">Layanan Bengkel</span>
                                </div>
                            </a>
                        </li>
                        <li>
                        <span class="sidebar-divider lg"></span>
                        </li>
                        <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                        <span class="hide-menu">Transaksi</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link primary-hover-bg justify-content-between " href="{{ url('transaksiBengkel') }}"
                                aria-expanded="false">
                                <div class="d-flex align-items-center gap-6">
                                    <span class="d-flex">
                                        <iconify-icon icon="solar:banknote-2-broken"></iconify-icon>
                                    </span>
                                    <span class="hide-menu">Transaksi Bengkel</span>
                                </div>
                            </a>
                        </li>
                        <li>
                        <span class="sidebar-divider lg"></span>
                        </li>
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                            <span class="hide-menu"> Laporan Bengkel </span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link primary-hover-bg justify-content-between"
                                href="{{ route('laporan.penjualan_suku_cadang') }}" aria-expanded="false">
                                <div class="d-flex align-items-center gap-6">
                                <span class="d-flex">
                                    <iconify-icon icon="solar:tablet-line-duotone" class=""></iconify-icon>
                                </span>
                                <span class="hide-menu">Penjualan Suku Cadang</span>
                                </div>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link primary-hover-bg justify-content-between"
                                href="{{ route('laporan.transaksi_layanan') }}" aria-expanded="false">
                                <div class="d-flex align-items-center gap-6">
                                <span class="d-flex">
                                    <iconify-icon icon="solar:tablet-line-duotone" class=""></iconify-icon>
                                </span>
                                <span class="hide-menu">Transaksi Layanan Bengkel</span>
                                </div>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link primary-hover-bg justify-content-between"
                                href="{{ route('laporan.stok_suku_cadang') }}" aria-expanded="false">
                                <div class="d-flex align-items-center gap-6">
                                <span class="d-flex">
                                    <iconify-icon icon="solar:tablet-line-duotone" class=""></iconify-icon>
                                </span>
                                <span class="hide-menu">Stok Suku Cadang</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
        </div>
    </div>
</div>
  <script src="{{ url('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ url('assets/js/app.min.js') }}"></script>
  <script src="{{ url('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ url('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ url('assets/js/dashboard.js') }}"></script>
  <!-- solar icons -->
  <script src="{{ url('https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js') }}"></script>
</body>

</html>
