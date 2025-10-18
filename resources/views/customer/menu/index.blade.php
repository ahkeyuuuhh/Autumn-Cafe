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
            --warm-cream: #fff3e2;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: var(--light);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            color: var(--dark-brown);
        }
        
        /* New top navigation bar replacing sidebar for better mobile experience */
        .navbar {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            letter-spacing: -0.3px;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 8px;
            position: relative;
        }
        
        .nav-link:hover {
            color: white !important;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--soft-apricot);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .cart-badge {
            background: var(--pale-autumn);
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-left: 6px;
            box-shadow: 0 2px 8px rgba(188, 82, 39, 0.3);
        }
        
        /* Hero section redesigned with better spacing and typography */
        .hero-section {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
            margin-bottom: 60px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
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
            background: radial-gradient(circle at 30% 50%, rgba(255,255,255,0.08) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .hero-section h1 {
            font-size: 3.2rem;
            font-weight: 800;
            margin-bottom: 12px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1;
            letter-spacing: -0.5px;
        }

        .hero-section p {
            font-size: 1.2rem;
            font-weight: 400;
            opacity: 0.95;
            position: relative;
            z-index: 1;
            letter-spacing: 0.2px;
        }
        
        /* Main container with better padding and spacing */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Search and filter section redesigned with cleaner layout */
        .search-filter-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 60px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            border: 1px solid rgba(188, 82, 39, 0.06);
        }
        
        .search-filter-section h3 {
            color: var(--dark-brown);
            font-weight: 700;
            margin-bottom: 24px;
            font-size: 1.3rem;
            letter-spacing: -0.2px;
        }
        
        .search-bar {
            border: 2px solid var(--light-beige);
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: var(--warm-cream);
            color: var(--dark-brown);
        }
        
        .search-bar::placeholder {
            color: #999;
        }
        
        .search-bar:focus {
            border-color: var(--autumn-primary);
            box-shadow: 0 0 0 4px rgba(188, 82, 39, 0.1);
            outline: none;
            background: white;
        }
        
        .category-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
        }
        
        .category-pill {
            padding: 12px 24px;
            border: 2px solid var(--light-beige);
            border-radius: 25px;
            background: white;
            color: var(--dark-brown);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }
        
        .category-pill:hover {
            background: var(--soft-apricot);
            border-color: var(--pale-autumn);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(188, 82, 39, 0.2);
            color: var(--dark-brown);
        }
        
        .category-pill.active {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            color: white;
            border-color: var(--autumn-primary);
            box-shadow: 0 4px 16px rgba(188, 82, 39, 0.3);
        }
        
        .btn-search {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            border: none;
            color: white;
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(188, 82, 39, 0.25);
            letter-spacing: 0.3px;
            font-size: 0.95rem;
        }
        
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(188, 82, 39, 0.35);
            color: white;
        }
        
        .btn-clear {
            background: var(--beige);
            border: none;
            color: var(--dark-brown);
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            font-size: 0.95rem;
        }
        
        .btn-clear:hover {
            background: var(--soft-apricot);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(188, 82, 39, 0.15);
            color: var(--dark-brown);
        }
        
        /* Category section with improved typography and spacing */
        .category-section {
            margin-bottom: 70px;
        }
        
        .category-title {
            color: var(--dark-brown);
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 40px;
            padding-bottom: 16px;
            border-bottom: 3px solid var(--pale-autumn);
            position: relative;
            letter-spacing: -0.3px;
        }

        .category-title::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
        }
        /* Menu grid with better responsive design */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        /* Menu card redesigned with better visual hierarchy (smaller) */
        .menu-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(188, 82, 39, 0.05);
            position: relative;
            display: flex;
            flex-direction: column;
            height: auto; /* allow cards to size to their content */
        }

        /* Reduce image height to make card more compact */
        .menu-card .menu-image {
            height: 150px !important;
            object-fit: cover;
        }
        
        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
            z-index: 1;
        }
        
        .menu-card:hover::before {
            transform: scaleX(1);
        }
        
        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(188, 82, 39, 0.18);
            border-color: var(--autumn-primary);
        }
        
        .menu-image {
            width: 100%;
            height: 200px !important;
            object-fit: cover;
            transition: transform 0.4s ease;
            object-position: top !important;
        }
        
        .menu-card:hover .menu-image {
            transform: scale(1.06);
        }
        
        .menu-card-body {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .menu-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-brown);
            margin-bottom: 8px;
            line-height: 1.3;
            letter-spacing: -0.2px;
        }
        
        .menu-description {
            font-size: 0.85rem;
            color: #888;
            margin-bottom: 12px;
            line-height: 1.4;
            height: 34px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        .menu-price {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
            letter-spacing: -0.3px;
        }
        
        .stock-badge {
            font-size: 0.8rem;
            padding: 8px 14px;
            border-radius: 18px;
            font-weight: 600;
            letter-spacing: 0.2px;
            display: inline-block;
            margin-bottom: 16px;
        }
        
        .stock-badge.in-stock {
            background: linear-gradient(135deg, var(--soft-apricot) 0%, var(--beige) 100%);
            color: var(--dark-brown);
            box-shadow: 0 2px 6px rgba(188, 82, 39, 0.12);
        }
        
        .stock-badge.low-stock {
            background: linear-gradient(135deg, var(--dusty-rose) 0%, var(--light-coral) 100%);
            color: white;
            box-shadow: 0 2px 6px rgba(224, 128, 128, 0.25);
        }
        
        .quantity-section {
            display: flex;
            gap: 10px;
            align-items: flex-end;
            margin-bottom: 16px;
        }
        
        .quantity-input {
            flex: 1;
            text-align: center;
            border: 2px solid var(--light-beige);
            border-radius: 10px;
            padding: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
            color: var(--dark-brown);
        }
        
        .quantity-input:focus {
            border-color: var(--autumn-primary);
            box-shadow: 0 0 0 3px rgba(188, 82, 39, 0.1);
            outline: none;
        }
        
        .btn-add-cart {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            border: none;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 12px rgba(188, 82, 39, 0.25);
            cursor: pointer;
        }
        
        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(188, 82, 39, 0.35);
            color: white;
        }
        
        .btn-add-cart:active {
            transform: translateY(0);
        }
        
        .alert-info {
            background: linear-gradient(135deg, var(--light-beige) 0%, var(--warm-cream) 100%);
            border: 2px solid var(--soft-apricot);
            color: var(--dark-brown);
            border-radius: 14px;
            padding: 16px 20px;
            box-shadow: 0 4px 12px rgba(188, 82, 39, 0.1);
            font-weight: 500;
            letter-spacing: 0.2px;
            margin-bottom: 40px;
        }
        
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }
        
        .empty-state i {
            font-size: 5rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-state p {
            color: #999;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        
        /* User menu dropdown styling */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-name {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .dropdown-menu {
            background: white;
            border: 1px solid var(--light-beige);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .dropdown-item {
            color: var(--dark-brown);
            transition: all 0.2s ease;
            padding: 10px 16px;
        }
        
        .dropdown-item:hover {
            background: var(--light-beige);
            color: var(--dark-brown);
        }
        
        /* Modal styling */
        .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        
        .modal-header {
            border: none;
            padding: 24px;
        }
        
        .modal-body {
            padding: 24px;
            color: var(--dark-brown);
        }
        
        .modal-footer {
            border: none;
            padding: 16px 24px;
        }
        
        /* Responsive design improvements */
        @media (max-width: 768px) {
            .hero-section {
                padding: 50px 0;
            }
            
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .hero-section p {
                font-size: 1rem;
            }
            
            .search-filter-section {
                padding: 24px;
            }
            
            .menu-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 20px;
            }
            
            .category-title {
                font-size: 1.5rem;
                margin-bottom: 24px;
            }
            
            .category-pills {
                gap: 10px;
            }
            
            .category-pill {
                padding: 10px 18px;
                font-size: 0.85rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 1.5rem;
            }
            
            .hero-section p {
                font-size: 0.9rem;
            }
            
            .menu-grid {
                grid-template-columns: 1fr;
            }
            
            .search-filter-section {
                padding: 16px;
            }
            
            .category-title {
                font-size: 1.3rem;
            }
            
            .menu-name {
                font-size: 1.1rem;
            }
            
            .menu-price {
                font-size: 1.5rem;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    @include('components.customer-nav')

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="main-container">
            <h1>🍂 Welcome to Autumn Café 🍁</h1>
            <p>Discover our delicious menu and order your favorites!</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container pb-5">
        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <form method="GET" action="{{ route('customer.menu') }}">
                <h3><i class="bi bi-search"></i> Find Your Favorite</h3>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-8">
                        <input type="text" 
                               class="form-control search-bar" 
                               name="search" 
                               placeholder="Search by name or description..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-search flex-grow-1">
                                <i class="bi bi-search"></i> Search
                            </button>
                            <a href="{{ route('customer.menu') }}" class="btn btn-clear">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label class="form-label fw-bold mb-3">
                        <i class="bi bi-funnel"></i> Filter by Category
                    </label>
                    <div class="category-pills">
                        <a href="{{ route('customer.menu') }}" 
                           class="category-pill {{ !request('category') || request('category') == 'all' ? 'active' : '' }}">
                            All Items
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('customer.menu', ['category' => $cat, 'search' => request('search')]) }}" 
                               class="category-pill {{ request('category') == $cat ? 'active' : '' }}">
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>

        @if(request('search') || request('category'))
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i>
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
                
                <div class="menu-grid">
                    @foreach($items as $item)
                        <div class="menu-card">
                            @if($item->image)
                                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="menu-image">
                            @else
                                <div class="menu-image bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cup-straw" style="font-size: 3.5rem; color: #ddd;"></i>
                                </div>
                            @endif
                            
                            <div class="menu-card-body">
                                <div class="menu-name">{{ $item->name }}</div>
                                
                                @if($item->description)
                                    <p class="menu-description">{{ $item->description }}</p>
                                @endif
                                
                                <div class="menu-price">₱{{ number_format($item->price, 2) }}</div>
                                
                                <span class="stock-badge {{ $item->stock > 10 ? 'in-stock' : 'low-stock' }}">
                                    <i class="bi bi-box-seam"></i> {{ $item->stock }} in stock
                                </span>
                                
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-auto">
                                    @csrf
                                    <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                                    <div class="quantity-section">
                                        <input type="number" 
                                               name="quantity" 
                                               class="quantity-input" 
                                               value="1" 
                                               min="1" 
                                               max="{{ $item->stock }}"
                                               required>
                                    </div>
                                    <button type="submit" class="btn-add-cart">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                @if(request('search') || request('category'))
                    <p>No menu items found matching your search criteria.</p>
                    <a href="{{ route('customer.menu') }}" class="btn btn-clear">
                        <i class="bi bi-arrow-left"></i> View All Items
                    </a>
                @else
                    <p>No menu items available at the moment.</p>
                @endif
            </div>
        @endforelse
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
</body>
</html>
