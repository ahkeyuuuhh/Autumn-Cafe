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
      
      /* Semantic naming for easy replacement */
      --beige: #d4c4b5;
      --pale-autumn: #b8a08a;
      --autumn-primary: #8b6f47;
      --dark-autumn: #6b5635;
      --green-brown: #6b5635;
      --dark-brown: #352b1d;
      --light: #faf8f6;
      --light-beige: #f5f0eb;
      --soft-apricot: #e8ddd2;
      --dusty-rose: #d4c4b5;
      --light-coral: #b8a08a;
      --warm-cream: #faf8f6;
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

    /* Modal Styles - Autumn Café Theme */
    .modal-content {
      border-radius: 20px;
      border: none;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }

    .modal-header {
      border-bottom: 3px solid rgba(255, 255, 255, 0.2);
      padding: 1.5rem 2rem;
      border-radius: 20px 20px 0 0;
    }

    .modal-header.bg-success {
      background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    }

    .modal-header.bg-danger {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
    }

    .modal-header.bg-warning {
      background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
    }

    .modal-header.bg-primary {
      background: linear-gradient(135deg, var(--pale-autumn) 0%, var(--autumn-primary) 100%) !important;
    }

    .modal-title {
      font-weight: 700;
      font-size: 1.25rem;
    }

    .modal-body {
      padding: 2rem;
      color: var(--dark-autumn);
    }

    .modal-footer {
      border-top: 1px solid var(--beige);
      padding: 1.5rem 2rem;
      background: var(--warm-cream);
    }

    .modal-footer .btn {
      border-radius: 10px;
      padding: 0.5rem 1.5rem;
      font-weight: 600;
    }

    .modal-backdrop {
      background-color: rgba(0, 0, 0, 0.6);
    }

    .modal-backdrop.show {
      opacity: 0.6;
    }

    /* Delete Modal Specific Styles */
    .delete-modal-content {
      border-top: 5px solid #dc3545;
    }

    .delete-modal-content .modal-body {
      padding: 2rem;
    }

    .delete-modal-content .alert {
      border-radius: 10px;
      border: 2px solid #ffc107;
      background: #fff3cd;
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
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>

  <!-- Universal Modal Cleanup Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to properly clean up modal backdrops
        function cleanupModals() {
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
        }

        // Add cleanup to all modals on the page
        const allModals = document.querySelectorAll('.modal');
        allModals.forEach(function(modalElement) {
            modalElement.addEventListener('hidden.bs.modal', function () {
                // Small delay to ensure Bootstrap completes its cleanup
                setTimeout(cleanupModals, 100);
            });

            // Also cleanup on show if there are lingering backdrops
            modalElement.addEventListener('show.bs.modal', function () {
                // Remove any existing backdrops before showing new modal
                const oldBackdrops = document.querySelectorAll('.modal-backdrop');
                if (oldBackdrops.length > 1) {
                    oldBackdrops.forEach((backdrop, index) => {
                        if (index < oldBackdrops.length - 1) {
                            backdrop.remove();
                        }
                    });
                }
            });
        });

        // Cleanup on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                setTimeout(cleanupModals, 100);
            }
        });
    });
  </script>

  @if(session('success'))
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const modalElement = document.getElementById('successModal');
          if (modalElement) {
              const successModal = new bootstrap.Modal(modalElement);
              successModal.show();
          }
      });
  </script>
  @endif

  @if(session('error'))
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const modalElement = document.getElementById('errorModal');
          if (modalElement) {
              const errorModal = new bootstrap.Modal(modalElement);
              errorModal.show();
          }
      });
  </script>
  @endif

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
