@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Header with Autumn Theme -->
    <div class="welcome-header text-center mb-5 py-5 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%); border: 2px solid #E67E22;">
        <h1 class="display-4 fw-bold mb-2" style="color: #8B4513;">
            <i class="bi bi-cup-hot-fill"></i> Welcome to Autumn Café Dashboard
        </h1>
        <p class="lead text-muted mb-0">☕ Managing your cozy café with warmth and efficiency</p>
        <small class="text-muted">{{ now()->format('l, F j, Y - g:i A') }}</small>
    </div>

    <!-- Today's Statistics Row -->
    <div class="row g-4 mb-4">
        <!-- Today's Orders -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100 hover-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Today's Orders</p>
                            <h2 class="fw-bold mb-0 text-primary">{{ $stats['orders_today'] }}</h2>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-cart-check-fill text-primary fs-3"></i>
                        </div>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-calendar-day"></i> {{ now()->format('M d, Y') }}
                    </small>
                </div>
            </div>
        </div>

        <!-- Today's Sales -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100 hover-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Today's Sales</p>
                            <h2 class="fw-bold mb-0 text-success">₱{{ number_format($stats['sales_today'], 2) }}</h2>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-currency-dollar text-success fs-3"></i>
                        </div>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-graph-up-arrow"></i> Revenue today
                    </small>
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100 hover-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Total Customers</p>
                            <h2 class="fw-bold mb-0 text-info">{{ $stats['total_customers'] }}</h2>
                        </div>
                        <div class="stat-icon bg-info bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-people-fill text-info fs-3"></i>
                        </div>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-person-badge"></i> Registered users
                    </small>
                </div>
            </div>
        </div>

        <!-- Menu Items -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100 hover-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Menu Items</p>
                            <h2 class="fw-bold mb-0 text-warning">{{ $stats['total_menu_items'] }}</h2>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-cup-straw text-warning fs-3"></i>
                        </div>
                    </div>
                    <small class="text-muted">
                        @if($stats['low_stock_items'] > 0)
                            <span class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> {{ $stats['low_stock_items'] }} low stock</span>
                        @else
                            <i class="bi bi-check-circle"></i> All stocked
                        @endif
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">
                        <i class="bi bi-lightning-charge-fill text-warning"></i> Quick Actions
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('menu.index') }}" class="btn btn-outline-primary w-100 py-3 hover-btn">
                                <i class="bi bi-cup-hot fs-4 d-block mb-2"></i>
                                <span class="fw-semibold">Manage Menu</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('orders.create') }}" class="btn btn-outline-success w-100 py-3 hover-btn">
                                <i class="bi bi-plus-circle fs-4 d-block mb-2"></i>
                                <span class="fw-semibold">New Order</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('transactions.index') }}" class="btn btn-outline-info w-100 py-3 hover-btn">
                                <i class="bi bi-receipt fs-4 d-block mb-2"></i>
                                <span class="fw-semibold">View Transactions</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary w-100 py-3 hover-btn">
                                <i class="bi bi-people fs-4 d-block mb-2"></i>
                                <span class="fw-semibold">Manage Customers</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- All-Time Overview & Recent Orders -->
    <div class="row g-4 mb-4">
        <!-- All-Time Statistics -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">
                        <i class="bi bi-bar-chart-fill text-primary"></i> All-Time Overview
                    </h5>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total Orders</span>
                            <span class="fw-bold fs-5">{{ $stats['total_orders'] }}</span>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total Revenue</span>
                            <span class="fw-bold fs-5 text-success">₱{{ number_format($stats['total_sales'], 2) }}</span>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Average Order</span>
                            <span class="fw-bold fs-5">₱{{ $stats['total_orders'] > 0 ? number_format($stats['total_sales'] / $stats['total_orders'], 2) : '0.00' }}</span>
                        </div>
                    </div>
                    <div class="mt-4 p-3 rounded-3" style="background: #FFF9F3;">
                        <div class="text-center">
                            <i class="bi bi-trophy-fill text-warning fs-2"></i>
                            <p class="mb-0 mt-2 fw-semibold">Keep up the great work! 🍂</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">
                        <i class="bi bi-clock-history text-info"></i> Recent Orders
                    </h5>
                    @if($stats['recent_orders']->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                            <p>No orders yet. Start taking orders!</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stats['recent_orders'] as $order)
                                        <tr>
                                            <td class="fw-semibold">#{{ $order->id }}</td>
                                            <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                            <td class="text-success fw-semibold">₱{{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'secondary') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="text-muted small">{{ $order->created_at->format('M d, g:i A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-3">
                            <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-outline-primary">
                                View All <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Autumn Theme Decorative Element -->
    <div class="text-center mt-5 mb-4">
        <p class="text-muted">🍂 🍁 ☕ Autumn Café - Where Every Sip Tells a Story 🍂 🍁 ☕</p>
    </div>
</div>

<style>
    .hover-card {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        border-left-color: #E67E22;
    }
    .stat-icon {
        transition: transform 0.3s ease;
    }
    .hover-card:hover .stat-icon {
        transform: rotate(10deg) scale(1.1);
    }
    .hover-btn {
        transition: all 0.3s ease;
    }
    .hover-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .welcome-header {
        position: relative;
        overflow: hidden;
    }
    .welcome-header::before {
        content: '🍂';
        position: absolute;
        top: -20px;
        left: -20px;
        font-size: 100px;
        opacity: 0.1;
        transform: rotate(-15deg);
    }
    .welcome-header::after {
        content: '☕';
        position: absolute;
        bottom: -20px;
        right: -20px;
        font-size: 100px;
        opacity: 0.1;
        transform: rotate(15deg);
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
    // Auto-refresh every 10 seconds for smooth user experience
    setTimeout(function() {
        window.location.reload();
    }, 10000); // 10 seconds
</script>
@endsection
