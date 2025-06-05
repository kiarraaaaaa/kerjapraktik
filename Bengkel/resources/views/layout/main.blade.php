
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ url('assets/images/logos/logo.png') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/styles.min.css') }}" />
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
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
        <!--  App Topstrip -->
        <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
            <!-- Kiri -->
            <h1 class="text-info mb-0">REA MANDIRI SUKSES</h1>

            <!-- Kanan -->
            <ul class="navbar-nav flex-row align-items-center list-unstyled m-0">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/images/profile/user1.jpg" alt="User" width="35" height="35" class="rounded-circle">
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
                        <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">
                            Logout
                        </a>
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

            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Charts</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/chart-apex-line.html" aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:chart-square-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Line Chart</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/chart-apex-area.html" aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:pie-chart-3-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Area Chart</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/chart-apex-bar.html" aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:chart-2-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Bar Chart</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/chart-apex-pie.html" aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:pie-chart-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Pie Chart</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/chart-apex-radial.html"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:chart-square-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Radial Chart</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/chart-apex-radar.html" aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:round-graph-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Radar Chart</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>


            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Auth</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="./authentication-login.html" aria-expanded="false">
                <iconify-icon icon="solar:login-3-line-duotone"></iconify-icon>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-login.html"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:login-3-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Side Login</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="./authentication-register.html" aria-expanded="false">
                <iconify-icon icon="solar:user-plus-rounded-line-duotone"></iconify-icon>
                <span class="hide-menu">Register</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-register.html"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:user-plus-rounded-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Side Register</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-forgot-password.html"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:password-outline" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Side Forgot Pwd</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-forgot-password2.html"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:password-outline" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Boxed Forgot Pwd</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-two-steps.html"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:siderbar-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Side Two Steps</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-two-steps2.html"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:siderbar-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Boxed Two Steps</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-error.html"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:bug-minimalistic-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Error</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-maintenance.html"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:settings-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Maintenance</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>

            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Extra</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                href="https://bootstrapdemos.wrappixel.com/spike/dist/main/icon-solar.html" aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:sticker-smile-circle-2-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Solar Icon</span>
                </div>
                <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill">Pro</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="./icon-tabler.html" aria-expanded="false">
                <iconify-icon icon="solar:sticker-smile-circle-2-line-duotone"></iconify-icon>
                <span class="hide-menu">Tabler Icon</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="./sample-page.html" aria-expanded="false">
                <iconify-icon icon="solar:planet-3-line-duotone"></iconify-icon>
                <span class="hide-menu">Sample Page</span>
              </a>
            </li>
          </ul>
          <div
            class="unlimited-access d-flex align-items-center hide-menu bg-secondary-subtle position-relative mb-7 mt-4 p-3 rounded-3">
            <div class="flex-shrink-0">
              <h6 class="fw-semibold fs-4 mb-6 text-dark w-75 lh-sm">Check Pro Version</h6>
              <a href="https://www.wrappixel.com/templates/spike-bootstrap-admin-dashboard/?ref=376" target="_blank"
                class="btn btn-secondary fs-2 fw-semibold lh-sm">Check</a>
            </div>
            <div class="unlimited-access-img">
              <img src="../assets/images/backgrounds/sidebar-buynow-bg.png" alt="" class="img-fluid">
            </div>
          </div>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
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
