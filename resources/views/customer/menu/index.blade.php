<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Autumn Café</title>
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
            background: linear-gradient(135deg, var(--autumn-bg) 0%, var(--autumn-cream) 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: white !important;
        }
        
        .nav-link {
            color: var(--autumn-bg) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: white !important;
        }
        
        .cart-badge {
            background: #E74C3C;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-left: 5px;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
            margin-bottom: 50px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(255,255,255,0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 0 4px 15px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1;
        }

        .hero-section p {
            font-size: 1.2rem;
            font-weight: 400;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }
        
        .category-section {
            margin-bottom: 50px;
        }
        
        .category-title {
            color: var(--autumn-dark);
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 35px;
            padding-bottom: 20px;
            border-bottom: 4px solid transparent;
            border-image: linear-gradient(90deg, var(--autumn-primary) 0%, var(--autumn-secondary) 50%, transparent 100%);
            border-image-slice: 1;
            position: relative;
        }

        .category-title::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 60px;
            height: 4px;
            background: var(--autumn-accent);
        }
        
        .menu-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            border: 1px solid rgba(210, 105, 30, 0.1);
            position: relative;
        }
        
        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .menu-card:hover::before {
            transform: scaleX(1);
        }
        
        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(210, 105, 30, 0.2);
            border-color: var(--autumn-primary);
        }
        
        .menu-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        
        .menu-card:hover .menu-image {
            transform: scale(1.05);
        }
        
        .menu-card-body {
            padding: 25px;
        }
        
        .menu-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--autumn-dark);
            margin-bottom: 8px;
            line-height: 1.3;
            min-height: 54px;
        }
        
        .menu-description {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 15px;
            line-height: 1.5;
            height: 40px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        .menu-price {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
        }
        
        .stock-badge {
            font-size: 0.85rem;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        
        .btn-add-cart {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 1rem;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(210, 105, 30, 0.3);
        }
        
        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(210, 105, 30, 0.5);
            color: white;
        }
        
        .btn-add-cart:active {
            transform: translateY(0);
        }
        
        .quantity-input {
            width: 80px;
            text-align: center;
            border: 2px solid var(--autumn-light);
            border-radius: 10px;
            padding: 8px;
        }
        
        .search-filter-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid rgba(210, 105, 30, 0.1);
        }
        
        .search-bar {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 14px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .search-bar:focus {
            border-color: var(--autumn-primary);
            box-shadow: 0 0 0 4px rgba(210, 105, 30, 0.1);
            outline: none;
        }
        
        .category-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
        }
        
        .category-pill {
            padding: 12px 24px;
            border: 2px solid #e0e0e0;
            border-radius: 30px;
            background: white;
            color: var(--autumn-dark);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.95rem;
        }
        
        .category-pill:hover {
            background: var(--autumn-primary);
            color: white;
            border-color: var(--autumn-primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(210, 105, 30, 0.3);
        }
        
        .category-pill.active {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            color: white;
            border-color: var(--autumn-primary);
            box-shadow: 0 4px 12px rgba(210, 105, 30, 0.3);
        }
        
        .btn-search {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            border: none;
            color: white;
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(210, 105, 30, 0.3);
        }
        
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(210, 105, 30, 0.4);
        }
        
        .btn-clear {
            background: #6c757d;
            border: none;
            color: white;
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-clear:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, var(--autumn-secondary) 0%, var(--autumn-dark) 100%);
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
            z-index: 1000;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
        }
        
        .sidebar.collapsed {
            transform: translateX(-280px);
        }
        
        .sidebar-brand {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            background: rgba(0,0,0,0.1);
        }
        
        .sidebar-brand h3 {
            color: var(--autumn-accent);
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            margin: 0;
        }
        
        .sidebar-menu a, .sidebar-menu button {
            display: flex;
            align-items: center;
            padding: 16px 25px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 1rem;
            font-weight: 500;
            border-left: 3px solid transparent;
        }
        
        .sidebar-menu a:hover, .sidebar-menu button:hover {
            background: rgba(210, 105, 30, 0.2);
            padding-left: 30px;
            border-left-color: var(--autumn-accent);
            color: white;
        }
        
        .sidebar-menu i {
            margin-right: 12px;
            font-size: 1.3rem;
        }
        
        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 300px;
            z-index: 1001;
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            border: none;
            color: white;
            padding: 12px 16px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(210, 105, 30, 0.4);
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle.collapsed {
            left: 20px;
        }
        
        .sidebar-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(210, 105, 30, 0.5);
        }
        
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .main-content.expanded {
            margin-left: 0;
        }
        
        .user-info {
            padding: 15px 25px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: var(--autumn-cream);
        }
        
        .cart-badge-sidebar {
            background: var(--autumn-primary);
            color: white;
            border-radius: 20px;
            padding: 4px 10px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-left: auto;
            box-shadow: 0 2px 8px rgba(210, 105, 30, 0.4);
        }
        
        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }
            
            .sidebar.collapsed {
                transform: translateX(-100%);
            }
            
            .sidebar:not(.collapsed) {
                transform: translateX(0);
            }
            
            .sidebar-toggle {
                left: 20px;
                top: 15px;
                z-index: 1002;
            }
            
            .sidebar-toggle.collapsed {
                left: 20px;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .main-content.expanded {
                margin-left: 0;
            }
            
            .hero-section {
                padding: 40px 0;
            }
            
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .menu-card {
                margin-bottom: 20px;
            }
            
            .search-filter-section {
                padding: 15px;
            }
            
            .category-pills {
                flex-direction: column;
            }
            
            .category-pill {
                width: 100%;
                text-align: center;
            }
            
            .btn-search, .btn-clear {
                width: 100%;
                margin-bottom: 10px;
            }
        }
        
        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 1.5rem;
            }
            
            .hero-section p {
                font-size: 0.9rem;
            }
            
            .menu-card-body {
                padding: 15px;
            }
            
            .menu-name {
                font-size: 1.1rem;
            }
            
            .menu-price {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h3><i class="bi bi-cup-hot-fill"></i> Autumn Café</h3>
            <p class="text-muted small mb-0">Customer Portal</p>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('customer.menu') }}">
                    <i class="bi bi-shop"></i> Menu
                </a>
            </li>
            <li>
                <a href="{{ route('customer.cart') }}">
                    <i class="bi bi-cart3"></i> My Cart
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="cart-badge-sidebar">{{ array_sum(session('cart')) }}</span>
                    @endif
                </a>
            </li>
            @if(session('customer_id'))
                <li>
                    <a href="{{ route('customer.settings') }}">
                        <i class="bi bi-gear"></i> Account Settings
                    </a>
                </li>
            @endif
        </ul>
        
        <div class="user-info">
            @if(session('customer_id'))
                <div class="mb-3">
                    <i class="bi bi-person-circle"></i> {{ session('customer_name') }}
                </div>
                <form action="{{ route('customer.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-menu">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            @else
                <a href="{{ route('customer.login') }}" class="btn btn-sm btn-outline-light w-100 mb-2">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                <a href="{{ route('customer.register') }}" class="btn btn-sm btn-warning w-100">
                    <i class="bi bi-person-plus"></i> Register
                </a>
            @endif
        </div>
    </div>
    
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
        <i class="bi bi-list" id="toggleIcon"></i>
    </button>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1>🍂 Welcome to Autumn Café 🍁</h1>
            <p class="lead">Discover our delicious menu and order your favorites!</p>
        </div>
    </div>

    <div class="container pb-5">
        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <form method="GET" action="{{ route('customer.menu') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label for="search" class="form-label fw-bold">
                            <i class="bi bi-search"></i> Search Menu
                        </label>
                        <input type="text" 
                               class="form-control search-bar" 
                               id="search" 
                               name="search" 
                               placeholder="Search by name or description..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-search">
                                <i class="bi bi-search me-2"></i>Search
                            </button>
                            <a href="{{ route('customer.menu') }}" class="btn btn-clear">
                                <i class="bi bi-x-circle me-2"></i>Clear
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <label class="form-label fw-bold">
                        <i class="bi bi-funnel"></i> Filter by Category
                    </label>
                    <div class="category-pills">
                        <a href="{{ route('customer.menu') }}" 
                           class="category-pill {{ !request('category') || request('category') == 'all' ? 'active' : '' }}">
                            <i class="bi bi-grid-3x3-gap me-1"></i> All
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('customer.menu', ['category' => $cat, 'search' => request('search')]) }}" 
                               class="category-pill {{ request('category') == $cat ? 'active' : '' }}">
                                <i class="bi bi-cup-straw me-1"></i> {{ $cat }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>

        @if(request('search') || request('category'))
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                @if(request('search'))
                    Showing results for: <strong>"{{ request('search') }}"</strong>
                @endif
                @if(request('category') && request('category') != 'all')
                    in category: <strong>{{ request('category') }}</strong>
                @endif
            </div>
        @endif

        @forelse($menuItems as $category => $items)
            <div class="category-section">
                <h2 class="category-title">
                    <i class="bi bi-cup-straw"></i> {{ $category }}
                </h2>
                
                <div class="row g-4">
                    @foreach($items as $item)
                        <div class="col-md-4 col-lg-3">
                            <div class="menu-card">
                                @if($item->image)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="menu-image">
                                @else
                                    <div class="menu-image bg-light d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cup-straw" style="font-size: 4rem; color: #ccc;"></i>
                                    </div>
                                @endif
                                
                                <div class="menu-card-body">
                                    <div class="menu-name">{{ $item->name }}</div>
                                    <div class="menu-price">₱{{ number_format($item->price, 2) }}</div>
                                    
                                    @if($item->description)
                                        <p class="text-muted small mb-3">{{ Str::limit($item->description, 80) }}</p>
                                    @endif
                                    
                                    <div class="mb-3">
                                        <span class="stock-badge {{ $item->stock > 10 ? 'bg-success' : 'bg-warning' }} text-white">
                                            <i class="bi bi-box-seam"></i> {{ $item->stock }} in stock
                                        </span>
                                    </div>
                                    
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                                        <div class="row g-2 align-items-center mb-3">
                                            <div class="col">
                                                <label class="small fw-bold">Quantity:</label>
                                                <input type="number" 
                                                       name="quantity" 
                                                       class="quantity-input form-control" 
                                                       value="1" 
                                                       min="1" 
                                                       max="{{ $item->stock }}"
                                                       required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn-add-cart">
                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 5rem; color: #ccc;"></i>
                @if(request('search') || request('category'))
                    <p class="text-muted mt-3 fs-5">No menu items found matching your search criteria.</p>
                    <a href="{{ route('customer.menu') }}" class="btn btn-clear mt-3">
                        <i class="bi bi-arrow-left me-2"></i>View All Items
                    </a>
                @else
                    <p class="text-muted mt-3 fs-5">No menu items available at the moment.</p>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-check-circle-fill"></i> Success
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
    <div class="modal fade" id="errorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill"></i> Error
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ session('error') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show success modal if there's a success message
        @if(session('success'))
            window.addEventListener('DOMContentLoaded', function() {
                const modalElement = document.getElementById('successModal');
                const successModal = new bootstrap.Modal(modalElement);
                successModal.show();
                
                modalElement.addEventListener('hidden.bs.modal', function () {
                    document.body.classList.remove('modal-open');
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                });
            });
        @endif

        // Show error modal if there's an error message
        @if(session('error'))
            window.addEventListener('DOMContentLoaded', function() {
                const modalElement = document.getElementById('errorModal');
                const errorModal = new bootstrap.Modal(modalElement);
                errorModal.show();
                
                modalElement.addEventListener('hidden.bs.modal', function () {
                    document.body.classList.remove('modal-open');
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                });
            });
        @endif

        // Sidebar toggle functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleBtn = document.getElementById('sidebarToggle');
            const toggleIcon = document.getElementById('toggleIcon');
            
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            toggleBtn.classList.toggle('collapsed');
            
            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.className = 'bi bi-list';
            } else {
                toggleIcon.className = 'bi bi-x-lg';
            }
        }

        // Auto-refresh every 10 seconds for smooth user experience
        setTimeout(function() {
            // Only refresh if no modal is open
            if (!document.querySelector('.modal.show')) {
                window.location.reload();
            }
        }, 10000); // 10 seconds
    </script>
</div> <!-- Close main-content -->
</body>
</html>

