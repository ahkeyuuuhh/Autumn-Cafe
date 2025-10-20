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

    /* Coffee texture for header */
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
    }

    .page-header p {
        animation: fadeInUp 0.8s ease-out 0.4s both;
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

    /* Texture overlay for form cards */
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

    /* Subtle texture for menu items */
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

    /* Texture for order summary */
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
    
    .btn-primary {
        background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .btn-primary:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(139, 111, 71, 0.5);
    }

    .btn-primary:active {
        transform: translateY(-1px);
    }

    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--dark-autumn);
        margin-bottom: 8px;
    }
    
    .form-select, .form-control {
        border: 2px solid var(--beige);
        border-radius: 10px;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }
    
    .form-select:focus, .form-control:focus {
        border-color: var(--autumn-primary);
        box-shadow: 0 0 0 0.2rem rgba(139, 111, 71, 0.25);
        transform: translateY(-2px);
    }

    .form-select:hover, .form-control:hover {
        border-color: var(--pale-autumn);
        background: var(--warm-cream);
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
    <h1 class="mb-2" style="color: var(--dark-autumn); font-weight: 700;">
        <i class="bi bi-plus-circle-fill"></i> Create New Order
    </h1>
    <p class="lead mb-0" style="color: var(--pale-autumn);">Select items and create an order for a customer</p>
</div>

<form id="orderForm" action="{{ route('cashier.order.store') }}" method="POST">
    @csrf
    
    <div class="row">
        <div class="col-lg-8">
            <!-- Customer Selection -->
            <div class="form-card">
                <h4 class="mb-3" style="color: var(--autumn-primary);">
                    <i class="bi bi-person-circle"></i> Customer Information
                </h4>
                
                <div class="mb-3">
                    <label for="customer" class="form-label">Customer</label>
                    <select class="form-select" id="customer" name="customer_id">
                        <option value="">Walk-in Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->phone ?? $customer->email }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Menu Items Selection -->
            <div class="form-card">
                <h4 class="mb-3" style="color: var(--autumn-primary);">
                    <i class="bi bi-cup-hot"></i> Select Menu Items
                </h4>
                
                <div id="menuItems">
                    @foreach($menuItems as $item)
                        <div class="menu-item-card" onclick="toggleItem({{ $item->id }}, '{{ $item->name }}', {{ $item->price }})">
                            <div class="d-flex align-items-center">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="menu-item-image me-3">
                                @else
                                    <div class="menu-item-image me-3 d-flex align-items-center justify-content-center" style="background: var(--light-beige);">
                                        <i class="bi bi-cup-hot" style="color: var(--autumn-primary);"></i>
                                    </div>
                                @endif
                                
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold" style="color: var(--dark-autumn);">{{ $item->name }}</h6>
                                    <p class="mb-1 text-muted small">{{ $item->description }}</p>
                                    <span class="category-badge">{{ $item->category }}</span>
                                </div>
                                
                                <div class="text-end">
                                    <div class="fw-bold" style="color: var(--autumn-primary); font-size: 1.2rem;">₱{{ number_format($item->price, 2) }}</div>
                                    <input type="number" 
                                           class="quantity-input mt-2" 
                                           id="qty-{{ $item->id }}" 
                                           min="0" 
                                           max="99" 
                                           value="0"
                                           onclick="event.stopPropagation()"
                                           onchange="updateQuantity({{ $item->id }}, '{{ $item->name }}', {{ $item->price }})">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="order-summary">
                <h5 class="fw-bold mb-4" style="color: var(--dark-autumn);">
                    <i class="bi bi-cart-check"></i> Order Summary
                </h5>
                
                <div id="summaryItems">
                    <p class="text-muted text-center py-4">No items selected</p>
                </div>
                
                <div class="total-row">
                    <div class="d-flex justify-content-between">
                        <span>Total:</span>
                        <span id="totalAmount">₱0.00</span>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 mt-4 py-3" id="submitBtn" disabled>
                    <i class="bi bi-check-circle me-2"></i>
                    Place Order
                </button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    let selectedItems = {};
    
    function toggleItem(id, name, price) {
        const qtyInput = document.getElementById('qty-' + id);
        if (qtyInput.value == 0) {
            qtyInput.value = 1;
        }
        updateQuantity(id, name, price);
    }
    
    function updateQuantity(id, name, price) {
        const qty = parseInt(document.getElementById('qty-' + id).value) || 0;
        const card = document.getElementById('qty-' + id).closest('.menu-item-card');
        
        if (qty > 0) {
            selectedItems[id] = { name, price, qty };
            card.classList.add('selected');
        } else {
            delete selectedItems[id];
            card.classList.remove('selected');
        }
        
        updateSummary();
    }
    
    function updateSummary() {
        const summaryDiv = document.getElementById('summaryItems');
        const submitBtn = document.getElementById('submitBtn');
        let total = 0;
        let html = '';
        
        if (Object.keys(selectedItems).length === 0) {
            html = '<p class="text-muted text-center py-4">No items selected</p>';
            submitBtn.disabled = true;
        } else {
            for (const [id, item] of Object.entries(selectedItems)) {
                const subtotal = item.price * item.qty;
                total += subtotal;
                html += `
                    <div class="summary-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>${item.name}</strong><br>
                                <small class="text-muted">₱${item.price.toFixed(2)} × ${item.qty}</small>
                            </div>
                            <div class="fw-bold">₱${subtotal.toFixed(2)}</div>
                        </div>
                        <input type="hidden" name="items[${id}][id]" value="${id}">
                        <input type="hidden" name="items[${id}][quantity]" value="${item.qty}">
                        <input type="hidden" name="items[${id}][price]" value="${item.price}">
                    </div>
                `;
            }
            submitBtn.disabled = false;
        }
        
        summaryDiv.innerHTML = html;
        document.getElementById('totalAmount').textContent = '₱' + total.toFixed(2);
    }
    
    // Form validation
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        if (Object.keys(selectedItems).length === 0) {
            e.preventDefault();
            alert('Please select at least one item');
        }
    });

    // Enhanced interactivity on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Ripple effect on buttons
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

        // Add ripple animation keyframe
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

        // Interactive form inputs - focus effects
        const formInputs = document.querySelectorAll('.form-select, .form-control, .quantity-input');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateX(5px)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateX(0)';
            });
        });

        // Menu item card 3D tilt effect
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

        // Summary total pulse animation when items are added
        const originalUpdateSummary = updateSummary;
        updateSummary = function() {
            originalUpdateSummary();
            const totalRow = document.querySelector('.total-row');
            if (totalRow && Object.keys(selectedItems).length > 0) {
                totalRow.style.animation = 'none';
                setTimeout(() => {
                    totalRow.style.animation = 'pulse 2s ease-in-out infinite';
                }, 10);
            }
        };
    });
</script>
@endsection
