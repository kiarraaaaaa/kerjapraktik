
<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" type="image/png" href="{{ url('assets/images/logos/logo.png') }}" />
  <link rel="stylesheet" href="{{ url('assets/css/styles.min.css') }}" />
  <title>REGISTER</title>
</head>

<body>
    <div id="main-wrapper" class="min-vh-100 bg-info auth-customizer-none">
        <div class="auth-login position-relative overflow-hidden d-flex align-items-center justify-content-center px-7 px-xxl-0 rounded-3 h-n20 ">
            <div class="auth-login-shape position-relative w-100">
                <div class="auth-login-wrapper card mt-10 container position-relative z-1 h-100 mh-n100" data-simplebar>
                    <div class="card-body">
                        <div class="row align-items-center justify-content-around pt-6 pb-5">
                        <div class="col-lg-6 col-xl-5 d-none d-lg-block">
                            <div class="text-center text-lg-start">
                            <img src="{{ url('assets/images/backgrounds/backgroundAuth.png') }}" alt="spike-img" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-5">
                            <h2 class="mb-6 fs-8 fw-bolder">Selamat Datang</h2>
                            <p class="text-dark fs-4 mb-7">Silakan Register terlebih dahulu.</p>
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-7">
                                    <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                    <input class="form-control py-6" id="name" name="name" type="text" placeholder="Masukan Nama Lengkap" aria-label="inputexample">
                                </div>
                                <div class="mb-7">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input type="email" class="form-control py-6" id="email" name="email" placeholder="Masukan Email Address" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-9">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <input type="password" class="form-control py-6" id="password" name="password" placeholder="Masukan Password">
                                </div>
                                <div class="mb-9">
                                    <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password</label>
                                    <input type="password" class="form-control py-6" id="password_confirmation" name="password_confirmation" placeholder="Masukan Konfirmasi Password ">
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-7 rounded-pill">Register</button>
                                <div class="d-flex align-items-center">
                                    <p class="fs-3 mb-0 fw-medium">Sudah memiliki Akun ?</p>
                                    <a class="text-primary fw-bold ms-2 fs-3" href="{{ url('login') }}">Login</a>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>
  <!-- Import Js Files -->
  <script src="{{ url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
  <script src="{{ url('assets/js/theme/app.init.js') }}"></script>
  <script src="{{ url('assets/js/theme/theme.js') }}"></script>
  <script src="{{ url('assets/js/theme/app.min.js') }}"></script>
  <script src="{{ url('assets/js/theme/feather.min.js') }}"></script>
  <script>
        function handleColorTheme(e) {
            document.documentElement.setAttribute("data-color-theme", e);
        }
    </script>
  <!-- solar icons -->
  <script src="{{ url('https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js') }}"></script>
</body>

</html>
