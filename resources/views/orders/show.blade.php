<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Autumn Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --autumn-orange: #E67E22;
            --autumn-cream: #FFF9F3;
            --autumn-brown: #3B2F2F;
            --autumn-light-orange: #F39C12;
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
        
        .order-header {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(230, 126, 34, 0.3);
            margin-bottom: 30px;
        }
        
        .order-info-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .info-label {
            color: var(--autumn-brown);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }
        
        .items-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .items-table thead {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
        }
        
        .items-table th {
            padding: 15px;
            font-weight: 600;
            border: none;
        }
        
        .items-table td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .items-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .items-table tbody tr:hover {
            background-color: var(--autumn-cream);
        }
        
        .total-row {
            background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%);
            font-weight: bold;
            font-size: 1.2rem;
            color: var(--autumn-brown);
        }
        
        .status-badge {
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
        }
        
        .status-pending {
            background: #FFF3CD;
            color: #856404;
        }
        
        .status-paid {
            background: #D1ECF1;
            color: #0C5460;
        }
        
        .status-completed {
            background: #D4EDDA;
            color: #155724;
        }
        
        .status-cancelled {
            background: #F8D7DA;
            color: #721C24;
        }
        
        .action-buttons .btn {
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
            margin: 5px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            border: none;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 126, 34, 0.4);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #27AE60 0%, #229954 100%);
            border: none;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #E74C3C 0%, #C0392B 100%);
            border: none;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
        }
        
        .btn-secondary {
            background: #6C757D;
            border: none;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }
        
        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .autumn-decoration {
            position: fixed;
            opacity: 0.1;
            pointer-events: none;
            z-index: 0;
        }
        
        .leaf-1 {
            top: 100px;
            left: 50px;
            font-size: 80px;
            color: var(--autumn-orange);
            transform: rotate(20deg);
        }
        
        .leaf-2 {
            bottom: 100px;
            right: 50px;
            font-size: 100px;
            color: var(--autumn-light-orange);
            transform: rotate(-30deg);
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                background: white;
            }
            
            .order-header,
            .order-info-card,
            .items-table {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <!-- Autumn Decorations -->
    <div class="autumn-decoration leaf-1">🍂</div>
    <div class="autumn-decoration leaf-2">🍁</div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4 no-print">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-cup-hot-fill"></i> Autumn Café
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu.index') }}">
                            <i class="bi bi-cup-straw"></i> Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('orders.index') }}">
                            <i class="bi bi-cart-check"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transactions.index') }}">
                            <i class="bi bi-receipt"></i> Transactions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customers.index') }}">
                            <i class="bi bi-people"></i> Customers
                        </a>
                    </li>
                </ul>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container" style="position: relative; z-index: 1;">
        <!-- Order Header -->
        <div class="order-header">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h1 class="mb-2">
                        <i class="bi bi-receipt-cutoff"></i> Order #{{ $order->id }}
                    </h1>
                    <p class="mb-0 opacity-75">
                        <i class="bi bi-calendar-event"></i> 
                        {{ $order->ordered_at->format('F d, Y \a\t h:i A') }}
                    </p>
                </div>
                <div>
                    <span class="status-badge status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show no-print" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Customer Information -->
            <div class="col-md-6">
                <div class="order-info-card">
                    <h4 class="mb-4" style="color: var(--autumn-orange);">
                        <i class="bi bi-person-circle"></i> Customer Information
                    </h4>
                    
                    @if($order->customer)
                        <div>
                            <div class="info-label">Customer Name</div>
                            <div class="info-value">
                                <i class="bi bi-person-fill text-muted"></i>
                                {{ $order->customer->name }}
                            </div>
                        </div>
                        
                        @if($order->customer->phone)
                            <div>
                                <div class="info-label">Phone Number</div>
                                <div class="info-value">
                                    <i class="bi bi-telephone-fill text-muted"></i>
                                    {{ $order->customer->phone }}
                                </div>
                            </div>
                        @endif
                        
                        @if($order->customer->email)
                            <div>
                                <div class="info-label">Email Address</div>
                                <div class="info-value">
                                    <i class="bi bi-envelope-fill text-muted"></i>
                                    {{ $order->customer->email }}
                                </div>
                            </div>
                        @endif
                    @else
                        <p class="text-muted">
                            <i class="bi bi-person-dash"></i> Walk-in Customer
                        </p>
                    @endif
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-6">
                <div class="order-info-card">
                    <h4 class="mb-4" style="color: var(--autumn-orange);">
                        <i class="bi bi-info-circle"></i> Order Summary
                    </h4>
                    
                    <div>
                        <div class="info-label">Order Date & Time</div>
                        <div class="info-value">
                            <i class="bi bi-clock-fill text-muted"></i>
                            {{ $order->ordered_at->format('l, F d, Y') }}<br>
                            <small class="ms-4">{{ $order->ordered_at->format('h:i:s A') }}</small>
                        </div>
                    </div>
                    
                    <div>
                        <div class="info-label">Total Items</div>
                        <div class="info-value">
                            <i class="bi bi-basket-fill text-muted"></i>
                            {{ $order->items->sum('quantity') }} item(s)
                        </div>
                    </div>
                    
                    <div>
                        <div class="info-label">Total Cost</div>
                        <div class="info-value" style="font-size: 1.5rem; color: var(--autumn-orange); font-weight: bold;">
                            <i class="bi bi-currency-dollar"></i>
                            ₱{{ number_format($order->total_amount, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mt-4">
            <h4 class="mb-3" style="color: var(--autumn-brown);">
                <i class="bi bi-cart3"></i> Items Ordered
            </h4>
            
            <div class="items-table">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price per Item</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->menuItem && $item->menuItem->image)
                                            <img src="{{ $item->menuItem->image_url }}" 
                                                 alt="{{ $item->menuItem->name }}" 
                                                 class="item-image me-3">
                                        @else
                                            <div class="item-image me-3 d-flex align-items-center justify-content-center bg-light">
                                                <i class="bi bi-cup-straw text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <strong>{{ $item->menuItem->name ?? 'Item Deleted' }}</strong>
                                            @if($item->menuItem)
                                                <br><small class="text-muted">{{ $item->menuItem->category }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>₱{{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $item->quantity }}</span>
                                </td>
                                <td class="text-end">
                                    <strong>₱{{ number_format($item->subtotal, 2) }}</strong>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="3" class="text-end">
                                <i class="bi bi-calculator"></i> <strong>TOTAL COST:</strong>
                            </td>
                            <td class="text-end">
                                <strong style="font-size: 1.3rem; color: var(--autumn-orange);">
                                    ₱{{ number_format($order->total_amount, 2) }}
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons text-center mt-4 no-print">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Orders
            </a>
            
            @if($order->status !== 'cancelled')
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#statusModal">
                    <i class="bi bi-pencil-square"></i> Update Status
                </button>
            @endif
            
            <button onclick="window.print()" class="btn btn-primary">
                <i class="bi bi-printer"></i> Print Order
            </button>
            
            @if($order->status === 'pending')
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="bi bi-trash"></i> Cancel Order
                </button>
            @endif
        </div>
    </div>

    <!-- Status Update Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%); color: white;">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square"></i> Update Order Status
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Current Status</label>
                            <p class="mb-3">
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            
                            <label for="status" class="form-label fw-bold">New Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle"></i> Cancel Order
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to cancel Order #{{ $order->id }}? This will restore the stock for all items in this order.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep Order</button>
                    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Yes, Cancel Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
