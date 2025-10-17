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
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('customer.menu') }}">
                <i class="bi bi-cup-hot-fill"></i> Autumn Café
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.cart') }}">
                            <i class="bi bi-cart3"></i> Cart
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="cart-badge">{{ array_sum(session('cart')) }}</span>
                            @endif
                        </a>
                    </li>
                    @if(session('customer_id'))
                        <li class="nav-item">
                            <span class="nav-link">
                                <i class="bi bi-person-circle"></i> {{ session('customer_name') }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('customer.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.register') }}">
                                <i class="bi bi-person-plus"></i> Register
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1>🍂 Welcome to Autumn Café 🍁</h1>
            <p class="lead">Discover our delicious menu and order your favorites!</p>
        </div>
    </div>

    <div class="container pb-5">
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
                <p class="text-muted mt-3 fs-5">No menu items available at the moment.</p>
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
    </script>
</body>
</html>

