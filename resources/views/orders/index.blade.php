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
    .page-header {
        background-color: var(--warm-cream);
        color: var(--pale-autumn);
        border-left: 8px solid var(--pale-autumn) !important;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(210, 105, 30, 0.3);
        margin-bottom: 30px;
    }

    .page-header h1 {
        color: var(--pale-autumn);
        font-weight: 700;
    }

    .page-header p {
        color: var(--dark-autumn);
        font-size: 1.1rem;
        font-weight: 500;
    }

    .new-order-btn {
        background-color: var(--soft-apricot) !important;
        border-radius: 20px !important;
        font-size: 18px !important;
        color: var(--dark-autumn) !important;
        font-weight: 600 !important;
    }

    .new-order-btn:hover {
        background-color: var(--pale-autumn) !important;
        color: white !important;
    }
        
    .orders-table {
        background: var(--light);
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }
        
    .orders-table thead {
        background: linear-gradient(135deg, var(--autumn-secondary) 0%, var(--autumn-dark) 100%);
        color: white;
    }
        
    .orders-table th {
        padding: 15px;
        font-weight: 600;
        border: none;
        color: var(--pale-autumn);
    }
        
    .orders-table td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }
        
    .orders-table tbody tr:hover {
        background-color: #FFF9F3;
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
        background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 600;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(210, 105, 30, 0.4);
    }
    
    .btn-sm {
        padding: 5px 15px;
        border-radius: 20px;
    }
    
    .pagination {
        margin-top: 20px;
    }
    
    .page-link {
        color: var(--autumn-primary);
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin: 0 3px;
    }
    
    .page-link:hover {
        background-color: #FFF9F3;
        color: var(--autumn-dark);
    }
    
    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
        border-color: var(--autumn-primary);
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-2">
                <i class="bi bi-cart-check-fill"></i> Order Management
            </h1>
            <p class="mb-0 opacity-75">View and manage all orders</p>
        </div>
        <a href="{{ route('orders.create') }}" class="btn btn-light btn-lg new-order-btn">
            <i class="bi bi-plus-circle"></i> New Order
        </a>
    </div>
</div>

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
@endsection