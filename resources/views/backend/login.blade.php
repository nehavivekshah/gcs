<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>GCS - Login</title>

  <!-- Favicon -->
  <link rel="icon" href="{{ url('public/assets/images/favicon.png') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.png') }}" type="image/x-icon">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ url('public/assets/css/vendors/icofont.css') }}">
  <link rel="stylesheet" href="{{ url('public/assets/css/vendors/themify.css') }}">
  <link rel="stylesheet" href="{{ url('public/assets/css/vendors/flag-icon.css') }}">
  <link rel="stylesheet" href="{{ url('public/assets/css/vendors/feather-icon.css') }}">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ url('public/assets/css/vendors/bootstrap.css') }}">

  <!-- App CSS -->
  <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('public/assets/css/color-1.css') }}">
  <link rel="stylesheet" href="{{ url('public/assets/css/responsive.css') }}">
</head>

<body>

  <!-- LOGIN PAGE START -->
  <div class="container-fluid">
    <div class="row min-vh-100 d-flex justify-content-center align-items-center">

      <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
        <div class="login-card login-dark">

          <!-- <div class="text-center mb-4">
          <a class="logo" href="#">
            <img class="img-fluid for-dark" src="{{ url('public/assets/images/logo/logo.png') }}" alt="logo">
            <img class="img-fluid for-light" src="{{ url('public/assets/images/logo/logo_dark.png') }}" alt="logo">
          </a>
        </div> -->

          <div class="login-main">
            <form class="theme-form" method="post" action="{{ route('admin.user.check') }}">
              @csrf
              <!-- LOGO -->
              <div class="text-center mb-4">
                <img src="{{ url('public/assets/images/logo/dashboard-logo.jpeg') }}" alt="Logo" class="img-fluid"
                  style="max-height:70px;">
              </div>


              <div class="form-group">
                <label class="col-form-label">User Name</label>
                <input class="form-control" type="text" name="username" id="username" placeholder="User Name"
                  style="color: black;" required>
              </div>

              <div class="form-group">
                <label class="col-form-label">Password</label>
                <div class="form-input position-relative">
                  <input class="form-control" type="password" name="password" id="password" placeholder="********"
                    style="color: black;" required>
                  <!-- <div class="show-hide"><span class="show"></span></div> -->
                </div>
              </div>

              <div class="form-group">
                <label class="col-form-label">User Type</label>
                <select class="form-control" name="user_type" id="user_type" style="color: black;" required>
                  <option value=""> Select </option>
                  @foreach($userType as $type)
                    <option value="{{ $type->id}}"> {{ $type->user_type}} </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label class="col-form-label">Finantial Year</label>
                <select class="form-control" name="financial_year" id="financial_year" style="color: black;">
                  <option value=""> Select </option>
                  @foreach($allYears as $years)
                    <option value="{{ $years->id}}"> {{ $years->financial_year}} </option>
                  @endforeach
                </select>
              </div>


              <button class="btn w-100" type="submit" style="margin-top:10px;background:#bf0103;color:white;">
                Sign In
              </button>
              <h5 style="text-align: center;color:red;">
                @if(session('error'))

                  {{ session('error') }}

                @endif
              </h5>

            </form>

          </div>

        </div>
      </div>

    </div>
  </div>
  <!-- LOGIN PAGE END -->

  <!-- JS FILES -->
  <script src="{{ url('public/assets/js/jquery.min.js') }}"></script>
  <script src="{{ url('public/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

  <!-- Feather Icons -->
  <script src="{{ url('public/assets/js/icons/feather-icon/feather.min.js') }}"></script>
  <script src="{{ url('public/assets/js/icons/feather-icon/feather-icon.js') }}"></script>

  <!-- Config -->
  <script src="{{ url('public/assets/js/config.js') }}"></script>

  <!-- Theme JS -->
  <script src="{{ url('public/assets/js/script.js') }}"></script>

</body>

</html>