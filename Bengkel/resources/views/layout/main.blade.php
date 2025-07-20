
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
        @media (max-width: 768px) {
            .logo-img {
            width: 180px; /* Ukuran lebih kecil di layar mobile */
            }
        }

        .checkout-footer-fixed {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            background: #fff;
            border-top: 1px solid #e0e0e0;
            z-index: 1050;
            padding: 10px 24px;
            height: 60px;
            box-shadow: 0 -1px 6px rgba(0, 0, 0, 0.1);
        }

        .checkout-footer-fixed .container-fluid {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }

        @media (max-width: 768px) {
            .checkout-footer-fixed {
                left: 0;
                padding: 10px 16px;
            }

            .checkout-footer-fixed .container-fluid {
                flex-direction: column;
                gap: 8px;
            }

            .checkout-footer-fixed button {
                width: 100%;
            }
        }

        .app-topstrip {
            outline: 1px solid red;
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 60px;
            background-color: #212529;
            color: #0dcaf0;
            z-index: 1001;
            padding: 0 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgb(255, 255, 255);
        }

        .app-topstrip h1 {
            font-size: 1.5rem;
            margin: 0;
            white-space: nowrap;
        }

        @media (min-width: 992px) {
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
            display: block !important;
            order: -1;
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
            height: 650px;
        }
        .left-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #fff;
            z-index: 1000;
            border-right: 1px solid #ddd;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .body-wrapper {
            margin-left: 250px;
            margin-top: -20px;
        }

        body-wrapper-inner > .container-fluid:first-child {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        .container-fluid > .row:first-child {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        h1, h2, h3, .card, .row {
            margin-top: 0 !important;
        }

        .container-fluid {
            margin-top: -10px;
        }

        /* Dropdown & Keranjang */
        .navbar-nav.flex-row {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-item.dropdown img {
            width: 35px;
            height: 35px;
        }

        .badge {
            font-size: 0.75rem;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .logo-img {
            height: 120px;
            width: 200px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .brand-logo {
            padding: 0.8rem 1rem 0.3rem 1rem;
            display: flex;
            height: 10px;
            align-items: center;
            justify-content: center;
        }

    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper">
        <!--  App Topstrip -->
        <div class="app-topstrip">
            <!-- Judul -->
            <h1 class="text-info mb-0">~ REA MANDIRI SUKSES ~</h1>

            <!-- KANAN: ikon keranjang & dropdown user -->
            <div class="d-flex align-items-center gap-3">
                <!-- KERANJANG -->
                <a class="nav-link position-relative" href="{{ route('keranjang.index') }}">
                    <i class="ti ti-shopping-cart text-info" style="font-size: 28px;"></i>
                    @php
                        use App\Models\Keranjang;
                        $totalItems = Keranjang::where('user_id', auth()->id())->sum('jumlah');
                    @endphp
                    @if($totalItems > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $totalItems }}
                        </span>
                    @endif
                </a>

                <!-- DROPDOWN USER -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ url('assets/images/profile/user1.jpg') }}" alt="User" width="35" height="35" class="rounded-circle">
                        <span class="fw-semibold text-info">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('pelanggan.edit', Auth::user()->id) }}">
                                <i class="ti ti-user"></i> Pengaturan Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="ti ti-logout"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
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
                        @if (Auth::user()->role === 'A')
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                                <span class="hide-menu">Home</span>
                            </li>
                        @endif
                        @if (Auth::user()->role === 'A')
                            <li class="sidebar-item">
                                <a class="sidebar-link primary-hover-bg" href="{{ url('dashboard') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
                                    <span class="hide-menu">Beranda</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <span class="sidebar-divider lg"></span>
                        </li>
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                            <span class="hide-menu">Data Master</span>
                        </li>
                        @if (Auth::user()->role === 'A')
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
                        @endif
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
                                    <span class="hide-menu">Riwayat Transaksi</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <span class="sidebar-divider lg"></span>
                        </li>
                        @if(auth()->user()->role !== 'A')
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                                <span class="hide-menu">Bantuan</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link primary-hover-bg justify-content-between"
                                href="https://wa.me/62895321954141" target="_blank" aria-expanded="false">
                                    <div class="d-flex align-items-center gap-6">
                                        <span class="d-flex">
                                            <iconify-icon icon="ic:baseline-whatsapp"></iconify-icon>
                                        </span>
                                        <span class="hide-menu">Hubungi WhatsApp</span>
                                    </div>
                                </a>
                            </li>
                        @endif
                        <li>
                        <span class="sidebar-divider lg"></span>
                        </li>
                        @if (Auth::user()->role === 'A')
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
                                    <span class="hide-menu">Transaksi Layanan</span>
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
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </aside>
    <div class="body-wrapper">
        <div class="body-wrapper-inner">
            <div class="container-fluid">
                @yield('content')
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
    @yield('scripts')
</body>

</html>
