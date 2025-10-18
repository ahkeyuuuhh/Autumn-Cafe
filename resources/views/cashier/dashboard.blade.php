<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Dashboard - Autumn Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .stats-card {
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .stats-card.pending {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        .stats-card.revenue {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        .stats-card.completed {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }
        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .badge-status {
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('cashier.dashboard') }}">
                <i class="bi bi-cup-hot-fill me-2"></i>Autumn Café - Cashier
            </a>
            <div class="ms-auto d-flex align-items-center gap-2">
                <a href="{{ route('cashier.order.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>Create New Order
                </a>
                <span class="text-white me-2">
                    <i class="bi bi-person-circle me-2"></i>{{ session('cashier_name') }}
                </span>
                <form action="{{ route('cashier.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

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
                                <tr>
                                    <td><strong>#{{ $order->id }}</strong></td>
                                    <td>{{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}</td>
                                    <td>
                                        <small>
                                            @foreach($order->items as $item)
                                                {{ $item->quantity }}x {{ $item->menuItem->name }}<br>
                                            @endforeach
                                        </small>
                                    </td>
                                    <td><strong>₱{{ number_format($order->total_amount, 2) }}</strong></td>
                                    <td>{{ $order->ordered_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" 
                                                onclick="showStatusModal({{ $order->id }}, '{{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}')">
                                            <i class="bi bi-pencil-square me-1"></i>Update Status
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

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-check-circle me-2"></i>Success</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showStatusModal(orderId, customerName) {
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
