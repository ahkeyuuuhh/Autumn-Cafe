@extends('layouts.app')

@section('content')
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
        --soft-apricot: #e8ddd2;
        --dusty-rose: #d4c4b5;
        --warm-cream: #faf8f6;
        --light-beige: #f5f0eb;
    }

    .order-header {
        background: var(--warm-cream);
        padding: 2rem;
        border-radius: 20px;
        border: 3px dashed var(--beige);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .order-header::before {
        content: '🛒';
        position: absolute;
        font-size: 6rem;
        opacity: 0.1;
        right: -1rem;
        top: -1rem;
    }

    .order-header h1 {
        color: var(--dark-autumn);
        font-weight: 700;
        margin: 0;
        font-size: 2rem;
    }

    .order-header .lead {
        color: var(--pale-autumn);
        margin: 0.5rem 0 0 0;
        font-size: 1rem;
    }

    .form-card {
        background: white;
        border-radius: 20px;
        border: none;
        border-top: 8px solid var(--dusty-rose);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05),
                    0 10px 20px rgba(0, 0, 0, 0.05),
                    0 15px 30px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-bottom: 1.5rem;
    }

    .form-card h4 {
        color: var(--pale-autumn);
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .form-select, .form-control {
        border: 2px solid var(--beige);
        border-radius: 10px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-select:focus, .form-control:focus {
        border-color: var(--pale-autumn);
        box-shadow: 0 0 0 0.2rem rgba(217, 139, 76, 0.25);
    }

    .menu-item-card {
        border: 2px solid var(--beige);
        border-radius: 15px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        background: white;
    }

    .menu-item-card:hover {
        border-color: var(--pale-autumn);
        box-shadow: 0 3px 10px rgba(217, 139, 76, 0.2);
        transform: translateY(-2px);
    }

    .menu-item-card.selected {
        border-color: var(--autumn-primary);
        background: var(--warm-cream);
        box-shadow: 0 4px 12px rgba(188, 82, 39, 0.3);
    }

    .menu-item-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
    }

    .category-badge {
        background: linear-gradient(135deg, var(--soft-apricot) 0%, var(--dusty-rose) 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .stock-badge {
        background: var(--beige);
        color: var(--dark-autumn);
        padding: 0.25rem 0.75rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .stock-badge.low-stock {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
    }

    .stock-badge.out-of-stock {
        background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
        color: #991b1b;
    }

    .quantity-input {
        width: 80px;
        text-align: center;
        border: 2px solid var(--beige);
        border-radius: 10px;
        font-weight: 600;
    }

    .quantity-input:focus {
        border-color: var(--pale-autumn);
        box-shadow: 0 0 0 0.2rem rgba(217, 139, 76, 0.25);
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .menu-item-card .row {
            flex-direction: column;
        }

        .menu-item-card .col-md-6,
        .menu-item-card .col-md-2 {
            width: 100%;
            margin-bottom: 0.75rem;
            text-align: left !important;
        }

        .menu-item-card .col-md-2:last-child {
            text-align: center !important;
        }

        .stock-badge {
            display: inline-block;
        }

        .quantity-input {
            width: 100%;
            max-width: 200px;
        }
    }

    @media (max-width: 768px) {
        .menu-item-card {
            padding: 0.75rem;
        }

        .menu-item-image {
            width: 50px;
            height: 50px;
        }

        .stock-badge {
            font-size: 0.75rem;
            padding: 0.2rem 0.6rem;
        }

        .category-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
        }
    }

    .order-summary {
        background: linear-gradient(135deg, var(--warm-cream) 0%, var(--light-beige) 100%);
        border-radius: 20px;
        border: 3px solid var(--beige);
        padding: 2rem;
        position: sticky;
        top: 20px;
    }

    .order-summary h4 {
        color: var(--dark-autumn);
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .summary-item {
        padding: 0.75rem 0;
        border-bottom: 1px dashed var(--beige);
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .total-row {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--autumn-primary);
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 3px solid var(--autumn-primary);
    }

    .btn-create-order {
        background: linear-gradient(135deg, var(--pale-autumn) 0%, var(--autumn-primary) 100%);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .btn-create-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(188, 82, 39, 0.4);
        color: white;
    }

    .btn-create-order:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-cancel {
        background: white;
        border: 2px solid var(--beige);
        color: var(--dark-autumn);
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: var(--warm-cream);
        border-color: var(--pale-autumn);
        color: var(--dark-autumn);
    }

    .empty-cart {
        text-align: center;
        padding: 2rem;
        color: var(--pale-autumn);
    }

    .empty-cart i {
        font-size: 3rem;
        opacity: 0.3;
        margin-bottom: 0.5rem;
    }
</style>

<div class="container">
    <!-- Page Header -->
    <div class="order-header">
        <h1>
            <i class="bi bi-plus-circle-fill"></i> Create New Order
        </h1>
        <p class="lead">🛍️ Select items and create an order for a customer</p>
    </div>

    <form id="orderForm" action="{{ route('orders.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-lg-8">
                <!-- Customer Selection -->
                <div class="form-card">
                    <h4>
                        <i class="bi bi-person-circle"></i> Customer Information
                    </h4>
                    
                    <div class="mb-3">
                        <label for="customer_id" class="form-label" style="color: var(--dark-autumn); font-weight: 600;">Select Customer (Optional)</label>
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
                        <small style="color: var(--pale-autumn);">
                            <i class="bi bi-info-circle"></i> Leave blank for walk-in customers
                        </small>
                    </div>
                </div>

                <!-- Menu Items Selection -->
                <div class="form-card">
                    <h4>
                        <i class="bi bi-cart-plus"></i> Select Menu Items
                    </h4>
                    
                    @if($menuItems->isEmpty())
                        <div class="alert" style="background: var(--warm-cream); border: 2px solid var(--beige); color: var(--dark-autumn);">
                            <i class="bi bi-exclamation-triangle"></i> No menu items available with stock. Please add items to the menu first.
                        </div>
                    @else
                        <div id="menuItemsContainer">
                            @foreach($menuItems as $item)
                                <div class="menu-item-card" data-item-id="{{ $item->id }}" data-price="{{ $item->price }}" data-stock="{{ $item->stock }}">
                                    <div class="row align-items-center g-3">
                                        <div class="col-md-6 col-12">
                                            <div class="d-flex align-items-center">
                                                @if($item->image)
                                                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="menu-item-image me-3">
                                                @else
                                                    <div class="menu-item-image me-3 d-flex align-items-center justify-content-center" style="background: var(--warm-cream);">
                                                        <i class="bi bi-cup-straw" style="color: var(--pale-autumn); font-size: 1.5rem;"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <strong style="color: var(--dark-autumn);">{{ $item->name }}</strong>
                                                    <br>
                                                    <span class="category-badge">{{ $item->category }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-6 text-md-center">
                                            <div class="d-md-none">
                                                <small style="color: var(--pale-autumn); font-weight: 600;">Price:</small>
                                            </div>
                                            <strong style="color: var(--autumn-primary);">₱{{ number_format($item->price, 2) }}</strong>
                                        </div>
                                        <div class="col-md-2 col-6 text-md-center">
                                            <div class="d-md-none">
                                                <small style="color: var(--pale-autumn); font-weight: 600;">Available:</small>
                                            </div>
                                            @php
                                                $stockClass = '';
                                                if ($item->stock <= 0) {
                                                    $stockClass = 'out-of-stock';
                                                } elseif ($item->stock <= 5) {
                                                    $stockClass = 'low-stock';
                                                }
                                            @endphp
                                            <span class="stock-badge {{ $stockClass }}">
                                                <i class="bi bi-box-seam"></i> {{ $item->stock }}
                                            </span>
                                        </div>
                                        <div class="col-md-2 col-12 text-md-end text-center">
                                            @if($item->stock > 0)
                                                <input type="number" 
                                                       class="form-control quantity-input" 
                                                       min="0" 
                                                       max="{{ $item->stock }}" 
                                                       value="0"
                                                       data-item-id="{{ $item->id }}"
                                                       placeholder="Qty">
                                            @else
                                                <button class="btn btn-sm btn-secondary" disabled style="border-radius: 8px; padding: 0.5rem 1rem;">
                                                    <i class="bi bi-x-circle"></i> Out of Stock
                                                </button>
                                            @endif
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
                    <h4>
                        <i class="bi bi-receipt"></i> Order Summary
                    </h4>
                    
                    <div id="summaryItems">
                        <div class="empty-cart">
                            <i class="bi bi-cart-x d-block"></i>
                            <p class="mb-0">No items selected</p>
                        </div>
                    </div>
                    
                    <div class="total-row">
                        <div class="d-flex justify-content-between">
                            <span>TOTAL:</span>
                            <span id="totalAmount">₱0.00</span>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-create-order" id="submitBtn" disabled>
                            <i class="bi bi-check-circle"></i> Create Order
                        </button>
                        <a href="{{ route('orders.index') }}" class="btn btn-cancel">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
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
                                    <strong style="color: var(--dark-autumn);">${itemName}</strong>
                                    <span style="color: var(--autumn-primary); font-weight: 700;">₱${subtotal.toFixed(2)}</span>
                                </div>
                                <small style="color: var(--pale-autumn);">${quantity} × ₱${price.toFixed(2)}</small>
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
                        <div class="empty-cart">
                            <i class="bi bi-cart-x d-block"></i>
                            <p class="mb-0">No items selected</p>
                        </div>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @if(session('error') || $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('errorModal');
            if (modalElement) {
                const errorModal = new bootstrap.Modal(modalElement);
                errorModal.show();
            }
        });
    </script>
    @endif

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection