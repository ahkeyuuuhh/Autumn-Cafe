<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            
            /* Semantic naming */
            --beige: #d4c4b5;
            --pale-autumn: #b8a08a;
            --autumn-primary: #8b6f47;
            --dark-autumn: #6b5635;
            --dark-brown: #352b1d;
            --light-beige: #f5f0eb;
            --soft-apricot: #e8ddd2;
            --dusty-rose: #d4c4b5;
            --warm-cream: #faf8f6;
            --green-brown: #6b5635;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: 
                /* Coffee bean texture pattern */
                radial-gradient(circle at 15% 25%, rgba(139, 111, 71, 0.05) 2px, transparent 2px),
                radial-gradient(circle at 85% 75%, rgba(139, 111, 71, 0.05) 2px, transparent 2px),
                radial-gradient(circle at 45% 55%, rgba(107, 86, 53, 0.04) 1.5px, transparent 1.5px),
                radial-gradient(circle at 65% 35%, rgba(107, 86, 53, 0.04) 1.5px, transparent 1.5px),
                /* Subtle grain texture */
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 2px,
                    rgba(139, 111, 71, 0.01) 2px,
                    rgba(139, 111, 71, 0.01) 4px
                ),
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 2px,
                    rgba(139, 111, 71, 0.01) 2px,
                    rgba(139, 111, 71, 0.01) 4px
                ),
                /* Base gradient */
                linear-gradient(135deg, var(--brown-300) 0%, var(--brown-200) 100%);
            background-size: 80px 80px, 90px 90px, 60px 60px, 70px 70px, 100% 100%, 100% 100%, 100% 100%;
            background-position: 0 0, 40px 40px, 20px 20px, 50px 50px, 0 0, 0 0, 0 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            color: var(--dark-brown);
            overflow-x: hidden;
        }

        /* Coffee shop themed background elements */
        body::before {
            content: '\F4C0';
            font-family: 'bootstrap-icons';
            position: fixed;
            top: 10%;
            right: 5%;
            font-size: 120px;
            opacity: 0.06;
            animation: float 6s ease-in-out infinite;
            z-index: 0;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.1));
        }

        body::after {
            content: '\F284';
            font-family: 'bootstrap-icons';
            position: fixed;
            bottom: 10%;
            left: 5%;
            font-size: 100px;
            opacity: 0.06;
            animation: float 8s ease-in-out infinite reverse;
            z-index: 0;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.1));
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, var(--dark-brown) 0%, var(--brown-800) 100%);
            padding: 20px 0;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 10px,
                    rgba(255, 255, 255, 0.02) 10px,
                    rgba(255, 255, 255, 0.02) 20px
                );
            pointer-events: none;
        }

        .sidebar-brand {
            padding: 20px 25px;
            text-align: center;
            border-bottom: 2px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .sidebar-brand h3 {
            color: white;
            font-weight: 800;
            font-size: 1.5rem;
            margin: 0;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .sidebar-brand small {
            color: rgba(255,255,255,0.7);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-nav {
            padding: 0;
            list-style: none;
            position: relative;
            z-index: 1;
        }

        .sidebar-nav-item {
            margin-bottom: 5px;
        }

        .sidebar-nav-link {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar-nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--pale-autumn);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .sidebar-nav-link i {
            font-size: 1.2rem;
            margin-right: 15px;
            width: 25px;
            text-align: center;
        }

        .sidebar-nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            padding-left: 30px;
        }

        .sidebar-nav-link:hover::before {
            transform: scaleY(1);
        }

        .sidebar-nav-link.active {
            background: rgba(255,255,255,0.15);
            color: white;
            font-weight: 600;
            border-left: 4px solid var(--pale-autumn);
        }

        .sidebar-user {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px 25px;
            border-top: 2px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.2);
            z-index: 1;
        }

        .sidebar-user-info {
            color: white;
            margin-bottom: 10px;
        }

        .sidebar-user-info strong {
            display: block;
            font-size: 0.95rem;
        }

        .sidebar-user-info small {
            color: rgba(255,255,255,0.7);
            font-size: 0.75rem;
        }

        .btn-logout {
            width: 100%;
            background: rgba(220, 53, 69, 0.2);
            border: 2px solid rgba(220, 53, 69, 0.5);
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: #dc3545;
            border-color: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
        }

        /* Main Content Area */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
            transition: margin-left 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
            position: relative;
            transition: all 0.3s ease;
            background: white;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(139, 111, 71, 0.02) 1px, transparent 1px),
                radial-gradient(circle at 80% 80%, rgba(139, 111, 71, 0.02) 1px, transparent 1px);
            background-size: 40px 40px, 60px 60px;
            pointer-events: none;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .hover-card {
            cursor: pointer;
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

        /* Button Overrides for Brown Theme */
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            border-color: var(--autumn-primary);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--dark-autumn) 0%, var(--autumn-primary) 100%);
            border-color: var(--dark-autumn);
            color: white;
        }

        .btn-outline-primary {
            color: var(--autumn-primary);
            border-color: var(--autumn-primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--autumn-primary);
            border-color: var(--autumn-primary);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--pale-autumn) 0%, var(--beige) 100%);
            border-color: var(--pale-autumn);
            color: var(--dark-brown);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, var(--beige) 0%, var(--pale-autumn) 100%);
            border-color: var(--beige);
            color: var(--dark-brown);
        }

        .btn-outline-secondary {
            color: var(--dark-autumn);
            border-color: var(--dark-autumn);
        }

        .btn-outline-secondary:hover {
            background-color: var(--dark-autumn);
            border-color: var(--dark-autumn);
            color: white;
        }

        .badge.bg-warning {
            background-color: var(--pale-autumn) !important;
        }

        .text-success {
            color: var(--dark-autumn) !important;
        }

        .text-info {
            color: var(--pale-autumn) !important;
        }

        @yield('styles')
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h3><i class="bi bi-cup-hot-fill"></i> Autumn Café</h3>
            <small>Cashier Panel</small>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-nav-item">
                <a href="{{ route('cashier.dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('cashier.dashboard*') && !request()->routeIs('cashier.order.*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="{{ route('cashier.order.create') }}" class="sidebar-nav-link {{ request()->routeIs('cashier.order.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span>New Order</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-user">
            <div class="sidebar-user-info">
                <strong><i class="bi bi-person-circle"></i> {{ Auth::check() ? Auth::user()->name : 'Guest' }}</strong>
                <small>Cashier</small>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
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
