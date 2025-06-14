<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Your App') }} - Login</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('frondend/assets/img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('frondend/assets/img/logo.png') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/simple-datatables/style.css') }}">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>


<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.svg" alt="">
                  <span class="d-none d-lg-block">BLOG</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>

                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="{{ route('register') }}">
                      @csrf
                      <div class="col-12">
                          <label for="yourName" class="form-label">Your Name</label>
                          <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="yourName" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                          @if($errors->has('name'))
                              <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                          @endif
                      </div>

                      <div class="col-12">
                          <label for="yourEmail" class="form-label">Your Email</label>
                          <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="yourEmail" value="{{ old('email') }}" required autocomplete="username">
                          @if($errors->has('email'))
                              <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                          @endif
                      </div>

                      <div class="col-12">
                          <label for="yourPassword" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="yourPassword" autocomplete="new-password" required>
                          @if ($errors->has('password'))
                              <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                          @endif
                      </div>

                      <div class="col-12">
                          <label for="password_confirmation" class="form-label">Confirm Password</label>
                          <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" autocomplete="new-password" required>
                          @if($errors->has('password_confirmation'))
                              <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                          @endif
                      </div>

                      <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Create Account</button>
                      </div>
                      
                      <div class="col-12">
                          <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                      </div>
                  </form>


                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>


</body>

</html>