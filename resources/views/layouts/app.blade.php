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
      --beige: #dec3a6;
      --pale-autumn: #d98b4c;
      --autumn-primary: #bc5227;
      --dark-autumn: #914420;
      --green-brown: #914420;
      --dark-brown: #352011;
      --light: #faf3e9ff;
      --light-beige: #f5e7d0;
      --soft-apricot: #f2c198;
      --dusty-rose: #e7b7a1;
      --light-coral: #f08080;
      --warm-cream:#fff3e2;
    }
    
    body { 
      background: var(--light-beige); 
      color: var(--dark-autumn);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .navbar { 
      background: linear-gradient(135deg, var(--green-brown) 0%, var(--dark-brown) 100%);
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

    .centered-links {
      justify-content:center;
      align-items: center !important;
      margin: 0 auto !important;
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
  @include('components.admin-nav')

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

