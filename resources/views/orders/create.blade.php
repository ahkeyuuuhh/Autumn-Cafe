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
            --warm-cream:#fff3e2;
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
        .container {
             margin-top: 3rem !important;
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
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem !important;
            margin-bottom: 2rem !important;
            border-radius: 8px !important;
            background-color: var(--dark-autumn) !important;
            color: white !important;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        
        .back-btn:hover {
            background-color: #6d3319 !important;
            transform: translateX(-2px);
            box-shadow: 0 4px 12px rgba(145, 68, 32, 0.25);
        }
    </style>
</head>
<body>
    <!-- Autumn Decorations -->
    <div class="autumn-decoration leaf-1">🍂</div>
    <div class="autumn-decoration leaf-2">🍁</div>
    
   
    <div class="container" style="position: relative; z-index: 1;">
          <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm shadow-sm back-btn">
            <i class="bi bi-arrow-left"></i> Back to Order Management
        </a>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="mb-2">
                <i class="bi bi-plus-circle-fill"></i> Create New Order
            </h1>
            <p class="mb-0 opacity-75">Select items and create an order for a customer</p>
        </div>

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
                    @if(session('error'))
                        <p class="mb-0">{{ session('error') }}</p>
                    @elseif($errors->any())
                        <strong>Validation Errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    @if(session('error') || $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('errorModal');
            const errorModal = new bootstrap.Modal(modalElement);
            errorModal.show();
            
            modalElement.addEventListener('hidden.bs.modal', function () {
                document.body.classList.remove('modal-open');
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            });
        });
    </script>
    @endif
</body>
</html>
