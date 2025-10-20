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
            --warm-cream: #faf8f6;
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
            position: relative;
            overflow-x: hidden;
        }

        /* Coffee shop themed background elements */
        body::before {
            content: '\F5E4';
            font-family: 'bootstrap-icons';
            position: fixed;
            top: 10%;
            left: 5%;
            font-size: 120px;
            opacity: 0.08;
            animation: float 6s ease-in-out infinite;
            z-index: 0;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.1));
        }

        body::after {
            content: '\F284';
            font-family: 'bootstrap-icons';
            position: fixed;
            bottom: 10%;
            right: 5%;
            font-size: 100px;
            opacity: 0.08;
            animation: float 8s ease-in-out infinite reverse;
            z-index: 0;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.1));
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Background decorative icons */
        .bg-icon {
            position: fixed;
            font-size: 70px;
            opacity: 0.06;
            z-index: 0;
            pointer-events: none;
            filter: drop-shadow(1px 1px 2px rgba(0,0,0,0.08));
        }

        .bg-icon-1 { top: 15%; right: 10%; animation: float 7s ease-in-out infinite 0.5s; }
        .bg-icon-2 { top: 35%; left: 8%; animation: float 9s ease-in-out infinite 1.5s; }
        .bg-icon-3 { top: 50%; right: 18%; animation: float 6s ease-in-out infinite 2s; }
        .bg-icon-4 { top: 65%; left: 12%; animation: float 8s ease-in-out infinite 1s; }
        .bg-icon-5 { top: 75%; right: 25%; animation: float 7s ease-in-out infinite 2.5s; }
        
        .navbar {
            background: linear-gradient(135deg, rgba(139, 111, 71, 0.95) 0%, rgba(107, 86, 53, 0.95) 100%);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .navbar::before {
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
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            letter-spacing: -0.3px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 8px;
            position: relative;
            z-index: 1;
        }
        
        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
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
        
        .page-header {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            color: white;
            padding: 150px 0;
            margin-top: -100px; /* moved upwards a little */
            margin-bottom: 50px;
            position: relative;
            overflow: hidden;
            animation: slideInDown 0.6s ease-out;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px, 70px 70px;
            pointer-events: none;
        }

        .page-header h1 {
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            animation: fadeInUp 0.8s ease-out;
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.95;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .cart-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            border: 1px solid rgba(139, 111, 71, 0.1);
            position: relative;
            overflow: hidden;
            animation: slideInLeft 0.6s ease-out;
        }

        .cart-card::before {
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

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .cart-item {
            border-bottom: 2px solid var(--light-beige);
            padding: 25px 0;
            transition: all 0.3s ease;
            position: relative;
        }

        .cart-item:hover {
            background: linear-gradient(90deg, transparent 0%, rgba(139, 111, 71, 0.03) 50%, transparent 100%);
            padding-left: 10px;
            padding-right: 10px;
            margin-left: -10px;
            margin-right: -10px;
            border-radius: 12px;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .cart-item:hover .item-image {
            transform: scale(1.1) rotate(3deg);
            box-shadow: 0 8px 24px rgba(139, 111, 71, 0.3);
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--warm-cream);
            padding: 8px 16px;
            border-radius: 50px;
            border: 2px solid var(--light-beige);
            transition: all 0.3s ease;
        }

        .quantity-control:hover {
            border-color: var(--pale-autumn);
            box-shadow: 0 4px 12px rgba(139, 111, 71, 0.15);
        }
        
        .quantity-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 2px solid var(--autumn-primary);
            background: white;
            color: var(--autumn-primary);
            font-weight: bold;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .quantity-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: var(--autumn-primary);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .quantity-btn:hover::before {
            width: 100px;
            height: 100px;
        }

        .quantity-btn span {
            position: relative;
            z-index: 1;
        }
        
        .quantity-btn:hover {
            transform: scale(1.15);
            color: white;
            border-color: var(--dark-autumn);
        }

        .quantity-btn:active {
            transform: scale(0.95);
        }

        .quantity-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .quantity-btn:disabled:hover {
            transform: scale(1);
        }
        
        .quantity-display {
            font-weight: 700;
            font-size: 1.3rem;
            min-width: 45px;
            text-align: center;
            color: var(--dark-brown);
            background: white;
            padding: 4px 12px;
            border-radius: 20px;
        }
        
        .summary-card {
            background: linear-gradient(135deg, #fff 0%, var(--warm-cream) 100%);
            border-radius: 20px;
            padding: 40px;
            position: sticky;
            top: 100px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            border: 2px solid var(--light-beige);
            animation: slideInRight 0.6s ease-out;
            overflow: hidden;
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(139, 111, 71, 0.03) 1px, transparent 1px),
                radial-gradient(circle at 80% 80%, rgba(139, 111, 71, 0.03) 1px, transparent 1px);
            background-size: 50px 50px, 70px 70px;
            pointer-events: none;
        }

        .summary-card h4 {
            position: relative;
            z-index: 1;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 18px 0;
            border-bottom: 2px solid var(--light-beige);
            font-size: 1.05rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .summary-row:hover {
            padding-left: 10px;
            color: var(--autumn-primary);
        }
        
        .summary-total {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            padding-top: 25px;
            letter-spacing: -0.5px;
            position: relative;
            z-index: 1;
        }
        
        .btn-checkout {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            border: none;
            color: white;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            width: 100%;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 6px 20px rgba(139, 111, 71, 0.3);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-checkout::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-checkout:active::before {
            width: 500px;
            height: 500px;
            transition: width 0s, height 0s;
        }
        
        .btn-checkout:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 10px 30px rgba(139, 111, 71, 0.4);
            color: white;
        }

        .btn-checkout:active {
            transform: translateY(-2px) scale(0.98);
        }
        
        .btn-remove {
            color: #dc3545;
            border: 2px solid transparent;
            background: white;
            padding: 8px 16px;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
        }
        
        .btn-remove:hover {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
            transform: scale(1.1);
            box-shadow: 0 4px 16px rgba(220, 53, 69, 0.3);
        }

        .btn-remove:active {
            transform: scale(0.95);
        }

        .btn-outline-danger {
            border: 2px solid #dc3545;
            color: #dc3545;
            background: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(220, 53, 69, 0.3);
        }

        .btn-outline-secondary {
            border: 2px solid var(--pale-autumn);
            color: var(--dark-brown);
            background: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: var(--pale-autumn);
            color: white;
            border-color: var(--autumn-primary);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 111, 71, 0.3);
        }
        /* Empty state styling */
        .empty-cart-container {
            background: white;
            border-radius: 20px;
            padding: 80px 40px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            text-align: center;
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .empty-cart-container i {
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Price styling */
        .item-price {
            color: var(--dark-brown);
            font-weight: 600;
        }

        .item-subtotal {
            font-size: 1.3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Container styling */
        .container {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <!-- Background decorative icons -->
    <div class="bg-icon bg-icon-1">🥐</div>
    <div class="bg-icon bg-icon-2">🧁</div>
    <div class="bg-icon bg-icon-3">🍪</div>
    <div class="bg-icon bg-icon-4">🥖</div>
    <div class="bg-icon bg-icon-5">☕</div>

    @include('components.customer-nav')

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-cart-check-fill"></i> Your Shopping Cart</h1>
            <p class="lead mb-0">Review your items and proceed to checkout</p>
        </div>
    </div>

    <div class="container pb-5">
        @if(empty($cartItems))
            <div class="empty-cart-container">
                <i class="bi bi-cart-x" style="font-size: 6rem; color: var(--pale-autumn);"></i>
                <h2 class="mt-4 mb-3" style="color: var(--dark-brown); font-weight: 700;">Your cart is empty</h2>
                <p class="text-muted mb-4" style="font-size: 1.1rem;">Add some delicious items from our menu!</p>
                <a href="{{ route('customer.menu') }}" class="btn btn-checkout" style="width: auto; padding: 16px 50px; display: inline-block;">
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
                                        <h5 class="mb-2" style="color: var(--dark-brown); font-weight: 700;">{{ $item['item']->name }}</h5>
                                        <p class="item-price mb-1">₱{{ number_format($item['item']->price, 2) }} each</p>
                                        <small class="text-muted"><i class="bi bi-box-seam"></i> Stock: {{ $item['item']->stock }}</small>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <form action="{{ route('cart.update') }}" method="POST" class="quantity-control">
                                            @csrf
                                            <input type="hidden" name="menu_item_id" value="{{ $item['item']->id }}">
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="quantity-btn">
                                                <span>-</span>
                                            </button>
                                            <span class="quantity-display">{{ $item['quantity'] }}</span>
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="quantity-btn" 
                                                    {{ $item['quantity'] >= $item['item']->stock ? 'disabled' : '' }}>
                                                <span>+</span>
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <div class="col-md-2 text-end">
                                        <h5 class="item-subtotal">₱{{ number_format($item['subtotal'], 2) }}</h5>
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

        // Scroll-triggered animations for cart items
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe cart items for staggered animation
            document.querySelectorAll('.cart-item').forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
                observer.observe(item);
            });
        });

        // Add ripple effect to buttons
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-checkout, .btn-outline-danger, .btn-outline-secondary').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s ease-out';
                    ripple.style.pointerEvents = 'none';
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });
        });

        // Add style for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>

