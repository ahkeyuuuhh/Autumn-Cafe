@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="bi bi-arrow-left"></i> Back to Transactions
            </a>
            <h1 class="fw-bold text-primary mb-0">
                <i class="bi bi-receipt"></i> Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
            </h1>
        </div>
        <div>
            @php
                $statusColors = [
                    'pending' => 'warning',
                    'paid' => 'info',
                    'completed' => 'success',
                    'cancelled' => 'danger'
                ];
                $color = $statusColors[$order->status] ?? 'secondary';
            @endphp
            <span class="badge bg-{{ $color }} fs-5 px-4 py-2">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        <!-- Order Information -->
        <div class="col-lg-8">
            <!-- Order Details Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Order Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Order ID</label>
                            <p class="fw-bold">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Order Date & Time</label>
                            <p class="fw-bold">
                                <i class="bi bi-calendar3"></i> {{ $order->ordered_at->format('F d, Y') }}
                                <br><small><i class="bi bi-clock"></i> {{ $order->ordered_at->format('h:i A') }}</small>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Customer</label>
                            <p class="fw-bold">
                                @if($order->customer)
                                    {{ $order->customer->name }}
                                    @if($order->customer->email)
                                        <br><small class="text-muted">{{ $order->customer->email }}</small>
                                    @endif
                                    @if($order->customer->phone)
                                        <br><small class="text-muted">{{ $order->customer->phone }}</small>
                                    @endif
                                @else
                                    <span class="text-muted">Walk-in Customer</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Status</label>
                            <p>
                                <span class="badge bg-{{ $color }} fs-6 px-3 py-2">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-basket"></i> Ordered Items</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
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
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $item->menuItem->name ?? 'Item not found' }}</strong>
                                            @if($item->menuItem && $item->menuItem->category)
                                                <br><small class="text-muted">{{ $item->menuItem->category }}</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary">{{ $item->quantity }}</span>
                                        </td>
                                        <td class="text-end">₱{{ number_format($item->unit_price, 2) }}</td>
                                        <td class="text-end fw-bold">₱{{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Total Items:</td>
                                    <td class="text-end fw-bold">{{ $order->items->sum('quantity') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold fs-5">Total Amount:</td>
                                    <td class="text-end fw-bold fs-5 text-success">₱{{ number_format($order->total_amount, 2) }}</td>
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
            <div class="card shadow-sm mb-4" style="background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%);">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="bi bi-calculator"></i> Order Summary
                    </h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Items:</span>
                        <strong>{{ $order->items->count() }} items</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Quantity:</span>
                        <strong>{{ $order->items->sum('quantity') }} units</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fs-5">Total:</span>
                        <strong class="fs-4 text-success">₱{{ number_format($order->total_amount, 2) }}</strong>
                    </div>
                </div>
            </div>

            <!-- Status Update Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-arrow-repeat"></i> Update Status</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('transactions.update-status', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label class="form-label">Change Status To:</label>
                            <select name="status" class="form-select" required>
                                <option value="">Select Status...</option>
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-lightning-charge"></i> Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button onclick="window.print()" class="btn btn-outline-primary">
                            <i class="bi bi-printer"></i> Print Receipt
                        </button>
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-list"></i> All Transactions
                        </a>
                        <a href="{{ route('orders.create') }}" class="btn btn-outline-success">
                            <i class="bi bi-plus-circle"></i> New Order
                        </a>
                    </div>
                </div>
            </div>

            <!-- Timeline Card -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-clock-history"></i> Timeline</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <small class="text-muted">Created</small>
                            <p class="mb-0">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        @if($order->updated_at != $order->created_at)
                            <div class="timeline-item mt-2">
                                <small class="text-muted">Last Updated</small>
                                <p class="mb-0">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .navbar, .btn, .card-header, .timeline, form { display: none !important; }
    .card { border: none !important; box-shadow: none !important; }
}
</style>

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

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection

