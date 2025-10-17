<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order - Autumn Café</title>
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
            padding-bottom: 50px;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--autumn-brown) 0%, #2C1810 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--autumn-light-orange) !important;
        }
        
        .navbar-brand i {
            color: var(--autumn-orange);
        }
        
        .nav-link {
            color: var(--autumn-cream) !important;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: var(--autumn-light-orange) !important;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(230, 126, 34, 0.3);
            margin-bottom: 30px;
        }
        
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .menu-item-card {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .menu-item-card:hover {
            border-color: var(--autumn-orange);
            box-shadow: 0 3px 10px rgba(230, 126, 34, 0.2);
        }
        
        .menu-item-card.selected {
            border-color: var(--autumn-orange);
            background: var(--autumn-cream);
        }
        
        .menu-item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .order-summary {
            background: linear-gradient(135deg, var(--autumn-cream) 0%, #FFE8D6 100%);
            border-radius: 15px;
            padding: 25px;
            position: sticky;
            top: 20px;
        }
        
        .summary-item {
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .summary-item:last-child {
            border-bottom: none;
        }
        
        .total-row {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--autumn-orange);
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid var(--autumn-orange);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 126, 34, 0.4);
        }
        
        .btn-secondary {
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
        }
        
        .quantity-input {
            width: 80px;
            text-align: center;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
        }
        
        .quantity-input:focus {
            border-color: var(--autumn-orange);
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
        }
        
        .stock-badge {
            font-size: 0.85rem;
            padding: 4px 10px;
        }
        
        .category-badge {
            background: var(--autumn-orange);
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .autumn-decoration {
            position: fixed;
            opacity: 0.08;
            pointer-events: none;
            z-index: 0;
        }
        
        .leaf-1 {
            top: 100px;
            left: 50px;
            font-size: 100px;
            color: var(--autumn-orange);
            transform: rotate(25deg);
        }
        
        .leaf-2 {
            bottom: 100px;
            right: 50px;
            font-size: 120px;
            color: var(--autumn-light-orange);
            transform: rotate(-20deg);
        }
    </style>
</head>
<body>
    <!-- Autumn Decorations -->
    <div class="autumn-decoration leaf-1">🍂</div>
    <div class="autumn-decoration leaf-2">🍁</div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-cup-hot-fill"></i> Autumn Café
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu.index') }}">
                            <i class="bi bi-cup-straw"></i> Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('orders.index') }}">
                            <i class="bi bi-cart-check"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transactions.index') }}">
                            <i class="bi bi-receipt"></i> Transactions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customers.index') }}">
                            <i class="bi bi-people"></i> Customers
                        </a>
                    </li>
                </ul>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container" style="position: relative; z-index: 1;">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="mb-2">
                <i class="bi bi-plus-circle-fill"></i> Create New Order
            </h1>
            <p class="mb-0 opacity-75">Select items and create an order for a customer</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="bi bi-exclamation-triangle"></i> Validation Errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form id="orderForm" action="{{ route('orders.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-lg-8">
                    <!-- Customer Selection -->
                    <div class="form-card">
                        <h4 class="mb-3" style="color: var(--autumn-orange);">
                            <i class="bi bi-person-circle"></i> Customer Information
                        </h4>
                        
                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Select Customer (Optional)</label>
                            <select name="customer_id" id="customer_id" class="form-select">
                                <option value="">Walk-in Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} 
                                        @if($customer->phone)
                                            - {{ $customer->phone }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> Leave blank for walk-in customers
                            </small>
                        </div>
                    </div>

                    <!-- Menu Items Selection -->
                    <div class="form-card">
                        <h4 class="mb-3" style="color: var(--autumn-orange);">
                            <i class="bi bi-cart-plus"></i> Select Menu Items
                        </h4>
                        
                        @if($menuItems->isEmpty())
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle"></i> No menu items available with stock. Please add items to the menu first.
                            </div>
                        @else
                            <div id="menuItemsContainer">
                                @foreach($menuItems as $item)
                                    <div class="menu-item-card" data-item-id="{{ $item->id }}" data-price="{{ $item->price }}" data-stock="{{ $item->stock }}">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center">
                                                    @if($item->image)
                                                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="menu-item-image me-3">
                                                    @else
                                                        <div class="menu-item-image me-3 bg-light d-flex align-items-center justify-content-center">
                                                            <i class="bi bi-cup-straw text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <strong>{{ $item->name }}</strong>
                                                        <br>
                                                        <span class="category-badge">{{ $item->category }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <strong style="color: var(--autumn-orange);">₱{{ number_format($item->price, 2) }}</strong>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <span class="badge bg-secondary stock-badge">Stock: {{ $item->stock }}</span>
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <input type="number" 
                                                       class="form-control quantity-input" 
                                                       min="0" 
                                                       max="{{ $item->stock }}" 
                                                       value="0"
                                                       data-item-id="{{ $item->id }}"
                                                       placeholder="Qty">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h4 class="mb-4" style="color: var(--autumn-brown);">
                            <i class="bi bi-receipt"></i> Order Summary
                        </h4>
                        
                        <div id="summaryItems">
                            <p class="text-muted text-center py-4">
                                <i class="bi bi-cart-x" style="font-size: 2rem;"></i>
                                <br>No items selected
                            </p>
                        </div>
                        
                        <div class="total-row">
                            <div class="d-flex justify-content-between">
                                <span>TOTAL:</span>
                                <span id="totalAmount">₱0.00</span>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn" disabled>
                                <i class="bi bi-check-circle"></i> Create Order
                            </button>
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const summaryItems = document.getElementById('summaryItems');
            const totalAmountEl = document.getElementById('totalAmount');
            const submitBtn = document.getElementById('submitBtn');
            const orderForm = document.getElementById('orderForm');
            
            let selectedItems = {};
            
            // Update order summary
            function updateSummary() {
                let total = 0;
                let itemsHtml = '';
                let hasItems = false;
                
                quantityInputs.forEach(input => {
                    const quantity = parseInt(input.value) || 0;
                    const itemId = input.dataset.itemId;
                    const card = input.closest('.menu-item-card');
                    const price = parseFloat(card.dataset.price);
                    const itemName = card.querySelector('strong').textContent;
                    
                    if (quantity > 0) {
                        hasItems = true;
                        const subtotal = quantity * price;
                        total += subtotal;
                        
                        card.classList.add('selected');
                        selectedItems[itemId] = {
                            quantity: quantity,
                            price: price
                        };
                        
                        itemsHtml += `
                            <div class="summary-item">
                                <div class="d-flex justify-content-between mb-1">
                                    <strong>${itemName}</strong>
                                    <span>₱${subtotal.toFixed(2)}</span>
                                </div>
                                <small class="text-muted">${quantity} × ₱${price.toFixed(2)}</small>
                            </div>
                        `;
                    } else {
                        card.classList.remove('selected');
                        delete selectedItems[itemId];
                    }
                });
                
                if (hasItems) {
                    summaryItems.innerHTML = itemsHtml;
                    submitBtn.disabled = false;
                } else {
                    summaryItems.innerHTML = `
                        <p class="text-muted text-center py-4">
                            <i class="bi bi-cart-x" style="font-size: 2rem;"></i>
                            <br>No items selected
                        </p>
                    `;
                    submitBtn.disabled = true;
                }
                
                totalAmountEl.textContent = '₱' + total.toFixed(2);
            }
            
            // Listen to quantity changes
            quantityInputs.forEach(input => {
                input.addEventListener('input', updateSummary);
            });
            
            // Submit form with selected items
            orderForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Clear existing item inputs
                document.querySelectorAll('input[name^="items"]').forEach(input => input.remove());
                
                // Add selected items to form
                let itemIndex = 0;
                Object.keys(selectedItems).forEach(itemId => {
                    const item = selectedItems[itemId];
                    
                    const menuItemIdInput = document.createElement('input');
                    menuItemIdInput.type = 'hidden';
                    menuItemIdInput.name = `items[${itemIndex}][menu_item_id]`;
                    menuItemIdInput.value = itemId;
                    orderForm.appendChild(menuItemIdInput);
                    
                    const quantityInput = document.createElement('input');
                    quantityInput.type = 'hidden';
                    quantityInput.name = `items[${itemIndex}][quantity]`;
                    quantityInput.value = item.quantity;
                    orderForm.appendChild(quantityInput);
                    
                    itemIndex++;
                });
                
                orderForm.submit();
            });
        });
    </script>
</body>
</html>
