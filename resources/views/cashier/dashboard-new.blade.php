@extends('layouts.cashier')

@section('title', 'Cashier Dashboard')

@section('styles')
<style>
    .welcome-header {
        background: linear-gradient(135deg, var(--warm-cream) 0%, var(--light-beige) 100%);
        border: 3px dashed var(--beige);
        position: relative;
        overflow: hidden;
    }
    
    .welcome-header::before {
        content: '☕';
        position: absolute;
        font-size: 8rem;
        opacity: 0.1;
        right: 2rem;
        top: -1rem;
    }
    
    .welcome-header h1 {
        color: var(--dark-autumn);
    }
    
    .stat-card {
        border-top: 4px solid;
    }
    
    .stat-card.pending {
        border-top-color: #FFA726;
    }
    
    .stat-card.revenue {
        border-top-color: #66BB6A;
    }
    
    .stat-card.completed {
        border-top-color: #42A5F5;
    }
    
    .orders-card {
        background: white;
        border-radius: 20px;
        border: none;
        border-top: 8px solid var(--dusty-rose);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05),
                    0 10px 20px rgba(0, 0, 0, 0.05);
    }
    
    .orders-card .table thead {
        background: linear-gradient(135deg, var(--light-beige) 0%, var(--warm-cream) 100%);
    }
    
    .orders-card .table thead th {
        color: var(--pale-autumn);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem;
    }
    
    .orders-card .table tbody tr {
        transition: all 0.2s ease;
    }
    
    .orders-card .table tbody tr:hover {
        background: var(--warm-cream);
        transform: scale(1.005);
    }
    
    .badge-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .action-btn {
        border-radius: 8px;
        padding: 0.4rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
                        <h2 class="fw-bold mb-0" style="color: #FFA726;">{{ $stats['pending_count'] }}</h2>
                    </div>
                    <div class="stat-icon rounded-3 p-3" style="background: rgba(255, 167, 38, 0.1);">
                        <i class="bi bi-hourglass-split fs-3" style="color: #FFA726;"></i>
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
                        <h2 class="fw-bold mb-0 text-success">₱{{ number_format($stats['today_revenue'], 2) }}</h2>
                    </div>
                    <div class="stat-icon rounded-3 p-3" style="background: rgba(102, 187, 106, 0.1);">
                        <i class="bi bi-cash-stack fs-3 text-success"></i>
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
                        <h2 class="fw-bold mb-0 text-info">{{ $stats['today_completed'] }}</h2>
                    </div>
                    <div class="stat-icon rounded-3 p-3" style="background: rgba(66, 165, 245, 0.1);">
                        <i class="bi bi-check-circle-fill fs-3 text-info"></i>
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
                    <i class="bi bi-lightning-charge-fill text-warning"></i> Quick Action
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
                        <a href="{{ route('cashier.dashboard') }}" class="btn btn-outline-info w-100 py-3 action-btn">
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
