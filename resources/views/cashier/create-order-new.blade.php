@extends('layouts.cashier')

@section('title', 'Create New Order')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--warm-cream) 0%, var(--light-beige) 100%);
        border: 3px dashed var(--beige);
        position: relative;
        overflow: hidden;
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
    }
    
    .page-header::before {
        content: '🛒';
        position: absolute;
        font-size: 6rem;
        opacity: 0.1;
        right: 2rem;
        top: -1rem;
    }
    
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05),
                    0 10px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        border-top: 4px solid var(--dusty-rose);
    }
    
    .menu-item-card {
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .menu-item-card:hover {
        border-color: var(--pale-autumn);
        background: var(--warm-cream);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .menu-item-card.selected {
        border-color: var(--autumn-primary);
        background: var(--warm-cream);
        border-width: 3px;
    }
    
    .menu-item-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid var(--beige);
    }
    
    .order-summary {
        background: linear-gradient(135deg, var(--warm-cream) 0%, #f5e7d0 100%);
        border-radius: 20px;
        padding: 25px;
        position: sticky;
        top: 20px;
        box-shadow: 0 4px 15px rgba(188, 82, 39, 0.15);
        border-top: 4px solid var(--autumn-primary);
    }
    
    .summary-item {
        padding: 10px 0;
        border-bottom: 1px solid #d0d0d0;
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
    }
    
    .quantity-input {
        width: 80px;
        text-align: center;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-weight: 600;
    }
    
    .quantity-input:focus {
        border-color: var(--autumn-primary);
        box-shadow: 0 0 0 0.2rem rgba(188, 82, 39, 0.25);
        outline: none;
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
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(188, 82, 39, 0.4);
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
    }
    
    .form-select:focus, .form-control:focus {
        border-color: var(--autumn-primary);
        box-shadow: 0 0 0 0.2rem rgba(188, 82, 39, 0.25);
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
</script>
@endsection
