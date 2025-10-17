<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Autumn Café</title>
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
        
        .page-header {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
        }
        
        .cart-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .cart-item {
            border-bottom: 1px solid #e0e0e0;
            padding: 20px 0;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .quantity-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 2px solid var(--autumn-orange);
            background: white;
            color: var(--autumn-orange);
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .quantity-btn:hover {
            background: var(--autumn-orange);
            color: white;
        }
        
        .quantity-display {
            font-weight: bold;
            font-size: 1.2rem;
            min-width: 40px;
            text-align: center;
        }
        
        .summary-card {
            background: linear-gradient(135deg, var(--autumn-cream) 0%, #FFE8D6 100%);
            border-radius: 15px;
            padding: 30px;
            position: sticky;
            top: 20px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .summary-total {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--autumn-orange);
            padding-top: 20px;
        }
        
        .btn-checkout {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.2rem;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(230, 126, 34, 0.4);
            color: white;
        }
        
        .btn-remove {
            color: #dc3545;
            border: none;
            background: none;
            padding: 5px 15px;
            border-radius: 20px;
            transition: all 0.3s;
        }
        
        .btn-remove:hover {
            background: #dc3545;
            color: white;
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
                        <a class="nav-link active" href="{{ route('customer.cart') }}">
                            <i class="bi bi-cart3"></i> Cart
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
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-cart-check-fill"></i> Your Shopping Cart</h1>
            <p class="lead mb-0">Review your items and proceed to checkout</p>
        </div>
    </div>

    <div class="container pb-5">
        @if(empty($cartItems))
            <div class="cart-card text-center py-5">
                <i class="bi bi-cart-x" style="font-size: 5rem; color: #ccc;"></i>
                <h3 class="mt-4 mb-3">Your cart is empty</h3>
                <p class="text-muted mb-4">Add some delicious items from our menu!</p>
                <a href="{{ route('customer.menu') }}" class="btn btn-checkout" style="width: auto; padding: 12px 40px;">
                    <i class="bi bi-arrow-left"></i> Browse Menu
                </a>
            </div>
        @else
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-card">
                        <h3 class="mb-4" style="color: var(--autumn-brown);">
                            <i class="bi bi-basket3"></i> Cart Items ({{ count($cartItems) }})
                        </h3>
                        
                        @foreach($cartItems as $item)
                            <div class="cart-item">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        @if($item['item']->image)
                                            <img src="{{ $item['item']->image_url }}" alt="{{ $item['item']->name }}" class="item-image">
                                        @else
                                            <div class="item-image bg-light d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cup-straw" style="font-size: 2rem; color: #ccc;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h5 class="mb-1" style="color: var(--autumn-brown);">{{ $item['item']->name }}</h5>
                                        <p class="text-muted mb-0">₱{{ number_format($item['item']->price, 2) }} each</p>
                                        <small class="text-muted">Stock: {{ $item['item']->stock }}</small>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <form action="{{ route('cart.update') }}" method="POST" class="quantity-control">
                                            @csrf
                                            <input type="hidden" name="menu_item_id" value="{{ $item['item']->id }}">
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="quantity-btn">-</button>
                                            <span class="quantity-display">{{ $item['quantity'] }}</span>
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="quantity-btn" 
                                                    {{ $item['quantity'] >= $item['item']->stock ? 'disabled' : '' }}>+</button>
                                        </form>
                                    </div>
                                    
                                    <div class="col-md-2 text-end">
                                        <h5 style="color: var(--autumn-orange);">₱{{ number_format($item['subtotal'], 2) }}</h5>
                                    </div>
                                    
                                    <div class="col-md-1 text-end">
                                        <form action="{{ route('cart.remove', $item['item']->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-remove" onclick="return confirm('Remove this item from cart?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="mt-4">
                            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Clear entire cart?')">
                                    <i class="bi bi-trash3"></i> Clear Cart
                                </button>
                            </form>
                            <a href="{{ route('customer.menu') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-plus-circle"></i> Add More Items
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="summary-card">
                        <h4 class="mb-4" style="color: var(--autumn-brown);">
                            <i class="bi bi-receipt"></i> Order Summary
                        </h4>
                        
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span class="fw-bold">₱{{ number_format($subtotal, 2) }}</span>
                        </div>
                        
                        <div class="summary-total">
                            <div class="d-flex justify-content-between">
                                <span>Total:</span>
                                <span>₱{{ number_format($subtotal, 2) }}</span>
                            </div>
                        </div>
                        
                        <form action="{{ route('customer.checkout') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="btn-checkout">
                                <i class="bi bi-check-circle"></i> Confirm Order
                            </button>
                        </form>
                        
                        <div class="mt-3 text-center text-muted small">
                            <i class="bi bi-shield-check"></i> Secure checkout
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
        // Only show success modal for order confirmation, not cart updates
        @if(session('success'))
            window.addEventListener('DOMContentLoaded', function() {
                const modalElement = document.getElementById('successModal');
                const successModal = new bootstrap.Modal(modalElement);
                successModal.show();
                
                // Clean up backdrop when modal is hidden
                modalElement.addEventListener('hidden.bs.modal', function () {
                    document.body.classList.remove('modal-open');
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                });
            });
        @endif

        // Show error modal
        @if(session('error'))
            window.addEventListener('DOMContentLoaded', function() {
                const modalElement = document.getElementById('errorModal');
                const errorModal = new bootstrap.Modal(modalElement);
                errorModal.show();
                
                // Clean up backdrop when modal is hidden
                modalElement.addEventListener('hidden.bs.modal', function () {
                    document.body.classList.remove('modal-open');
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                });
            });
        @endif
    </script>
</body>
</html>

