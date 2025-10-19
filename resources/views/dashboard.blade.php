@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- HEADER -->
    <div class="welcome-header text-center mb-5 py-5 rounded-4 shadow-sm">
        <h1 class="display-4 fw-bold mb-2" style="color: #6b5635;">
            <i class="bi bi-cup-hot-fill"></i> Welcome to Autumn Café Dashboard
        </h1>
        <p class="lead text-muted mb-0">☕ Managing your cozy café with warmth and efficiency</p>
        <small class="text-muted">{{ now()->format('l, F j, Y - g:i A') }}</small>
    </div>

    <!-- STATISTICS -->
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

        <!-- SALES ROW -->
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

        <!-- TOTAL CUSTOMERS -->
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

        <!-- MENU ITEMS -->
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

    <!-- QUICK ACTIONS -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm quick-action-card">
                <div class="card-body quick-action-body">
                    <h5 class="card-title fw-bold mb-4 quick-action-card-title">
                        <i class="bi bi-lightning-charge-fill text-warning"></i> Quick Actions
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-3 manage-menu-card">
                            <a href="{{ route('menu.index') }}" class="btn btn-outline-primary w-100 py-3 hover-btn">
                                <i class="bi bi-cup-hot fs-4 d-block mb-2"></i>
                                <span class="fw-semibold">Manage Menu</span>
                            </a>
                        </div>
                        <div class="col-md-3 new-order-card">
                            <a href="{{ route('orders.create') }}" class="btn btn-outline-success w-100 py-3 hover-btn">
                                <i class="bi bi-plus-circle fs-4 d-block mb-2"></i>
                                <span class="fw-semibold">New Order</span>
                            </a>
                        </div>
                        <div class="col-md-3 view-transactions-card">
                            <a href="{{ route('transactions.index') }}" class="btn btn-outline-info w-100 py-3 hover-btn">
                                <i class="bi bi-receipt fs-4 d-block mb-2"></i>
                                <span class="fw-semibold">View Transactions</span>
                            </a>
                        </div>
                        <div class="col-md-3 manage-customers-card">
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

    <!-- OVERVIEW AND RECENT ORDERS -->
    <div class="row g-4 mb-4">
        <!-- ALL TIME STATISTICS -->
        <div class="col-lg-4 overview-col">
            <div class="card border-0 shadow-sm h-100 overview-card">
                <div class="card-body overview-card-body">
                    <h5 class="card-title fw-bold mb-4 overview-card-title">
                        <i class="bi bi-bar-chart-fill text-primary"></i> All-Time Overview
                    </h5>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total Orders</span>
                            <span class="fw-bold fs-5 totalOrders">{{ $stats['total_orders'] }}</span>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total Revenue</span>
                            <span class="fw-bold fs-5 text-success totalRev">₱{{ number_format($stats['total_sales'], 2) }}</span>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Average Order</span>
                            <span class="fw-bold fs-5 averageOrder">₱{{ $stats['total_orders'] > 0 ? number_format($stats['total_sales'] / $stats['total_orders'], 2) : '0.00' }}</span>
                        </div>
                    </div>
                    <div class="mt-4 p-3 rounded-3 overview-bottom-card">
                        <div class="text-center">
                            <i class="bi bi-trophy-fill text-warning fs-2"></i>
                            <p class="mb-0 mt-2 fw-semibold bottom-text">Keep up the great work! 🍂</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RECENTS ORDERS -->
        <div class="col-lg-8 recent-orders-col">
            <div class="card border-0 shadow-sm h-100 recent-orders-card">
                <div class="card-body recent-orders-card-body">
                    <h5 class="card-title fw-bold mb-4 recent-orders-card-title">
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
                            <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-outline-primary view-all-trans-btn">
                                View All <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

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
      
      /* Semantic naming for easy replacement */
      --beige: #d4c4b5;
      --pale-autumn: #b8a08a;
      --autumn-primary: #8b6f47;
      --dark-autumn: #6b5635;
      --green-brown: #6b5635;
      --dark-brown: #352b1d;
      --light: #faf8f6;
      --light-beige: #f5f0eb;
      --soft-apricot: #e8ddd2;
      --dusty-rose: #d4c4b5;
      --light-coral: #b8a08a;
      --warm-cream: #faf8f6;
    }
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
        background-color: var(--beige);
        border: 2px dashed var(--dark-autumn) !important;
        border-radius: 20px !important;
    }

    .welcome-header p {
        color: var(--pale-autumn) !important;
        font-weight: 500 !important; 
    }
    .welcome-header small {
        color: var(--dark-brown) !important;
        font-weight: 400 !important;
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
    .stat-card {
        background-color: var(--warm-cream) !important;
        border-radius: 20px !important;
        border-top: 8px solid var(--dusty-rose) !important;
    }
    .stat-card p{
        color: var(--dusty-rose) !important;
        font-weight: 500 !important;
    }
    .stat-card h2 {
        color: var(--soft-apricot) !important;
    }
    .stat-icon {
        background-color: #e7b7a133 !important;
        border-radius: 20px !important;
    }
    .stat-icon i {
        color: var(--soft-apricot) !important;
    }
    .stat-card small {
        color: var(--dusty-rose) !important;
    }
    .quick-action-card {
        background-color: var(--warm-cream) !important;
        border-radius: 20px !important;
    }
    .quick-action-card-title {
        color: var(--autumn-primary) !important;
    }
    .manage-menu-card a{
        border-radius: 20px !important;
        border: none !important;
        border-left: 8px solid var(--pale-autumn) !important;
        background-color: var(--soft-apricot) !important;
    }
    .manage-menu-card i,
    .manage-menu-card span  {
        color: white !important;
    }
    .manage-menu-card a:hover{
        background-color: var(--pale-autumn) !important;
    }
    .manage-menu-card a:hover i,
    .manage-menu-card a:hover span {
        color: white !important;
    }
    .new-order-card a {
        border-radius: 20px !important;
        border: none !important;
        border-left: 8px solid var(--dark-autumn) !important;
        background-color: var(--pale-autumn) !important;
    }
    .new-order-card i,
    .new-order-card span{
        color: white !important;
    }
    .new-order-card a:hover {
        background-color: var(--dark-autumn) !important;
    }
    .new-order-card a:hover i,
    .new-order-card a:hover span {
        color: white !important;
    }
    .view-transactions-card a {
        background-color: var(--dusty-rose) !important;
        border-radius: 20px !important;
        border: none !important;
        border-left: 8px solid var(--light-coral) !important;
    }
    .view-transactions-card i,
     .view-transactions-card span {
        color: white !important;
    }
    .view-transactions-card a:hover {
        background-color: var(--light-coral) !important
    }
    .view-transactions-card a:hover i,
    .view-transactions-card a:hover span {
        color: white !important;
    }
    .manage-customers-card a {
        background-color: var(--autumn-primary) !important;
        border-radius: 20px !important;
        border: none !important;
        border-left: 8px solid var(--dark-autumn) !important;
    }
    .manage-customers-card i,
    .manage-customers-card span {
        color: white !important;
    }
    .manage-customers-card a:hover {
        background-color: var(--dark-autumn) !important;
    }
    .manage-customers-card a:hover i,
    .manage-customers-card a:hover span {
        color: white !important;
    }
    .overview-card {
        background-color: var(--light) !important;
        border-radius: 20px !important;
        border-top: 8px solid var(--dusty-rose) !important;
    }
    .overview-card-title {
        color: var(--pale-autumn) !important;
    }
    .overview-card-title i {
        color: var(--pale-autumn) !important;
    }
    .totalOrders,.averageOrder {
        color: var(--soft-apricot) !important;
    }
    .totalRev {
        color: var(--autumn-primary) !important;
    }
    .bottom-text {
        color: var(--pale-autumn) !important;
    }
    .overview-bottom-card {
        background-color: var(--light-beige) !important;
    }
    .recent-orders-card {
        background-color: var(--light) !important;
        border-radius: 20px !important;
        border-top: 8px solid var(--soft-apricot) !important;
    }
    .recent-orders-card-title {
        color: var(--pale-autumn) !important;
    }
    .recent-orders-card-title i {
        color: var(--pale-autumn) !important;
    }
    th {
        color: var(--pale-autumn) !important;
    }
    .view-all-trans-btn {
        border-radius: 20px !important;
        background-color: var(--pale-autumn) !important;
        border: none; 
        padding: 8px 20px;
        color: white;
        text-decoration: none;
        font-weight: 500 !important;
    }
    .view-all-trans-btn:hover {
        background-color: var(--autumn-primary) !important;
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
