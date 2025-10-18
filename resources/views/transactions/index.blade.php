@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">
            <i class="bi bi-receipt-cutoff"></i> Transaction History
        </h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Order
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Orders</p>
                            <h3 class="fw-bold mb-0">{{ $stats['total_orders'] }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-receipt text-primary fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Revenue</p>
                            <h3 class="fw-bold mb-0 text-success">₱{{ number_format($stats['total_revenue'], 2) }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-currency-dollar text-success fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <p class="text-muted mb-1 small">Pending</p>
                    <h4 class="fw-bold mb-0 text-warning">{{ $stats['pending'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <p class="text-muted mb-1 small">Completed</p>
                    <h4 class="fw-bold mb-0 text-success">{{ $stats['completed'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <p class="text-muted mb-1 small">Cancelled</p>
                    <h4 class="fw-bold mb-0 text-danger">{{ $stats['cancelled'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('transactions.index') }}" class="row g-3" id="filterForm">
                <div class="col-md-4">
                    <label class="form-label small text-muted">
                        <i class="bi bi-search"></i> Search Transactions
                    </label>
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Search by Order ID, Customer Name or Email..."
                           value="{{ request('search') }}"
                           title="Examples: Type '5' for Order #5, 'John' for customer names, or 'gmail.com' for emails">
                    <small class="text-muted">
                        <i class="bi bi-info-circle"></i> 
                        Try: Order # (e.g., "5"), Name (e.g., "John"), or Email
                    </small>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted">
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
                    <label class="form-label small text-muted">
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
                    <small class="text-muted">
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
    <div class="card shadow-sm">
        <div class="card-body">
            @if($orders->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                    @if(request('search') || (request('status') && request('status') != 'all'))
                        <p class="text-muted">No transactions found matching your search criteria.</p>
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-2">
                            <i class="bi bi-arrow-left"></i> View All Transactions
                        </a>
                    @else
                        <p class="text-muted">No transactions found. Start taking orders!</p>
                        <a href="{{ route('orders.create') }}" class="btn btn-primary mt-2">
                            <i class="bi bi-plus-circle"></i> Create First Order
                        </a>
                    @endif
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
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
                                    <td class="fw-semibold">
                                        <i class="bi bi-hash"></i>{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td>
                                        @if($order->customer)
                                            <div>
                                                <strong>{{ $order->customer->name }}</strong>
                                                @if($order->customer->phone)
                                                    <br><small class="text-muted">{{ $order->customer->phone }}</small>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted">Walk-in Customer</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <i class="bi bi-calendar3"></i> {{ $order->ordered_at->format('M d, Y') }}
                                            <br><small class="text-muted"><i class="bi bi-clock"></i> {{ $order->ordered_at->format('h:i A') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $order->items->count() }} items</span>
                                    </td>
                                    <td class="fw-bold text-success">
                                        ₱{{ number_format($order->total_amount, 2) }}
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'completed' => 'success',
                                                'cancelled' => 'danger'
                                            ];
                                            $color = $statusColors[$order->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $color }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transactions.show', $order) }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           title="View Details">
                                            <i class="bi bi-eye"></i> View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">
                    <i class="bi bi-check-circle-fill"></i> Success
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">{{ session('success') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('successModal');
        const successModal = new bootstrap.Modal(modalElement);
        successModal.show();
        
        modalElement.addEventListener('hidden.bs.modal', function () {
            document.body.classList.remove('modal-open');
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
        });
    });
</script>
@endif

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

