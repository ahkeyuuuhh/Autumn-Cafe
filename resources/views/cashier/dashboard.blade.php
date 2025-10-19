<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Dashboard - Autumn Café</title>
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
            --autumn-secondary: #6b5635;
            --autumn-accent: #b8a08a;
            --autumn-light: #d4c4b5;
            --autumn-dark: #352b1d;
        }
        
        body {
            background-color: #faf8f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .bg-autumn {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
        }
        
        .stats-card {
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .stats-card.pending {
            background: linear-gradient(135deg, #b8a08a 0%, #8b6f47 100%);
            color: white;
        }
        
        .stats-card.revenue {
            background: linear-gradient(135deg, #66BB6A 0%, #43A047 100%);
            color: white;
        }
        
        .stats-card.completed {
            background: linear-gradient(135deg, #42A5F5 0%, #1E88E5 100%);
            color: white;
        }
        
        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
        }
        
        .stats-card i {
            opacity: 0.9;
        }
        
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        
        .table-container h4 {
            color: var(--autumn-secondary);
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid var(--autumn-light);
        }
        
        .table thead th {
            color: var(--autumn-dark);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 12px 15px;
        }
        
        .table tbody tr {
            border-bottom: 1px solid #f1f1f1;
            transition: background-color 0.2s ease;
        }
        
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }
        
        .badge-status {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(210, 105, 30, 0.4);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #43A047 0%, #2E7D32 100%);
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 160, 71, 0.4);
        }
        
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            border-bottom: none;
            border-radius: 15px 15px 0 0;
            padding: 20px 25px;
        }
        
        .modal-body {
            padding: 25px;
        }
        
        .modal-footer {
            border-top: none;
            padding: 20px 25px;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>
<body>
    @include('components.cashier-nav')

    <div class="container-fluid py-4">
        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-4">
                <div class="stats-card pending">
                    <i class="bi bi-hourglass-split" style="font-size: 2rem;"></i>
                    <h3>{{ $stats['pending_count'] }}</h3>
                    <p class="mb-0">Pending Orders</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card revenue">
                    <i class="bi bi-cash-stack" style="font-size: 2rem;"></i>
                    <h3>₱{{ number_format($stats['today_revenue'], 2) }}</h3>
                    <p class="mb-0">Today's Revenue</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card completed">
                    <i class="bi bi-check-circle-fill" style="font-size: 2rem;"></i>
                    <h3>{{ $stats['today_completed'] }}</h3>
                    <p class="mb-0">Completed Today</p>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="table-container">
            <h4 class="mb-3">
                <i class="bi bi-clock-history me-2"></i>Pending Orders
                <span class="badge bg-warning text-dark ms-2">{{ $pendingOrders->count() }}</span>
            </h4>
            @if($pendingOrders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Ordered At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingOrders as $order)
                                <tr style="cursor: pointer;" onclick="showOrderDetails({{ $order->id }})">
                                    <td><strong>#{{ $order->id }}</strong></td>
                                    <td>{{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}</td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $order->items->count() }} item(s)
                                        </small>
                                    </td>
                                    <td><strong class="text-success">₱{{ number_format($order->total_amount, 2) }}</strong></td>
                                    <td>
                                        <small>{{ $order->ordered_at->format('M d, Y') }}</small><br>
                                        <small class="text-muted">{{ $order->ordered_at->format('h:i A') }}</small>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" 
                                                onclick="event.stopPropagation(); showStatusModal({{ $order->id }}, '{{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}')">
                                            <i class="bi bi-pencil-square me-1"></i>Update
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>No pending orders at the moment.
                </div>
            @endif
        </div>

        <!-- Recent Transactions -->
        <div class="table-container">
            <h4 class="mb-3">
                <i class="bi bi-receipt me-2"></i>Recent Transactions
            </h4>
            @if($recentTransactions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $transaction)
                                <tr>
                                    <td><strong>#{{ $transaction->id }}</strong></td>
                                    <td>{{ $transaction->customer ? $transaction->customer->name : 'Walk-in Customer' }}</td>
                                    <td><strong>₱{{ number_format($transaction->total_amount, 2) }}</strong></td>
                                    <td>
                                        @if($transaction->status == 'completed')
                                            <span class="badge badge-status bg-success">Completed</span>
                                        @elseif($transaction->status == 'cancelled')
                                            <span class="badge badge-status bg-danger">Cancelled</span>
                                        @else
                                            <span class="badge badge-status bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $transaction->ordered_at->format('M d, Y h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>No recent transactions.
                </div>
            @endif
        </div>
    </div>

    <!-- Update Status Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="statusForm" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
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
                <div class="modal-header bg-autumn text-white">
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
    </script>
    <script>
        // Store current order ID for status update
        let currentOrderId = null;
        let currentCustomerName = null;

        // Show order details modal
        function showOrderDetails(orderId) {
            // Find the order data from the pending orders
            const orderData = @json($pendingOrders);
            const order = orderData.find(o => o.id === orderId);
            
            if (!order) return;
            
            // Store for later use
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
            // Close order details modal
            const orderModal = bootstrap.Modal.getInstance(document.getElementById('orderDetailsModal'));
            if (orderModal) {
                orderModal.hide();
            }
            
            // Show status modal after a brief delay
            setTimeout(() => {
                showStatusModal(currentOrderId, currentCustomerName);
            }, 300);
        }

        function showStatusModal(orderId, customerName) {
            currentOrderId = orderId;
            currentCustomerName = customerName;
            document.getElementById('customerName').textContent = customerName;
            document.getElementById('statusForm').action = `/cashier/order/${orderId}/status`;
            const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
            statusModal.show();
        }

        @if(session('success'))
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif

        // Clean up modal backdrops
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function () {
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        });

        // Auto-refresh every 10 seconds for smooth user experience
        let autoRefreshTimer;
        function startAutoRefresh() {
            autoRefreshTimer = setTimeout(function() {
                // Only refresh if no modal is open
                if (!document.querySelector('.modal.show')) {
                    window.location.reload();
                } else {
                    // Try again in 5 seconds if modal is open
                    clearTimeout(autoRefreshTimer);
                    autoRefreshTimer = setTimeout(function() {
                        if (!document.querySelector('.modal.show')) {
                            window.location.reload();
                        } else {
                            startAutoRefresh();
                        }
                    }, 5000);
                }
            }, 10000); // 10 seconds
        }
        
        startAutoRefresh();
    </script>
</body>
</html>
