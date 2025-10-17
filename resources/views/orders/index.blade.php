<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Autumn Café</title>
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
        
        .page-header {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(230, 126, 34, 0.3);
            margin-bottom: 30px;
        }
        
        .orders-table {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .orders-table thead {
            background: linear-gradient(135deg, var(--autumn-brown) 0%, #2C1810 100%);
            color: white;
        }
        
        .orders-table th {
            padding: 15px;
            font-weight: 600;
            border: none;
        }
        
        .orders-table td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .orders-table tbody tr:hover {
            background-color: var(--autumn-cream);
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
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
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 126, 34, 0.4);
        }
        
        .btn-sm {
            padding: 5px 15px;
            border-radius: 20px;
        }
        
        .pagination {
            margin-top: 20px;
        }
        
        .page-link {
            color: var(--autumn-orange);
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin: 0 3px;
        }
        
        .page-link:hover {
            background-color: var(--autumn-cream);
            color: var(--autumn-brown);
        }
        
        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            border-color: var(--autumn-orange);
        }
        
        .autumn-decoration {
            position: fixed;
            opacity: 0.08;
            pointer-events: none;
            z-index: 0;
        }
        
        .leaf-1 {
            top: 100px;
            left: 50px;
            font-size: 100px;
            color: var(--autumn-orange);
            transform: rotate(25deg);
        }
        
        .leaf-2 {
            bottom: 100px;
            right: 50px;
            font-size: 120px;
            color: var(--autumn-light-orange);
            transform: rotate(-20deg);
        }
    </style>
</head>
<body>
    <!-- Autumn Decorations -->
    <div class="autumn-decoration leaf-1">🍂</div>
    <div class="autumn-decoration leaf-2">🍁</div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
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
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">
                        <i class="bi bi-cart-check-fill"></i> Order Management
                    </h1>
                    <p class="mb-0 opacity-75">View and manage all orders</p>
                </div>
                <a href="{{ route('orders.create') }}" class="btn btn-light btn-lg">
                    <i class="bi bi-plus-circle"></i> New Order
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Orders Table -->
        <div class="orders-table">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date & Time</th>
                        <th>Items</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <strong>#{{ $order->id }}</strong>
                            </td>
                            <td>
                                @if($order->customer)
                                    <i class="bi bi-person-fill text-muted"></i>
                                    {{ $order->customer->name }}
                                @else
                                    <i class="bi bi-person-dash text-muted"></i>
                                    <em>Walk-in</em>
                                @endif
                            </td>
                            <td>
                                <div>{{ $order->ordered_at->format('M d, Y') }}</div>
                                <small class="text-muted">{{ $order->ordered_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $order->items->sum('quantity') }} item(s)
                                </span>
                            </td>
                            <td>
                                <strong style="color: var(--autumn-orange);">
                                    ₱{{ number_format($order->total_amount, 2) }}
                                </strong>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('orders.show', $order) }}" 
                                   class="btn btn-sm btn-primary"
                                   title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                <p class="text-muted mt-3">No orders found.</p>
                                <a href="{{ route('orders.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Create First Order
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
