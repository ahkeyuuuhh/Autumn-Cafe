<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Autumn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    :root {
      --primary: #E67E22;
      --bg: #FFF9F3;
      --nav: #3B2F2F;
    }
    body { 
      background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .auth-card {
      max-width: 450px;
      width: 100%;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .auth-header {
      background: linear-gradient(135deg, #E67E22 0%, #D35400 100%);
      color: white;
      padding: 40px 30px;
      text-align: center;
    }
    .auth-body {
      padding: 40px 30px;
    }
    .btn-primary {
      background: var(--primary);
      border: none;
      padding: 12px;
      font-weight: 600;
    }
    .btn-primary:hover {
      background: #D35400;
    }
    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
    }
    .autumn-icon {
      font-size: 3rem;
      margin-bottom: 10px;
    }
    .divider {
      display: flex;
      align-items: center;
      text-align: center;
      margin: 20px 0;
    }
    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid #ddd;
    }
    .divider span {
      padding: 0 10px;
      color: #999;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="auth-card">
    <div class="auth-header">
      <div class="autumn-icon">☕</div>
      <h2 class="mb-2">Join Autumn Café</h2>
      <p class="mb-0">Create your admin account</p>
    </div>

    <div class="auth-body">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-triangle-fill"></i> Please fix the errors below
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">
            <i class="bi bi-person"></i> Full Name
          </label>
          <input type="text" 
                 class="form-control @error('name') is-invalid @enderror" 
                 id="name" 
                 name="name" 
                 value="{{ old('name') }}" 
                 required 
                 autofocus
                 placeholder="Enter your full name">
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">
            <i class="bi bi-envelope"></i> Email Address
          </label>
          <input type="email" 
                 class="form-control @error('email') is-invalid @enderror" 
                 id="email" 
                 name="email" 
                 value="{{ old('email') }}" 
                 required
                 placeholder="Enter your email">
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">
            <i class="bi bi-lock"></i> Password
          </label>
          <input type="password" 
                 class="form-control @error('password') is-invalid @enderror" 
                 id="password" 
                 name="password" 
                 required
                 placeholder="Create a password (min. 8 characters)">
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          <small class="text-muted">Must be at least 8 characters</small>
        </div>

        <div class="mb-4">
          <label for="password_confirmation" class="form-label">
            <i class="bi bi-lock-fill"></i> Confirm Password
          </label>
          <input type="password" 
                 class="form-control" 
                 id="password_confirmation" 
                 name="password_confirmation" 
                 required
                 placeholder="Re-enter your password">
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">
          <i class="bi bi-person-plus"></i> Create Account
        </button>

        <div class="divider">
          <span>Already have an account?</span>
        </div>

        <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100">
          <i class="bi bi-box-arrow-in-right"></i> Sign In
        </a>
      </form>
    </div>

    <div class="text-center pb-4">
      <small class="text-muted">🍂 Autumn Café Admin Portal 🍂</small>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
