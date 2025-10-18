@extends('layouts.app')

@section('content')
<style>
    :root {
        --beige: #dec3a6;
        --pale-autumn: #d98b4c;
        --autumn-primary: #bc5227;
        --dark-autumn: #914420;
        --soft-apricot: #f2c198;
        --dusty-rose: #e7b7a1;
        --warm-cream: #fff3e2;
        --light-beige: #f5e7d0;
    }

    .transaction-header {
        background: var(--warm-cream);
        padding: 2rem;
        border-radius: 20px;
        border: 3px dashed var(--beige);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .transaction-header::before {
        content: '🧾';
        position: absolute;
        font-size: 6rem;
        opacity: 0.1;
        right: -1rem;
        top: -1rem;
    }

    .transaction-header h1 {
        color: var(--dark-autumn);
        font-weight: 700;
        margin: 0;
        font-size: 2rem;
    }

    .status-pending {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
    }

    .status-completed {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
    }

    .status-cancelled {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
    }

    .status-paid {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
    }

    .info-card {
        background: white;
        border-radius: 20px;
        border: none;
        border-top: 8px solid var(--dusty-rose);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05),
                    0 10px 20px rgba(0, 0, 0, 0.05),
                    0 15px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
    }

    .info-card .card-header {
        background: linear-gradient(135deg, var(--light-beige) 0%, var(--warm-cream) 100%);
        border: none;
        border-radius: 20px 20px 0 0 !important;
        padding: 1.25rem;
    }

    .info-card .card-header h5 {
        color: var(--pale-autumn);
        font-weight: 700;
        margin: 0;
    }

    .info-label {
        color: var(--pale-autumn);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        color: var(--dark-autumn);
        font-weight: 600;
    }

    .items-table thead {
        background: linear-gradient(135deg, var(--light-beige) 0%, var(--warm-cream) 100%);
    }

    .items-table thead th {
        color: var(--pale-autumn);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem;
    }

    .items-table tbody tr {
        transition: all 0.2s ease;
    }

    .items-table tbody tr:hover {
        background: var(--warm-cream);
        transform: scale(1.01);
    }

    .items-table tfoot {
        background: linear-gradient(135deg, var(--soft-apricot) 0%, var(--dusty-rose) 100%);
        color: white;
    }

    .items-table tfoot td {
        font-weight: 700;
        padding: 1rem;
    }

    .summary-card {
        background: linear-gradient(135deg, var(--warm-cream) 0%, var(--light-beige) 100%);
        border-radius: 20px;
        border: 3px solid var(--beige);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .summary-card h5 {
        color: var(--dark-autumn);
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px dashed var(--beige);
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .summary-row span:first-child {
        color: var(--pale-autumn);
    }

    .summary-row span:last-child {
        color: var(--dark-autumn);
        font-weight: 700;
    }

    .total-row {
        font-size: 1.5rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 3px solid var(--autumn-primary);
    }

    .total-row span:last-child {
        color: var(--autumn-primary);
    }

    .btn-back {
        background: white;
        border: 2px solid var(--beige);
        color: var(--dark-autumn);
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: var(--warm-cream);
        border-color: var(--pale-autumn);
        color: var(--dark-autumn);
        transform: translateX(-3px);
    }

    .btn-action {
        background: linear-gradient(135deg, var(--pale-autumn) 0%, var(--autumn-primary) 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(188, 82, 39, 0.3);
        color: white;
    }

    .btn-outline-action {
        border: 2px solid var(--pale-autumn);
        color: var(--pale-autumn);
        background: white;
        padding: 0.75rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-action:hover {
        background: var(--pale-autumn);
        color: white;
        transform: translateY(-2px);
    }

    @media print {
        .navbar, .btn, .card-header, .timeline, form { display: none !important; }
        .card { border: none !important; box-shadow: none !important; }
    }
</style>

<div class="container">
    <!-- Page Header -->
    <div class="transaction-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('transactions.index') }}" class="btn btn-back mb-3">
                    <i class="bi bi-arrow-left"></i> Back to Transactions
                </a>
                <h1>
                    <i class="bi bi-receipt"></i> Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                </h1>
            </div>
            <div>
                @if($order->status === 'pending')
                    <span class="status-pending fs-5">
                        <i class="bi bi-clock-history"></i> Pending
                    </span>
                @elseif($order->status === 'paid')
                    <span class="status-paid fs-5">
                        <i class="bi bi-credit-card"></i> Paid
                    </span>
                @elseif($order->status === 'completed')
                    <span class="status-completed fs-5">
                        <i class="bi bi-check-circle-fill"></i> Completed
                    </span>
                @else
                    <span class="status-cancelled fs-5">
                        <i class="bi bi-x-circle-fill"></i> Cancelled
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Order Information -->
        <div class="col-lg-8">
            <!-- Order Details Card -->
            <div class="info-card card">
                <div class="card-header">
                    <h5><i class="bi bi-info-circle"></i> Order Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="info-label">Order ID</label>
                            <p class="info-value">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="info-label">Order Date & Time</label>
                            <p class="info-value">
                                <i class="bi bi-calendar3"></i> {{ $order->ordered_at->format('F d, Y') }}
                                <br><small><i class="bi bi-clock"></i> {{ $order->ordered_at->format('h:i A') }}</small>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="info-label">Customer</label>
                            <p class="info-value">
                                @if($order->customer)
                                    {{ $order->customer->name }}
                                    @if($order->customer->email)
                                        <br><small style="color: var(--pale-autumn);">{{ $order->customer->email }}</small>
                                    @endif
                                    @if($order->customer->phone)
                                        <br><small style="color: var(--pale-autumn);">{{ $order->customer->phone }}</small>
                                    @endif
                                @else
                                    <span class="text-muted">Walk-in Customer</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="info-label">Status</label>
                            <p>
                                @if($order->status === 'pending')
                                    <span class="status-pending">
                                        <i class="bi bi-clock-history"></i> Pending
                                    </span>
                                @elseif($order->status === 'paid')
                                    <span class="status-paid">
                                        <i class="bi bi-credit-card"></i> Paid
                                    </span>
                                @elseif($order->status === 'completed')
                                    <span class="status-completed">
                                        <i class="bi bi-check-circle-fill"></i> Completed
                                    </span>
                                @else
                                    <span class="status-cancelled">
                                        <i class="bi bi-x-circle-fill"></i> Cancelled
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items Card -->
            <div class="info-card card">
                <div class="card-header">
                    <h5><i class="bi bi-basket"></i> Ordered Items</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table items-table mb-0">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Item Name</th>
                                    <th width="100" class="text-center">Qty</th>
                                    <th width="120" class="text-end">Unit Price</th>
                                    <th width="150" class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $index => $item)
                                    <tr>
                                        <td style="color: var(--dark-autumn);">{{ $index + 1 }}</td>
                                        <td>
                                            <strong style="color: var(--dark-autumn);">{{ $item->menuItem->name ?? 'Item not found' }}</strong>
                                            @if($item->menuItem && $item->menuItem->category)
                                                <br><small style="color: var(--pale-autumn);">{{ $item->menuItem->category }}</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge" style="background: var(--soft-apricot); color: white;">{{ $item->quantity }}</span>
                                        </td>
                                        <td class="text-end" style="color: var(--dark-autumn);">₱{{ number_format($item->unit_price, 2) }}</td>
                                        <td class="text-end" style="color: var(--autumn-primary); font-weight: 700;">₱{{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end">Total Items:</td>
                                    <td class="text-end">{{ $order->items->sum('quantity') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end fs-5">Total Amount:</td>
                                    <td class="text-end fs-5">₱{{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions and Summary -->
        <div class="col-lg-4">
            <!-- Order Summary Card -->
            <div class="summary-card">
                <h5>
                    <i class="bi bi-calculator"></i> Order Summary
                </h5>
                <div class="summary-row">
                    <span>Items:</span>
                    <strong>{{ $order->items->count() }} items</strong>
                </div>
                <div class="summary-row">
                    <span>Quantity:</span>
                    <strong>{{ $order->items->sum('quantity') }} units</strong>
                </div>
                <div class="summary-row total-row">
                    <span>Total:</span>
                    <strong>₱{{ number_format($order->total_amount, 2) }}</strong>
                </div>
            </div>

            <!-- Status Update Card -->
            <div class="info-card card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-arrow-repeat"></i> Update Status</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('transactions.update-status', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label class="form-label info-label">Change Status To:</label>
                            <select name="status" class="form-select" required style="border: 2px solid var(--beige); border-radius: 10px;">
                                <option value="">Select Status...</option>
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-action w-100">
                            <i class="bi bi-check-circle"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="info-card card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-lightning-charge"></i> Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button onclick="window.print()" class="btn btn-outline-action">
                            <i class="bi bi-printer"></i> Print Receipt
                        </button>
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-action">
                            <i class="bi bi-list"></i> All Transactions
                        </a>
                        <a href="{{ route('orders.create') }}" class="btn btn-outline-action">
                            <i class="bi bi-plus-circle"></i> New Order
                        </a>
                    </div>
                </div>
            </div>

            <!-- Timeline Card -->
            <div class="info-card card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-clock-history"></i> Timeline</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <small class="info-label">Created</small>
                            <p class="mb-0 info-value">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        @if($order->updated_at != $order->created_at)
                            <div class="timeline-item mt-3">
                                <small class="info-label">Last Updated</small>
                                <p class="mb-0 info-value">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection

