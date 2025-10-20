@extends('layouts.cashier')

@section('title', 'Create New Order')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--warm-cream) 0%, var(--light-beige) 100%);
        border: 3px dashed var(--beige);
        position: relative;
        overflow: hidden;
        padding: 2.5rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        animation: slideInDown 0.6s ease-out;
    }
    
    .page-header::before {
        content: '\F5E4';
        font-family: 'bootstrap-icons';
        position: absolute;
        font-size: 6rem;
        opacity: 0.1;
        right: 2rem;
        top: -1rem;
        animation: float 6s ease-in-out infinite;
    }

    .page-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(139, 111, 71, 0.03) 2px, transparent 2px),
            radial-gradient(circle at 80% 70%, rgba(139, 111, 71, 0.03) 2px, transparent 2px);
        background-size: 50px 50px;
        pointer-events: none;
    }

    .page-header h1 {
        font-weight: 800;
        animation: fadeInUp 0.8s ease-out 0.2s both;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        color: var(--dark-autumn);
        position: relative;
        z-index: 1;
    }

    .page-header p {
        animation: fadeInUp 0.8s ease-out 0.4s both;
        position: relative;
        z-index: 1;
    }
    
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05),
                    0 10px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        border-top: 4px solid var(--dusty-rose);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out backwards;
    }

    .form-card:nth-child(1) { animation-delay: 0.1s; }
    .form-card:nth-child(2) { animation-delay: 0.2s; }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 25% 40%, rgba(139, 111, 71, 0.02) 1px, transparent 1px),
            radial-gradient(circle at 75% 60%, rgba(139, 111, 71, 0.02) 1px, transparent 1px);
        background-size: 40px 40px, 50px 50px;
        pointer-events: none;
    }

    .form-card h4 {
        position: relative;
        z-index: 1;
        color: var(--autumn-primary);
        font-weight: 700;
    }
    
    .menu-item-card {
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        background: white;
    }

    .menu-item-card::before {
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
                transparent 15px,
                rgba(139, 111, 71, 0.01) 15px,
                rgba(139, 111, 71, 0.01) 30px
            );
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }
    
    .menu-item-card:hover {
        border-color: var(--pale-autumn);
        background: var(--warm-cream);
        transform: translateX(5px) scale(1.02);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    .menu-item-card:hover::before {
        opacity: 1;
    }
    
    .menu-item-card.selected {
        border-color: var(--autumn-primary);
        background: var(--warm-cream);
        border-width: 3px;
        box-shadow: 0 4px 15px rgba(139, 111, 71, 0.2);
    }

    .menu-item-card.selected::before {
        opacity: 1;
    }
    
    .menu-item-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid var(--beige);
        transition: all 0.3s ease;
    }

    .menu-item-card:hover .menu-item-image {
        transform: scale(1.1) rotate(3deg);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    
    .order-summary {
        background: linear-gradient(135deg, var(--warm-cream) 0%, #f5e7d0 100%);
        border-radius: 20px;
        padding: 25px;
        position: sticky;
        top: 20px;
        box-shadow: 0 4px 15px rgba(188, 82, 39, 0.15);
        border-top: 4px solid var(--autumn-primary);
        animation: slideInRight 0.6s ease-out 0.3s backwards;
        overflow: hidden;
    }

    .order-summary::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 30%, rgba(139, 111, 71, 0.03) 2px, transparent 2px),
            radial-gradient(circle at 70% 70%, rgba(107, 86, 53, 0.03) 1.5px, transparent 1.5px);
        background-size: 60px 60px, 50px 50px;
        pointer-events: none;
    }

    .order-summary h5 {
        position: relative;
        z-index: 1;
        font-weight: 700;
    }
    
    .summary-item {
        padding: 10px 0;
        border-bottom: 1px solid rgba(139, 111, 71, 0.2);
        position: relative;
        z-index: 1;
        animation: fadeIn 0.3s ease-out;
    }
    
    .summary-item:last-child {
        border-bottom: none;
    }
    
    .total-row {
        font-size: 1.4rem;
        font-weight: bold;
        color: var(--autumn-primary);
        margin-top: 15px;
        padding-top: 15px;
        border-top: 3px solid var(--autumn-primary);
        position: relative;
        z-index: 1;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.02); }
    }
    
    .quantity-input {
        width: 80px;
        text-align: center;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: white;
    }
    
    .quantity-input:focus {
        border-color: var(--autumn-primary);
        box-shadow: 0 0 0 0.2rem rgba(139, 111, 71, 0.25);
        outline: none;
        transform: scale(1.05);
    }

    .quantity-input:hover {
        border-color: var(--pale-autumn);
        background: var(--warm-cream);
    }
    
    .category-badge {
        background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }

    .category-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }

    .menu-item-card:hover .category-badge::before {
        left: 100%;
    }

    /* Animations */
    @keyframes slideInDown {
        from {
            transform: translateY(-30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideInRight {
        from {
            transform: translateX(30px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(5deg); }
    }
</style>
@endsection

@section('content')
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
                <h4 class="mb-3">
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
                        <h4 class="mb-3" style="color: var(--autumn-primary);">
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
                                                <strong style="color: var(--dark-autumn);">₱{{ number_format($item->price, 2) }}</strong>
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
                        <h4 class="mb-4" style="color: var(--autumn-primary);">
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

            // Enhanced interactivity - Ripple effects and animations
            const buttons = document.querySelectorAll('.btn-primary, .btn-secondary');
            buttons.forEach(button => {
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

            // Add ripple animation
            if (!document.getElementById('ripple-animation')) {
                const style = document.createElement('style');
                style.id = 'ripple-animation';
                style.textContent = `
                    @keyframes ripple {
                        to {
                            transform: scale(2);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(style);
            }

            // Scroll-triggered animations for menu items
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.animation = 'fadeInUp 0.5s ease-out forwards';
                            entry.target.style.opacity = '1';
                        }, index * 50);
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.menu-item-card').forEach(card => {
                card.style.opacity = '0';
                observer.observe(card);
            });

            // 3D tilt effect for menu item cards
            const menuCards = document.querySelectorAll('.menu-item-card');
            menuCards.forEach(card => {
                card.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = (y - centerY) / 20;
                    const rotateY = (centerX - x) / 20;
                    
                    this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateX(5px) scale(1.02)`;
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateX(0) scale(1)';
                });
            });
        });
    </script>
@endsection
