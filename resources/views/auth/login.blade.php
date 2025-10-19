<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Autumn Café</title>
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
    }
    
    .auth-header {
      background: linear-gradient(135deg, var(--brown-600) 0%, var(--brown-700) 100%);
      color: white;
      padding: 2rem 1.5rem;
      text-align: center;
    }
    
    .auth-body {
      padding: 1.5rem 1.5rem;
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
      font-size: 0.95rem;
    }
    
    .form-label {
      font-size: 0.9rem;
      margin-bottom: 0.4rem;
    }
    
    .mb-3 {
      margin-bottom: 1rem !important;
    }
    
    .auth-footer {
      padding: 0 1.5rem 1.5rem;
      text-align: center;
    }
    
    .divider {
      margin: 1rem 0;
    }
    
    .divider span {
      font-size: 0.85rem;
    }
    
    .form-check-input:checked {
      background-color: var(--brown-500);
      border-color: var(--brown-500);
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
  </style>
</head>
<body>
  <div class="auth-card">
    <div class="auth-header">
      <div class="autumn-icon">☕</div>
      <h2 class="mb-2">Welcome Back!</h2>
      <p class="mb-0">Sign in to Autumn Café Admin</p>
    </div>

    <div class="auth-body">
      <form action="{{ route('login') }}" method="POST">
        @csrf

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
                 autofocus
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
                 placeholder="Enter your password">
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4 form-check">
          <input type="checkbox" 
                 class="form-check-input" 
                 id="remember" 
                 name="remember">
          <label class="form-check-label" for="remember">
            Remember me
          </label>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">
          <i class="bi bi-box-arrow-in-right"></i> Sign In
        </button>

        <div class="divider">
          <span>Don't have an account?</span>
        </div>

        <a href="{{ route('register') }}" class="btn btn-outline-secondary w-100">
          <i class="bi bi-person-plus"></i> Create Account
        </a>
      </form>
    </div>

    <div class="auth-footer">
      <small class="text-muted" style="font-size: 0.8rem;">🍂 Autumn Café Admin 🍂</small>
    </div>
  </div>

  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="successModalLabel">
                      <i class="bi bi-check-circle-fill"></i> Success
                  </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p class="mb-0">{{ session('success') }}</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
              </div>
          </div>
      </div>
  </div>

  <!-- Error Modal -->
  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header bg-danger text-white">
                  <h5 class="modal-title" id="errorModalLabel">
                      <i class="bi bi-exclamation-triangle-fill"></i> Error
                  </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  @if(session('error'))
                      <p class="mb-0">{{ session('error') }}</p>
                  @elseif($errors->any())
                      @foreach($errors->all() as $error)
                          <p class="mb-0">{{ $error }}</p>
                      @endforeach
                  @endif
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
              </div>
          </div>
      </div>
  </div>

  @if(session('success'))
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const modalElement = document.getElementById('successModal');
          const successModal = new bootstrap.Modal(modalElement);
          successModal.show();
          
          modalElement.addEventListener('hidden.bs.modal', function () {
              document.body.classList.remove('modal-open');
              document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
          });
      });
  </script>
  @endif

  @if(session('error') || $errors->any())
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const modalElement = document.getElementById('errorModal');
          const errorModal = new bootstrap.Modal(modalElement);
          errorModal.show();
          
          modalElement.addEventListener('hidden.bs.modal', function () {
              document.body.classList.remove('modal-open');
              document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
          });
      });
  </script>
  @endif

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
