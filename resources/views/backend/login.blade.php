<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GCS - Login</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #bf0103;
      --primary-hover: #a00103;
      --bg-color: #f4f7f6;
      --text-color: #333;
      --text-muted: #666;
      --input-bg: #fff;
      --input-border: #e0e0e0;
      --radius: 8px;
      --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background: var(--bg-color);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .login-wrapper {
      width: 100%;
      max-width: 420px;
      padding: 20px;
    }

    .login-card {
      background: white;
      padding: 40px;
      border-radius: 16px;
      box-shadow: var(--shadow);
      animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .logo-section {
      text-align: center;
      margin-bottom: 30px;
    }

    .logo-section img {
      height: 60px;
      width: 100%;
      object-fit: contain;
    }

    .welcome-text {
      text-align: center;
      margin-bottom: 30px;
      color: var(--text-color);
    }

    .welcome-text h3 {
      font-weight: 700;
      margin-bottom: 8px;
    }

    .welcome-text p {
      color: var(--text-muted);
      font-size: 0.9rem;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--text-color);
      font-size: 0.9rem;
    }

    .form-control {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid var(--input-border);
      border-radius: var(--radius);
      font-family: inherit;
      font-size: 0.95rem;
      transition: all 0.3s;
      background: var(--input-bg);
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(191, 1, 3, 0.1);
    }

    select.form-control {
      appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 1em;
    }

    .btn-login {
      width: 100%;
      padding: 14px;
      background: var(--primary-color);
      color: white;
      border: none;
      border-radius: var(--radius);
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s;
      margin-top: 10px;
    }

    .btn-login:hover {
      background: var(--primary-hover);
      transform: translateY(-1px);
    }

    .alert-error {
      background: #ffebee;
      color: #c62828;
      padding: 12px;
      border-radius: var(--radius);
      margin-top: 20px;
      font-size: 0.9rem;
      text-align: center;
      border: 1px solid #ffcdd2;
    }

    /* Responsive */
    @media (max-width: 480px) {
      .login-card {
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body>

  <div class="login-wrapper">
    <div class="login-card">
      <div class="logo-section">
        <img src="{{ url('public/assets/images/logo/gcs-icon-light.png') }}" alt="Logo">
      </div>

      <div class="welcome-text">
        <h3>Welcome Back</h3>
        <p>Please sign in to continue</p>
      </div>

      <form method="post" action="{{ route('admin.user.check') }}">
        @csrf

        <div class="form-group">
          <label class="form-label">Username</label>
          <input class="form-control" type="text" name="username" placeholder="Enter your username" required autofocus>
        </div>

        <div class="form-group">
          <label class="form-label">Password</label>
          <input class="form-control" type="password" name="password" placeholder="Enter your password" required>
        </div>

        <div class="form-group">
          <label class="form-label">User Type</label>
          <select class="form-control" name="user_type" required>
            <option value="" disabled selected>Select User Type</option>
            @foreach($userType as $type)
              <option value="{{ $type->id}}"> {{ $type->user_type}} </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Financial Year</label>
          <select class="form-control" name="financial_year">
            <option value="" disabled selected>Select Financial Year</option>
            @foreach($allYears as $years)
              <option value="{{ $years->id}}"> {{ $years->financial_year}} </option>
            @endforeach
          </select>
        </div>

        <button class="btn-login" type="submit">Sign In</button>

        @if(session('error'))
          <div class="alert-error">
            {{ session('error') }}
          </div>
        @endif
      </form>
    </div>
  </div>

  <!-- JS FILES -->
  <script src="{{ url('public/assets/js/jquery.min.js') }}"></script>
  <script src="{{ url('public/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('public/assets/js/icons/feather-icon/feather.min.js') }}"></script>
  <script src="{{ url('public/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
  <script src="{{ url('public/assets/js/config.js') }}"></script>
  <script src="{{ url('public/assets/js/script.js') }}"></script>
  <link rel="icon" href="{{ url('public/assets/images/logo/gcs-icon-light.png') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ url('public/assets/images/logo/gcs-icon-light.png') }}" type="image/x-icon">

</body>

</html>