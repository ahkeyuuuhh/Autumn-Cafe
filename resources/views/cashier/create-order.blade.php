<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order - Cashier - Autumn Café</title>
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
            
            /* Legacy naming */
            --autumn-primary: #8b6f47;
            --dark-autumn: #6b5635;
            --autumn-accent: #b8a08a;
            --warm-cream: #faf8f6;
        }
        
        body {
            background: linear-gradient(135deg, #faf8f6 0%, #f5f0eb 100%);
            min-height: 100vh;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(188, 82, 39, 0.25);
        }
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .menu-item-card {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s;
        }
        .menu-item-card.selected {
            border-color: var(--autumn-primary);
            background: var(--warm-cream);
        }
        .menu-item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        .order-summary {
            background: linear-gradient(135deg, var(--warm-cream) 0%, #f5e7d0 100%);
            border-radius: 15px;
            padding: 25px;
            position: sticky;
            top: 20px;
            box-shadow: 0 4px 15px rgba(188, 82, 39, 0.15);
        }
        .summary-item {
            padding: 10px 0;
            border-bottom: 1px solid #d0d0d0;
        }
        .summary-item:last-child {
            border-bottom: none;
        }
        .total-row {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--autumn-primary);
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid var(--autumn-primary);
        }
        .quantity-input {
            width: 80px;
            text-align: center;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
        }
        .quantity-input:focus {
            border-color: var(--autumn-primary);
            box-shadow: 0 0 0 0.2rem rgba(188, 82, 39, 0.25);
        }
        .category-badge {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    @include('components.cashier-nav')

    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="mb-2">
                <i class="bi bi-plus-circle-fill"></i> Create New Order
            </h1>
            <p class="mb-0 opacity-75">Select items and create an order for a customer</p>
        </div>

        <form id="orderForm" action="{{ route('cashier.order.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-lg-8">
                    <!-- Customer Selection -->
                    <div class="form-card">
                        <h4 class="mb-3 text-primary">
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
                        <h4 class="mb-3 text-primary">
                            <i class="bi bi-cart-plus"></i> Select Menu Items
                        </h4>
                        
                        @if($menuItems->isEmpty())
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle"></i> No menu items available with stock.
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
                                                <strong class="text-primary">₱{{ number_format($item->price, 2) }}</strong>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <span class="badge bg-secondary">Stock: {{ $item->stock }}</span>
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
                        <h4 class="mb-4 text-primary">
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
                            <a href="{{ route('cashier.dashboard') }}" class="btn btn-secondary">
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

    <!-- Modals -->
    @include('components.modals')

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

        @if(session('error') || $errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('errorModal'));
                modal.show();
            });
        @endif
    </script>
</body>
</html>
