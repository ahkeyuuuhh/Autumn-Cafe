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
      /* Monochromatic Brown Palette */
      --brown-50: #faf8f6;
      --brown-100: #f5f0eb;
      --brown-200: #e8ddd2;
      --brown-300: #d4c4b5;
      --brown-400: #b8a08a;
      --brown-500: #8b6f47;
      --brown-600: #6b5635;
      --brown-700: #4a3d28;
      --brown-800: #352b1d;
      --brown-900: #1f1710;
    }
    
    body { 
      background: linear-gradient(135deg, var(--brown-50) 0%, var(--brown-100) 100%);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
      margin: 0;
      overflow: hidden;
    }
    
    .auth-card {
      max-width: 400px;
      width: 90%;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-height: 95vh;
      display: flex;
      flex-direction: column;
    }
    
    .auth-header {
      background: linear-gradient(135deg, var(--brown-600) 0%, var(--brown-700) 100%);
      color: white;
      padding: 1.5rem;
      text-align: center;
      flex-shrink: 0;
    }
    
    .auth-body {
      padding: 1.2rem 1.5rem;
      overflow-y: auto;
      flex: 1;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, var(--brown-500) 0%, var(--brown-600) 100%);
      border: none;
      padding: 10px;
      font-weight: 600;
    }
    
    .btn-primary:hover {
      background: linear-gradient(135deg, var(--brown-600) 0%, var(--brown-700) 100%);
      transform: translateY(-2px);
    }
    
    .form-control:focus {
      border-color: var(--brown-500);
      box-shadow: 0 0 0 0.2rem rgba(139, 111, 71, 0.25);
    }
    
    .autumn-icon {
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
    }
    
    .auth-header h2 {
      font-size: 1.5rem;
      margin-bottom: 0.25rem;
    }
    
    .auth-header p {
      font-size: 0.9rem;
      margin: 0;
      opacity: 0.9;
    }
    
    .form-control {
      padding: 0.6rem 0.75rem;
      font-size: 0.9rem;
    }
    
    .form-label {
      font-size: 0.85rem;
      margin-bottom: 0.3rem;
    }
    
    .mb-3 {
      margin-bottom: 0.8rem !important;
    }
    
    .mb-4 {
      margin-bottom: 1rem !important;
    }
    
    .auth-footer {
      padding: 0 1.5rem 1.2rem;
      text-align: center;
      flex-shrink: 0;
    }
    
    .divider {
      margin: 0.8rem 0;
    }
    
    .divider span {
      font-size: 0.85rem;
    }
    
    small.text-muted {
      font-size: 0.75rem;
    }
    
    .btn-outline-secondary {
      color: var(--brown-600);
      border-color: var(--brown-300);
    }
    
    .btn-outline-secondary:hover {
      background-color: var(--brown-100);
      border-color: var(--brown-400);
      color: var(--brown-700);
    }
    
    .alert {
      padding: 0.6rem;
      font-size: 0.85rem;
      margin-bottom: 0.8rem;
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

    <div class="auth-footer">
      <small class="text-muted">🍂 Autumn Café Admin 🍂</small>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
