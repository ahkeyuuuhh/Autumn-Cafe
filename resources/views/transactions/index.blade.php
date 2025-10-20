@extends('layouts.app')

@section('content')
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
        
        /* Semantic naming */
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

    .transactions-header {
        position: relative;
        overflow: hidden;
        background-color: var(--brown-400);
        border: 2px dashed var(--dark-autumn) !important;
        border-radius: 20px !important;
        padding: 30px;
        margin-bottom: 30px;
    }

    .transactions-header::before {
        content: '\F4C0';
        font-family: 'bootstrap-icons';
        position: absolute;
        top: -20px;
        left: -20px;
        font-size: 100px;
        opacity: 0.1;
        transform: rotate(-15deg);
    }

    .transactions-header::after {
        content: '\F332';
        font-family: 'bootstrap-icons';
        position: absolute;
        bottom: -20px;
        right: -20px;
        font-size: 100px;
        opacity: 0.1;
        transform: rotate(15deg);
    }

    .transactions-header h1 {
        color: var(--brown-700) !important;
        position: relative;
        z-index: 1;
    }

    .transactions-header .lead {
        color: var(--brown-600) !important;
        font-weight: 500;
        position: relative;
        z-index: 1;
    }

    .stat-card {
        background-color: var(--warm-cream) !important;
        border-radius: 20px !important;
        border-top: 8px solid var(--brown-500) !important;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        border-left-color: var(--pale-autumn);
    }

    .stat-card p {
        color: var(--brown-400) !important;
        font-weight: 500 !important;
    }

    .stat-card h3, .stat-card h4 {
        color: var(--brown-600) !important;
    }

    .stat-icon {
        background-color: #e7b7a133 !important;
        border-radius: 20px !important;
        transition: transform 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: rotate(10deg) scale(1.1);
    }

    .stat-icon i {
        color: var(--brown-600) !important;
    }

    .stat-card small {
        color: var(--dusty-rose) !important;
    }

    .filter-card {
        background-color: var(--light) !important;
        border-radius: 20px !important;
        border-top: 8px solid var(--soft-apricot) !important;
    }

    .filter-card .card-body {
        padding: 25px;
    }

    .form-label {
        color: var(--pale-autumn) !important;
        font-weight: 600;
    }

    .search-box {
        border: 2px solid var(--beige);
        border-radius: 15px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .search-box:focus {
        border-color: var(--pale-autumn);
        box-shadow: 0 0 0 0.2rem rgba(217, 139, 76, 0.25);
        outline: none;
    }

    .form-control, .form-select {
        border: 2px solid var(--light-beige);
        border-radius: 12px;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--pale-autumn);
        box-shadow: 0 0 0 0.2rem rgba(217, 139, 76, 0.25);
    }

    .btn-primary {
        background-color: var(--pale-autumn) !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: var(--autumn-primary) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-secondary {
        background-color: var(--dusty-rose) !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: var(--light-coral) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .transactions-table-card {
        background-color: var(--light) !important;
        border-radius: 20px !important;
        border-top: 8px solid var(--dusty-rose) !important;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead {
        background-color: var(--light-beige) !important;
    }

    .table thead th {
        color: var(--pale-autumn) !important;
        font-weight: 700;
        border: none;
        padding: 15px;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: var(--warm-cream) !important;
        transform: scale(1.01);
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-color: var(--light-beige);
    }

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    .status-pending {
        background-color: #FFF3CD !important;
        color: #856404 !important;
    }

    .status-completed {
        background-color: #D4EDDA !important;
        color: #155724 !important;
    }

    .status-cancelled {
        background-color: #F8D7DA !important;
        color: #721C24 !important;
    }

    .btn-sm {
        border-radius: 12px !important;
        padding: 6px 12px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-info {
        background-color: var(--soft-apricot) !important;
        border: none;
    }

    .btn-info:hover {
        background-color: var(--pale-autumn) !important;
        transform: translateY(-2px);
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state i {
        color: var(--dusty-rose);
        opacity: 0.5;
    }

    .empty-state p {
        color: var(--pale-autumn);
        font-size: 1.1rem;
    }

    .pagination .page-link {
        color: var(--pale-autumn);
        border: 2px solid var(--light-beige);
        border-radius: 10px;
        margin: 0 3px;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background-color: var(--light-beige);
        color: var(--dark-autumn);
        transform: translateY(-2px);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--pale-autumn);
        border-color: var(--pale-autumn);
        color: white;
    }
</style>

<div class="container-fluid py-4">
    <!-- HEADER -->
    <div class="transactions-header text-center">
        <h1 class="fw-bold mb-2">
            <i class="bi bi-receipt-cutoff"></i> Transaction History
        </h1>
        <p class="lead mb-0">📊 Complete overview of all café transactions</p>
        <small class="text-muted d-block mt-2">{{ now()->format('l, F j, Y - g:i A') }}</small>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-1 small">Total Orders</p>
                            <h3 class="fw-bold mb-0">{{ $stats['total_orders'] }}</h3>
                        </div>
                        <div class="stat-icon rounded-3 p-3">
                            <i class="bi bi-receipt fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-1 small">Total Revenue</p>
                            <h3 class="fw-bold mb-0">₱{{ number_format($stats['total_revenue'], 2) }}</h3>
                        </div>
                        <div class="stat-icon rounded-3 p-3">
                            <i class="bi bi-currency-dollar fs-3"></i>
                        </div>
                    </div>
                    <small>
                        <i class="bi bi-graph-up-arrow"></i> All time earnings
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <p class="mb-1 small">Pending</p>
                    <h4 class="fw-bold mb-0">{{ $stats['pending'] }}</h4>
                    <small>
                        <i class="bi bi-clock-history"></i> Waiting
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <p class="mb-1 small">Completed</p>
                    <h4 class="fw-bold mb-0">{{ $stats['completed'] }}</h4>
                    <small>
                        <i class="bi bi-check-circle"></i> Done
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <p class="mb-1 small">Cancelled</p>
                    <h4 class="fw-bold mb-0">{{ $stats['cancelled'] }}</h4>
                    <small>
                        <i class="bi bi-x-circle"></i> Void
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="filter-card card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('transactions.index') }}" class="row g-3" id="filterForm">
                <div class="col-md-4">
                    <label class="form-label small">
                        <i class="bi bi-search"></i> Search Transactions
                    </label>
                    <input type="text" 
                           name="search" 
                           class="form-control search-box" 
                           placeholder="🔍 Search by Order ID, Customer Name or Email..."
                           value="{{ request('search') }}"
                           title="Examples: Type '5' for Order #5, 'John' for customer names, or 'gmail.com' for emails">
                </div>
                <div class="col-md-2">
                    <label class="form-label small">
                        <i class="bi bi-funnel"></i> Status
                    </label>
                    <select name="status" class="form-select">
                        <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small">
                        <i class="bi bi-sort-down"></i> Sort By Date
                    </label>
                    <select name="sort" class="form-select">
                        <option value="desc" {{ request('sort') === 'desc' || !request('sort') ? 'selected' : '' }}>Newest First</option>
                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                </div>
            </form>
            
            @if(request('search') || (request('status') && request('status') != 'all'))
                <div class="mt-3">
                    <small style="color: var(--pale-autumn);">
                        <i class="bi bi-info-circle"></i> 
                        Showing filtered results
                        @if(request('search'))
                            for: <strong>"{{ request('search') }}"</strong>
                        @endif
                        @if(request('status') && request('status') != 'all')
                            with status: <strong>{{ ucfirst(request('status')) }}</strong>
                        @endif
                    </small>
                </div>
            @endif
        </div>
    </div>

    <!-- Orders Table -->
    <div class="transactions-table-card card shadow-sm">
        <div class="card-body">
            @if($orders->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                    @if(request('search') || (request('status') && request('status') != 'all'))
                        <p>No transactions found matching your search criteria.</p>
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-2">
                            <i class="bi bi-arrow-left"></i> View All Transactions
                        </a>
                    @else
                        <p>No transactions found. Start taking orders!</p>
                        <a href="{{ route('orders.create') }}" class="btn btn-primary mt-2">
                            <i class="bi bi-plus-circle"></i> Create First Order
                        </a>
                    @endif
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
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
                            @foreach($orders as $order)
                                <tr>
                                    <td class="fw-semibold" style="color: var(--dark-autumn);">
                                        <i class="bi bi-hash"></i>{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td>
                                        @if($order->customer)
                                            <div>
                                                <strong style="color: var(--dark-autumn);">{{ $order->customer->name }}</strong>
                                                @if($order->customer->phone)
                                                    <br><small style="color: var(--dusty-rose);">{{ $order->customer->phone }}</small>
                                                @endif
                                            </div>
                                        @else
                                            <span style="color: var(--dusty-rose);">Walk-in Customer</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="color: var(--dark-autumn);">
                                            <i class="bi bi-calendar3"></i> {{ $order->ordered_at->format('M d, Y') }}
                                            <br><small style="color: var(--dusty-rose);"><i class="bi bi-clock"></i> {{ $order->ordered_at->format('h:i A') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $order->items->count() }} items</span>
                                    </td>
                                    <td class="fw-bold" style="color: var(--autumn-primary);">
                                        ₱{{ number_format($order->total_amount, 2) }}
                                    </td>
                                    <td>
                                        @if($order->status === 'pending')
                                            <span class="badge status-pending">
                                                <i class="bi bi-clock-history"></i> Pending
                                            </span>
                                        @elseif($order->status === 'completed')
                                            <span class="badge status-completed">
                                                <i class="bi bi-check-circle-fill"></i> Completed
                                            </span>
                                        @else
                                            <span class="badge status-cancelled">
                                                <i class="bi bi-x-circle-fill"></i> Cancelled
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transactions.show', $order) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i> View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <small style="color: var(--pale-autumn);">
                            Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} transactions
                        </small>
                    </div>
                    <div>
                        {{ $orders->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Auto-refresh every 10 seconds for smooth user experience
    let autoRefreshTimer = setTimeout(function() {
        // Only refresh if no modal is open
        if (!document.querySelector('.modal.show')) {
            window.location.reload();
        } else {
            // Try again in 5 seconds if modal is open
            setTimeout(function() {
                if (!document.querySelector('.modal.show')) {
                    window.location.reload();
                }
            }, 5000);
        }
    }, 10000); // 10 seconds
</script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection

