@extends('layouts.cashier')

@section('title', 'Cashier Dashboard')

@section('styles')
<style>
    .welcome-header {
        background: linear-gradient(135deg, var(--warm-cream) 0%, var(--light-beige) 100%);
        border: 3px dashed var(--beige);
        position: relative;
        overflow: hidden;
        padding: 50px;
        animation: slideInDown 0.6s ease-out;
    }
    
    .welcome-header::before {
        content: '\F284';
        font-family: 'bootstrap-icons';
        position: absolute;
        font-size: 8rem;
        opacity: 0.1;
        right: 2rem;
        top: -1rem;
        animation: float 6s ease-in-out infinite;
    }

    /* Coffee bean texture overlay for header */
    .welcome-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 25% 25%, rgba(139, 111, 71, 0.03) 2px, transparent 2px),
            radial-gradient(circle at 75% 75%, rgba(139, 111, 71, 0.03) 2px, transparent 2px);
        background-size: 50px 50px;
        pointer-events: none;
    }
    
    .welcome-header h1 {
        color: var(--dark-autumn);
        font-weight: 800;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .welcome-header p {
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }
    
    .stat-card {
        border-top: 4px solid;
        position: relative;
        overflow: hidden;
        animation: scaleIn 0.5s ease-out backwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }

    /* Texture overlay for stat cards */
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 30px 30px, 40px 40px;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover::before {
        opacity: 1;
    }
    
    .stat-card.pending {
        border-top-color: var(--autumn-primary);
        background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%);
    }
    
    .stat-card.revenue {
        border-top-color: var(--dark-autumn);
        background: linear-gradient(135deg, #E8DDD2 0%, #D4C4B5 100%);
    }
    
    .stat-card.completed {
        border-top-color: var(--pale-autumn);
        background: linear-gradient(135deg, #F5F0EB 0%, #E8DDD2 100%);
    }

    .stat-card h2 {
        transition: transform 0.3s ease;
    }

    .stat-card:hover h2 {
        transform: scale(1.1);
    }
    
    .orders-card {
        background: white;
        border-radius: 20px;
        border: none;
        border-top: 8px solid var(--dusty-rose);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05),
                    0 10px 20px rgba(0, 0, 0, 0.05);
        position: relative;
        animation: fadeInUp 0.6s ease-out 0.5s backwards;
    }

    /* Texture overlay for orders card */
    .orders-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 15% 30%, rgba(139, 111, 71, 0.02) 2px, transparent 2px),
            radial-gradient(circle at 85% 70%, rgba(139, 111, 71, 0.02) 2px, transparent 2px);
        background-size: 60px 60px, 70px 70px;
        pointer-events: none;
        border-radius: 20px;
    }
    
    .orders-card .table thead {
        background: linear-gradient(135deg, var(--light-beige) 0%, var(--warm-cream) 100%);
        position: relative;
    }

    /* Texture for table header */
    .orders-card .table thead::before {
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
                rgba(139, 111, 71, 0.02) 10px,
                rgba(139, 111, 71, 0.02) 20px
            );
        pointer-events: none;
    }
    
    .orders-card .table thead th {
        color: var(--pale-autumn);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem;
        position: relative;
    }
    
    .orders-card .table tbody tr {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .orders-card .table tbody tr:hover {
        background: linear-gradient(90deg, var(--warm-cream) 0%, transparent 100%);
        transform: translateX(5px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .badge-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }

    .badge-status::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }

    .badge-status:hover::before {
        left: 100%;
    }
    
    .action-btn {
        border-radius: 10px;
        padding: 0.5rem 1.2rem;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .action-btn::before {
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

    .action-btn:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    .action-btn:active {
        transform: translateY(-1px);
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

    @keyframes scaleIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(5deg); }
    }

    /* Quick action card texture */
    .card {
        position: relative;
    }

    .card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(139, 111, 71, 0.01) 1px, transparent 1px),
            radial-gradient(circle at 80% 70%, rgba(139, 111, 71, 0.01) 1px, transparent 1px);
        background-size: 50px 50px, 60px 60px;
        pointer-events: none;
        border-radius: 20px;
    }
</style>
@endsection

@section('content')
<!-- HEADER -->
<div class="welcome-header text-center mb-5 py-5 rounded-4 shadow-sm">
    <h1 class="display-5 fw-bold mb-2">
        <i class="bi bi-cash-register"></i> Cashier Dashboard
    </h1>
    <p class="lead text-muted mb-0">Process orders and manage transactions efficiently</p>
    <small class="text-muted">{{ now()->format('l, F j, Y - g:i A') }}</small>
</div>

<!-- STATISTICS -->
<div class="row g-4 mb-4">
    <!-- Pending Orders -->
    <div class="col-lg-4 col-md-6">
        <div class="stat-card card border-0 shadow-sm h-100 hover-card pending">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Pending Orders</p>
                        <h2 class="fw-bold mb-0" style="color: var(--autumn-primary);">{{ $stats['pending_count'] }}</h2>
                    </div>
                    <div class="stat-icon rounded-3 p-3" style="background: rgba(139, 111, 71, 0.1);">
                        <i class="bi bi-hourglass-split fs-3" style="color: var(--autumn-primary);"></i>
                    </div>
                </div>
                <small class="text-muted">
                    <i class="bi bi-clock-history"></i> Awaiting processing
                </small>
            </div>
        </div>
    </div>

    <!-- Today's Revenue -->
    <div class="col-lg-4 col-md-6">
        <div class="stat-card card border-0 shadow-sm h-100 hover-card revenue">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Today's Revenue</p>
                        <h2 class="fw-bold mb-0" style="color: var(--dark-autumn);">₱{{ number_format($stats['today_revenue'], 2) }}</h2>
                    </div>
                    <div class="stat-icon rounded-3 p-3" style="background: rgba(107, 86, 53, 0.1);">
                        <i class="bi bi-cash-stack fs-3" style="color: var(--dark-autumn);"></i>
                    </div>
                </div>
                <small class="text-muted">
                    <i class="bi bi-graph-up-arrow"></i> Revenue today
                </small>
            </div>
        </div>
    </div>

    <!-- Completed Today -->
    <div class="col-lg-4 col-md-6">
        <div class="stat-card card border-0 shadow-sm h-100 hover-card completed">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Completed Today</p>
                        <h2 class="fw-bold mb-0" style="color: var(--pale-autumn);">{{ $stats['today_completed'] }}</h2>
                    </div>
                    <div class="stat-icon rounded-3 p-3" style="background: rgba(184, 160, 138, 0.1);">
                        <i class="bi bi-check-circle-fill fs-3" style="color: var(--pale-autumn);"></i>
                    </div>
                </div>
                <small class="text-muted">
                    <i class="bi bi-clipboard-check"></i> Orders completed
                </small>
            </div>
        </div>
    </div>
</div>

<!-- QUICK ACTION -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title fw-bold mb-4">
                    <i class="bi bi-lightning-charge-fill" style="color: var(--autumn-primary);"></i> Quick Action
                </h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ route('cashier.order.create') }}" class="btn btn-outline-primary w-100 py-3 action-btn">
                            <i class="bi bi-plus-circle fs-4 d-block mb-2"></i>
                            <span class="fw-semibold">Create New Order</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <button onclick="window.location.reload()" class="btn btn-outline-secondary w-100 py-3 action-btn">
                            <i class="bi bi-arrow-clockwise fs-4 d-block mb-2"></i>
                            <span class="fw-semibold">Refresh Orders</span>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('cashier.dashboard') }}" class="btn btn-outline-secondary w-100 py-3 action-btn">
                            <i class="bi bi-receipt fs-4 d-block mb-2"></i>
                            <span class="fw-semibold">View All Orders</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PENDING ORDERS TABLE -->
<div class="row g-4">
    <div class="col-12">
        <div class="orders-card card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title fw-bold mb-0">
                        <i class="bi bi-list-ul text-primary"></i> Pending Orders
                    </h5>
                    <span class="badge bg-warning">{{ count($pendingOrders) }} orders</span>
                </div>

                @if(count($pendingOrders) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Total Amount</th>
                                    <th>Order Time</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingOrders as $order)
                                <tr>
                                    <td>
                                        <span class="fw-bold text-primary">#{{ $order->id }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2" style="width: 35px; height: 35px; background: linear-gradient(135deg, var(--pale-autumn), var(--autumn-primary)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                {{ substr($order->customer->name ?? 'W', 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $order->customer->name ?? 'Walk-in Customer' }}</div>
                                                @if($order->customer)
                                                    <small class="text-muted">{{ $order->customer->phone ?? $order->customer->email }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $order->items->count() }} items</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">₱{{ number_format($order->total_amount, 2) }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="bi bi-clock"></i> 
                                            {{ \Carbon\Carbon::parse($order->ordered_at)->format('M d, Y') }}<br>
                                            {{ \Carbon\Carbon::parse($order->ordered_at)->format('g:i A') }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge-status bg-warning text-dark">
                                            <i class="bi bi-hourglass-split"></i> Pending
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <button onclick="showOrderDetails({{ $order->id }})" 
                                                    class="btn btn-outline-primary btn-sm"
                                                    title="View Details">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button onclick="showStatusModal({{ $order->id }}, '{{ $order->customer->name ?? 'Walk-in Customer' }}')" 
                                                    class="btn btn-outline-success btn-sm"
                                                    title="Update Status">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-3 mb-0">No pending orders at the moment</p>
                        <a href="{{ route('cashier.order.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Create New Order
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="statusForm" method="POST">
                @csrf
                <div class="modal-header" style="background: linear-gradient(135deg, var(--pale-autumn), var(--autumn-primary)); color: white;">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square me-2"></i>Update Order Status
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Order for: <strong id="customerName"></strong></p>
                    <div class="mb-3">
                        <label for="status" class="form-label">Select New Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">-- Choose Status --</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Note:</strong> This action cannot be undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--green-brown), var(--dark-brown)); color: white;">
                <h5 class="modal-title">
                    <i class="bi bi-receipt me-2"></i>Order Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Order #:</strong> <span id="modalOrderId"></span></p>
                        <p class="mb-1"><strong>Customer:</strong> <span id="modalCustomerName"></span></p>
                        <p class="mb-1"><strong>Contact:</strong> <span id="modalCustomerContact"></span></p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-1"><strong>Status:</strong> <span id="modalOrderStatus" class="badge bg-warning"></span></p>
                        <p class="mb-1"><strong>Ordered At:</strong> <span id="modalOrderDate"></span></p>
                    </div>
                </div>

                <hr>

                <h6 class="mb-3"><i class="bi bi-basket me-2"></i>Order Items</h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="modalOrderItems">
                            <!-- Items will be loaded here -->
                        </tbody>
                        <tfoot>
                            <tr class="table-active">
                                <th colspan="3" class="text-end">Total Amount:</th>
                                <th class="text-end text-success" id="modalTotalAmount"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="showStatusModalFromDetails()">
                    <i class="bi bi-pencil-square me-1"></i>Update Status
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentOrderId = null;
    let currentCustomerName = null;

    // Show order details modal
    function showOrderDetails(orderId) {
        const orderData = @json($pendingOrders);
        const order = orderData.find(o => o.id === orderId);
        
        if (!order) return;
        
        currentOrderId = orderId;
        currentCustomerName = order.customer ? order.customer.name : 'Walk-in Customer';
        
        // Populate modal
        document.getElementById('modalOrderId').textContent = '#' + order.id;
        document.getElementById('modalCustomerName').textContent = currentCustomerName;
        
        // Customer contact
        const contact = order.customer ? (order.customer.phone || order.customer.email || 'N/A') : 'N/A';
        document.getElementById('modalCustomerContact').textContent = contact;
        
        // Status badge
        const statusBadge = document.getElementById('modalOrderStatus');
        statusBadge.textContent = 'Pending';
        statusBadge.className = 'badge bg-warning';
        
        // Format date
        const orderDate = new Date(order.ordered_at);
        document.getElementById('modalOrderDate').textContent = orderDate.toLocaleString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });
        
        // Populate items table
        const itemsContainer = document.getElementById('modalOrderItems');
        itemsContainer.innerHTML = '';
        
        order.items.forEach(item => {
            const subtotal = item.quantity * item.price;
            const row = `
                <tr>
                    <td>${item.menu_item.name}</td>
                    <td class="text-center">${item.quantity}</td>
                    <td class="text-end">₱${parseFloat(item.price).toFixed(2)}</td>
                    <td class="text-end">₱${subtotal.toFixed(2)}</td>
                </tr>
            `;
            itemsContainer.innerHTML += row;
        });
        
        // Total amount
        document.getElementById('modalTotalAmount').textContent = '₱' + parseFloat(order.total_amount).toFixed(2);
        
        // Show modal
        const orderModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
        orderModal.show();
    }

    // Show status modal from order details modal
    function showStatusModalFromDetails() {
        const orderModal = bootstrap.Modal.getInstance(document.getElementById('orderDetailsModal'));
        if (orderModal) {
            orderModal.hide();
        }
        
        setTimeout(() => {
            showStatusModal(currentOrderId, currentCustomerName);
        }, 300);
    }

    // Show status modal
    function showStatusModal(orderId, customerName) {
        currentOrderId = orderId;
        currentCustomerName = customerName;
        document.getElementById('customerName').textContent = customerName;
        document.getElementById('statusForm').action = `/cashier/order/${orderId}/status`;
        const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
        statusModal.show();
    }

    // Interactive elements - Ripple effect on buttons
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.action-btn, .btn-primary, .btn-secondary, .btn-outline-primary, .btn-outline-secondary, .btn-outline-info');
        
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
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple animation style
        if (!document.getElementById('ripple-style')) {
            const style = document.createElement('style');
            style.id = 'ripple-style';
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

        // Scroll-triggered animations for table rows
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.animation = 'fadeInUp 0.5s ease-out forwards';
                    }, index * 50);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.orders-card tbody tr').forEach(row => {
            row.style.opacity = '0';
            observer.observe(row);
        });

        // Interactive stat cards - tilt effect
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;
                
                this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
            });
        });
    });

    // Auto-refresh functionality
    let autoRefreshTimer;
    
    function startAutoRefresh() {
        autoRefreshTimer = setTimeout(function() {
            if (!document.querySelector('.modal.show')) {
                window.location.reload();
            } else {
                clearTimeout(autoRefreshTimer);
                autoRefreshTimer = setTimeout(function() {
                    if (!document.querySelector('.modal.show')) {
                        window.location.reload();
                    } else {
                        startAutoRefresh();
                    }
                }, 5000);
            }
        }, 10000);
    }
    
    startAutoRefresh();
</script>
@endsection
