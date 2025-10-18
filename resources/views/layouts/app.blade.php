<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Autumn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    :root {
      --autumn-primary: #D2691E;
      --autumn-secondary: #8B4513;
      --autumn-accent: #CD853F;
      --autumn-light: #F4A460;
      --autumn-dark: #654321;
      --autumn-bg: #FFF9F3;
      --autumn-cream: #FFE8D6;
    }
    
    body { 
      background: var(--autumn-bg); 
      color: var(--autumn-dark);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .navbar { 
      background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .btn-primary { 
      background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
      border: none;
      border-radius: 8px;
      padding: 8px 20px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover { 
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(210, 105, 30, 0.4);
    }
    
    .dropdown-menu { 
      border-radius: 12px; 
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
      border: none;
    }
    
    .nav-link {
      transition: all 0.3s ease;
      border-radius: 6px;
      margin: 0 5px;
    }
    
    .nav-link:hover {
      background-color: rgba(255,255,255,0.1);
    }
    
    .modal-content {
      border-radius: 15px;
      border: none;
      box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    
    .modal-header {
      border-bottom: none;
      border-radius: 15px 15px 0 0;
      padding: 20px 25px;
    }
    
    .modal-body {
      padding: 25px;
    }
    
    .modal-footer {
      border-top: none;
      padding: 20px 25px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('dashboard') }}">
        <i class="bi bi-cup-hot-fill"></i> Autumn Café
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('menu.index') }}">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('orders.create') }}">New Order</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('transactions.index') }}">Transactions</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('customers.index') }}">Customers</a></li>
        </ul>
        <ul class="navbar-nav">
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <span class="dropdown-item-text">
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                  </span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                      <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                  </form>
                </li>
              </ul>
            </li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>


  <main class="container py-4">
    @yield('content')
  </main>

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
                  <p class="mb-0">{{ session('error') }}</p>
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

  @if(session('error'))
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

