<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Cashier Dashboard') - Autumn Café</title>
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
      --warm-cream: #faf8f6;
    }
    
    body { 
      background: var(--light-beige); 
      color: var(--dark-autumn);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
    }
    
    .hover-card {
      transition: all 0.3s ease;
    }
    
    .hover-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    
    .stat-card {
      border-radius: 15px;
      border: none;
    }
    
    .stat-icon {
      transition: all 0.3s ease;
    }
    
    .hover-card:hover .stat-icon {
      transform: scale(1.1);
    }
    
    @yield('styles')
  </style>
</head>
<body>
  @include('components.cashier-nav')
  
  <div class="container-fluid py-4">
    @yield('content')
  </div>

  <!-- Modals -->
  @include('components.modals')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Universal Modal Cleanup
    document.addEventListener('DOMContentLoaded', function() {
      function cleanupModals() {
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
      }
      
      document.querySelectorAll('.modal').forEach(function(modalElement) {
        modalElement.addEventListener('hidden.bs.modal', function () {
          setTimeout(cleanupModals, 100);
        });
      });
    });

    // Show modals
    @if(session('success'))
      document.addEventListener('DOMContentLoaded', function() {
        const modal = new bootstrap.Modal(document.getElementById('successModal'));
        modal.show();
      });
    @endif

    @if(session('error'))
      document.addEventListener('DOMContentLoaded', function() {
        const modal = new bootstrap.Modal(document.getElementById('errorModal'));
        modal.show();
      });
    @endif
  </script>
  
  @yield('scripts')
</body>
</html>
