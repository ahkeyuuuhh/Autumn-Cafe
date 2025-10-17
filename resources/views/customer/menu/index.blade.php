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
            --autumn-orange: #E67E22;
            --autumn-cream: #FFF9F3;
            --autumn-brown: #3B2F2F;
            --autumn-light-orange: #F39C12;
        }
        
        body {
            background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--autumn-brown) 0%, #2C1810 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--autumn-light-orange) !important;
        }
        
        .nav-link {
            color: var(--autumn-cream) !important;
            font-weight: 500;
        }
        
        .cart-badge {
            background: var(--autumn-orange);
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-left: 5px;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
            margin-bottom: 40px;
        }
        
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .category-section {
            margin-bottom: 50px;
        }
        
        .category-title {
            color: var(--autumn-brown);
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--autumn-orange);
        }
        
        .menu-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
            height: 100%;
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(230, 126, 34, 0.3);
        }
        
        .menu-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .menu-card-body {
            padding: 20px;
        }
        
        .menu-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--autumn-brown);
            margin-bottom: 10px;
        }
        
        .menu-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--autumn-orange);
            margin-bottom: 15px;
        }
        
        .stock-badge {
            font-size: 0.85rem;
            padding: 5px 12px;
            border-radius: 20px;
        }
        
        .btn-add-cart {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 126, 34, 0.4);
            color: white;
        }
        
        .quantity-input {
            width: 80px;
            text-align: center;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px;
        }
        
        .search-filter-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .search-bar {
            border: 2px solid var(--autumn-orange);
            border-radius: 25px;
            padding: 12px 20px;
            font-size: 1rem;
        }
        
        .search-bar:focus {
            border-color: var(--autumn-light-orange);
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
        }
        
        .category-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }
        
        .category-pill {
            padding: 10px 20px;
            border: 2px solid var(--autumn-orange);
            border-radius: 25px;
            background: white;
            color: var(--autumn-brown);
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
            cursor: pointer;
        }
        
        .category-pill:hover {
            background: var(--autumn-orange);
            color: white;
            transform: translateY(-2px);
        }
        
        .category-pill.active {
            background: var(--autumn-orange);
            color: white;
        }
        
        .btn-search {
            background: var(--autumn-orange);
            border: none;
            color: white;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-search:hover {
            background: var(--autumn-light-orange);
            transform: translateY(-2px);
        }
        
        .btn-clear {
            background: var(--autumn-brown);
            border: none;
            color: white;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-clear:hover {
            background: #2C1810;
            transform: translateY(-2px);
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: linear-gradient(180deg, var(--autumn-brown) 0%, #2C1810 100%);
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar.collapsed {
            transform: translateX(-250px);
        }
        
        .sidebar-brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-brand h3 {
            color: var(--autumn-light-orange);
            margin: 0;
            font-weight: bold;
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
            padding: 15px 25px;
            color: var(--autumn-cream);
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 1rem;
        }
        
        .sidebar-menu a:hover, .sidebar-menu button:hover {
            background: rgba(255,255,255,0.1);
            padding-left: 30px;
        }
        
        .sidebar-menu i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 270px;
            z-index: 1001;
            background: var(--autumn-orange);
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }
        
        .sidebar-toggle.collapsed {
            left: 20px;
        }
        
        .sidebar-toggle:hover {
            background: var(--autumn-light-orange);
            transform: scale(1.1);
        }
        
        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
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
            background: var(--autumn-orange);
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.75rem;
            font-weight: bold;
            margin-left: auto;
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

        // Auto-refresh every 30 seconds for smooth user experience
        setTimeout(function() {
            // Only refresh if no modal is open
            if (!document.querySelector('.modal.show')) {
                window.location.reload();
            }
        }, 30000); // 30 seconds
    </script>
</div> <!-- Close main-content -->
</body>
</html>

