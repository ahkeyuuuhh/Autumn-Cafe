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
    /* Page header with consistent styling matching menu and customer management */
    .page-header {
        background: var(--warm-cream);
        padding: 2rem;
        border-radius: 20px;
        border: 3px dashed var(--beige);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '\F5E4';
        font-family: 'bootstrap-icons';
        position: absolute;
        font-size: 6rem;
        opacity: 0.1;
        right: -1rem;
        top: -1rem;
    }

    .page-header h1 {
        color: var(--dark-autumn);
        font-weight: 700;
        margin: 0;
        font-size: 2rem;
    }

    .page-header .lead {
        color: var(--pale-autumn);
        margin: 0.5rem 0 0 0;
        font-size: 1rem;
    }

    .new-order-btn {
        background: linear-gradient(135deg, var(--pale-autumn) 0%, var(--autumn-primary) 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .new-order-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(188, 82, 39, 0.3);
        color: white;
    }
        
    /* Refined table styling with better spacing and modern shadows */
    .orders-table {
        background: var(--light);
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid rgba(139, 111, 71, 0.1);
    }
        
    .orders-table thead {
        background: linear-gradient(135deg, var(--brown-500) 0%, var(--brown-600) 100%);
        color: white;
    }
        
    .orders-table th {
        padding: 18px 15px;
        font-weight: 800;
        border-top: 8px solid var(--brown-500);
        color: var(--brown-700);
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }
    
    .orderId-text {
        color: var(--brown-500)!important;
        font-weight: 800;
    }
        
    .orders-table td {
        padding: 16px 15px;
        vertical-align: middle;
        border-bottom: 1px solid rgba(139, 111, 71, 0.06);
    }
        
    .orders-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .orders-table tbody tr:hover {
        background-color: rgba(139, 111, 71, 0.04);
        box-shadow: inset 0 0 0 1px rgba(139, 111, 71, 0.08);
    }
        
    .status-badge {
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
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
        
    .btn-primary {
        background-color: var(--brown-500) !important;
        border: none;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 111, 71, 0.3) !important;
    }
    
    .btn-sm {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.9rem;
    }
    
    .pagination {
        margin-top: 30px;
    }
    
    .page-link {
        color: var(--autumn-primary);
        border: 1px solid #dee2e6;
        border-radius: 6px;
        margin: 0 4px;
        transition: all 0.2s ease;
    }
    
    .page-link:hover {
        background-color: rgba(139, 111, 71, 0.08);
        color: var(--autumn-dark);
        border-color: var(--autumn-primary);
    }
    
    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--brown-600) 100%);
        border-color: var(--autumn-primary);
    }
    
    .view-order-btn {
        background-color: var(--brown-500) !important;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(139, 111, 71, 0.15);
    }

    .view-order-btn:hover {
        transform: scale(1.12);
        box-shadow: 0 6px 18px rgba(139, 111, 71, 0.25);
    }

    /* Completely redesigned modal with modern styling - clean, elegant, and professional */
    /* Smaller overall modal and refined proportions */
    .modal-dialog.modal-xl {
        max-width: 920px; /* slightly smaller than default xl */
        margin: 1.75rem auto;
    }

    .modal-dialog {
        max-width: 720px; /* ensure non-xl dialogs are compact */
        transition: transform 0.36s cubic-bezier(.2,.9,.2,1), opacity 0.28s ease;
        will-change: transform, opacity;
    }

    /* entrance animation */
    .modal.fade .modal-dialog {
        transform: translateY(10px) scale(.995);
        opacity: 0;
    }
    .modal.show .modal-dialog {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    .modal-content {
        border: 3px dashed var(--brown-600) !important;
        background-color: var(--light) !important;
        position: relative;
        z-index: 1055;
        border-radius: 14px !important;
        box-shadow: 0 25px 80px rgba(31,17,16,0.20) !important;
        overflow: hidden;
        border-left: 6px solid rgba(139,111,71,0.08); /* subtle left accent */
    }

    /* decorative accent - top subtle glossy bar */
    .modal-content::before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        height: 6px;
        background: linear-gradient(90deg, rgba(139,111,71,0.12), rgba(139,111,71,0.04));
        z-index: 2;
    }

    .modal-backdrop.show {
        background-color: rgba(31,17,16,0.44);
        backdrop-filter: blur(6px) saturate(1.05);
        -webkit-backdrop-filter: blur(6px) saturate(1.05);
        transition: background-color 220ms ease;
    }

    /* Enhanced modal header with gradient background and improved typography */
    .modal-header {
        background: linear-gradient(135deg, var(--brown-300) 0%, var(--brown-400) 100%) !important;
        border-bottom: 2px solid var(--brown-500) !important;
        padding: 1.3rem 1.6rem !important; /* reduced to fit smaller modal */
        border-radius: 0;
        align-items: center;
        gap: 0.75rem;
    }

    .modal-header .modal-title {
        color: var(--brown-600) !important;
        font-weight: 900 !important;
        font-size: 1.15rem !important;
        letter-spacing: 0.4px;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1) !important;
        opacity: 0.9;
        transition: opacity 0.18s ease, transform 0.18s ease;
        background: rgba(255,255,255,0.06);
        border-radius: 8px;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .modal-header .btn-close:hover {
        opacity: 1;
        transform: scale(1.03);
        background: rgba(255,255,255,0.09);
    }

    /* Refined modal body with subtle gradient background and constrained height */
    .modal-body {
        background: linear-gradient(180deg, var(--light) 0%, var(--brown-50) 100%) !important;
        padding: 1.6rem 1.6rem !important;
        max-height: 68vh; /* keep modal reasonably short */
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* custom scrollbar for modal body (webkit) */
    .modal-body::-webkit-scrollbar {
        width: 10px;
    }
    .modal-body::-webkit-scrollbar-track {
        background: transparent;
    }
    .modal-body::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, rgba(139,111,71,0.12), rgba(139,111,71,0.06));
        border-radius: 10px;
        border: 2px solid transparent;
        background-clip: padding-box;
    }

    /* Modern card styling with smooth shadows and hover effects */
    .order-info-card,
    .customer-info-card,
    .order-items-card {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(139, 111, 71, 0.10);
        box-shadow: 0 6px 22px rgba(0,0,0,0.06);
        background: linear-gradient(180deg, #ffffff 0%, var(--brown-50) 100%);
        transition: transform 0.24s ease, box-shadow 0.24s ease;
        border: 2px solid var(--brown-500) !important;
    }

    .order-info-card:hover,
    .customer-info-card:hover,
    .order-items-card:hover {
        box-shadow: 0 14px 44px rgba(0,0,0,0.10);
        transform: translateY(-3px);
    }

    .order-info-card .card-body,
    .customer-info-card .card-body,
    .order-items-card .card-body {
        padding: 1.1rem !important;
    }

    /* Improved section titles with better visual hierarchy and icons */
    .section-title {
        font-size: 0.95rem;
        font-weight: 900;
        margin-bottom: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        color: var(--brown-700);
        text-transform: uppercase;
        letter-spacing: 0.7px;
    }

    .section-icon {
        font-size: 1rem;
        color: var(--brown-500);
        background: rgba(139, 111, 71, 0.08);
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    /* Enhanced label and value styling for better readability */
    .order-info-label {
        display: block;
        font-size: 0.72rem;
        letter-spacing: 0.8px;
        color: rgba(0,0,0,0.52);
        margin-bottom: 0.35rem;
        text-transform: uppercase;
        font-weight: 800;
    }

    .order-info-value {
        font-size: 1rem;
        color: var(--brown-700);
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 0.45rem;
    }

    .order-time {
        font-size: 0.85rem;
        color: rgba(0,0,0,0.55);
        margin-top: 6px;
        font-weight: 700;
    }

    .order-total-value {
        font-size: 1.15rem;
        font-weight: 900;
        color: var(--brown-600);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-modal {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 18px;
        font-weight: 800;
        font-size: 0.85rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    }

    /* Refined items table styling with modern design */
    .order-items-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.92rem;
    }

    .order-items-table thead th {
        background: linear-gradient(90deg, rgba(139, 111, 71, 0.06) 0%, rgba(139, 111, 71, 0.03) 100%);
        color: var(--brown-700);
        font-weight: 900;
        border-bottom: 1px solid rgba(139, 111, 71, 0.10);
        padding: 0.9rem 1rem;
        text-align: left;
        font-size: 0.85rem;
        letter-spacing: 0.4px;
    }

    .order-items-table tbody td {
        padding: 0.9rem 1rem;
        vertical-align: middle;
        border-top: 1px solid rgba(139, 111, 71, 0.06);
        transition: background 0.16s ease;
    }

    .order-items-table tbody tr:hover td {
        background: rgba(139, 111, 71, 0.02);
    }

    .order-items-header {
        padding: 0.9rem 1rem;
        border-bottom: 1px solid rgba(139, 111, 71, 0.06);
        background: linear-gradient(90deg, rgba(139, 111, 71, 0.03) 0%, transparent 100%);
    }

    .order-items-title {
        margin: 0;
        font-weight: 900;
        color: var(--brown-700);
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .item-image {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.10);
        border: 1px solid rgba(139, 111, 71, 0.08);
    }

    .item-placeholder {
        width: 56px;
        height: 56px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--brown-100), var(--brown-50));
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: rgba(0,0,0,0.28);
        border: 1px dashed rgba(139, 111, 71, 0.14);
    }

    .placeholder-icon {
        font-size: 1.2rem;
        color: rgba(139, 111, 71, 0.32);
    }

    .item-row .item-name {
        font-weight: 900;
        color: var(--brown-700);
        font-size: 0.98rem;
    }

    .item-row .item-category {
        font-size: 0.82rem;
        color: rgba(0,0,0,0.52);
        margin-top: 2px;
        font-weight: 700;
    }

    .price-cell,
    .subtotal-cell {
        font-weight: 800;
        color: var(--brown-700);
    }

    .qty-badge {
        display: inline-block;
        min-width: 36px;
        padding: 6px 10px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(139, 111, 71, 0.10), rgba(139, 111, 71, 0.04));
        color: var(--brown-600);
        font-weight: 900;
        text-align: center;
        border: 1px solid rgba(139, 111, 71, 0.12);
    }

    .order-total-row td {
        background: linear-gradient(90deg, rgba(139, 111, 71, 0.06), rgba(139, 111, 71, 0.03));
        font-weight: 900;
        border-top: 1px solid rgba(139, 111, 71, 0.12);
        padding: 1rem;
    }

    .order-total-label {
        color: var(--brown-700);
        font-size: 0.95rem;
    }

    .order-total-amount {
        color: var(--brown-600);
        font-size: 1.05rem;
        font-weight: 900;
    }

    /* Enhanced action buttons with gradient backgrounds and smooth animations */
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
        flex-wrap: wrap;
        padding: 1rem 0 0;
    }

    .action-buttons .btn {
        padding: 0.6rem 1.25rem;
        border-radius: 10px;
        font-weight: 800;
        border: none;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .action-buttons .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    }

    .update-status-btn {
        background: linear-gradient(135deg, var(--brown-500), var(--brown-600)) !important;
        color: white !important;
    }

    .update-status-btn:hover {
        background: linear-gradient(135deg, var(--brown-600), var(--brown-700)) !important;
    }

    .delete-order-btn {
        background: linear-gradient(135deg, #f8d7da, #f5b7bd) !important;
        color: var(--brown-700) !important;
    }

    .delete-order-btn:hover {
        background: linear-gradient(135deg, #f5b7bd, #f0a0a8) !important;
    }

    .walkin-text {
        color: rgba(0,0,0,0.6);
        font-weight: 700;
        font-size: 0.98rem;
    }

    /* Enhanced modal footer with gradient background and compact spacing */
    .modal-footer {
        background: linear-gradient(135deg, var(--brown-100), var(--brown-50)) !important;
        border-top: 1px solid rgba(139, 111, 71, 0.08) !important;
        padding: 1rem 1.3rem !important;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    .modal-footer .btn {
        padding: 0.6rem 1.25rem;
        font-weight: 800;
        border-radius: 10px;
        transition: transform 0.18s ease;
        font-size: 0.9rem;
    }

    .modal-footer .btn-secondary {
        background: linear-gradient(135deg, var(--brown-300), var(--brown-200)) !important;
        color: var(--brown-700) !important;
        border: none;
    }

    .modal-footer .btn-secondary:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, var(--brown-400), var(--brown-300)) !important;
    }

    .modal-footer .btn-primary {
        background: linear-gradient(135deg, var(--brown-500), var(--brown-600)) !important;
        color: white !important;
    }

    .modal-footer .btn-primary:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, var(--brown-600), var(--brown-700)) !important;
    }

    /* Responsive tweak: make modal slightly narrower on small viewports */
    @media (max-width: 767.98px) {
        .modal-dialog.modal-xl { max-width: calc(100% - 32px); margin: 12px; }
        .modal-body { max-height: 62vh; padding: 1rem !important; }
        .modal-header { padding: 0.9rem 1rem !important; }
        .modal-footer { padding: 0.8rem 1rem !important; }
        .section-title { font-size: 0.9rem; }
    }

    @media (max-width: 767.98px) {
        .page-header {
            padding: 25px;
        }

        .page-header h1 {
            font-size: 1.6rem;
        }

        .order-info-card .card-body,
        .customer-info-card .card-body,
        .order-items-card .card-body {
            padding: 1.25rem !important;
        }

        .item-image, .item-placeholder {
            width: 50px;
            height: 50px;
        }

        .section-title {
            font-size: 1rem;
        }

        .modal-body {
            padding: 1.5rem !important;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn {
            width: 100%;
            justify-content: center;
        }
    }

</style>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>
                <i class="bi bi-cart-check-fill"></i> Order Management
            </h1>
            <p class="lead">🛍️ View and manage all customer orders</p>
        </div>
        <a href="{{ route('orders.create') }}" class="btn new-order-btn">
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
                            <td class="orderId-text">
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
                                <button type="button"
                                   class="btn btn-sm btn-primary view-order-btn"
                                   data-order-id="{{ $order->id }}"
                                   title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
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

    <!-- Order Details Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailsModalLabel">
                        <i class="bi bi-receipt-cutoff"></i> Order Details
                    </h5>
                </div>
                <div class="modal-body" id="orderDetailsContent">
                    <!-- Order details will be loaded here -->
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Loading order details...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Close
                    </button>
                    <button type="button" class="btn btn-primary" id="printOrderBtn">
                        <i class="bi bi-printer"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderDetailsModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
            const orderDetailsContent = document.getElementById('orderDetailsContent');
            let currentOrderId = null;

            // Handle view order button clicks
            document.querySelectorAll('.view-order-btn').forEach(button => {
                button.addEventListener('click', function() {
                    currentOrderId = this.getAttribute('data-order-id');
                    loadOrderDetails(currentOrderId);
                });
            });

            // Load order details via AJAX
            function loadOrderDetails(orderId) {
                // Show loading state
                orderDetailsContent.innerHTML = `
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted" style="font-size: 1.1rem;">Loading order details...</p>
                    </div>
                `;

                // Show modal
                orderDetailsModal.show();

                // Fetch order details
                fetch(`/orders/${orderId}/details`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to load order details');
                        }
                        return response.json();
                    })
                    .then(data => {
                        renderOrderDetails(data);
                    })
                    .catch(error => {
                        orderDetailsContent.innerHTML = `
                            <div class="text-center py-5">
                                <i class="bi bi-exclamation-triangle text-danger" style="font-size: 4rem;"></i>
                                <p class="mt-3 text-danger" style="font-size: 1.2rem; font-weight: 600;">Failed to load order details</p>
                                <p class="text-muted">${error.message}</p>
                            </div>
                        `;
                    });
            }

            // Render order details
            function renderOrderDetails(order) {
                const statusClass = `status-${order.status}`;
                const itemsHtml = order.items.map(item => `
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3 item-row">
                                ${item.menu_item && item.menu_item.image_url 
                                    ? `<img src="${item.menu_item.image_url}" alt="${item.menu_item.name}" class="item-image">`
                                    : `<div class="item-placeholder"><i class="bi bi-cup-straw placeholder-icon"></i></div>`
                                }
                                <div>
                                    <div class="item-name">${item.menu_item ? item.menu_item.name : 'Item Deleted'}</div>
                                    ${item.menu_item ? `<div class="item-category">${item.menu_item.category}</div>` : ''}
                                </div>
                            </div>
                        </td>
                        <td class="price-cell">₱${parseFloat(item.unit_price).toFixed(2)}</td>
                        <td class="text-center">
                            <span class="qty-badge">${item.quantity}</span>
                        </td>
                        <td class="text-end subtotal-cell">₱${parseFloat(item.subtotal).toFixed(2)}</td>
                    </tr>
                `).join('');

                orderDetailsContent.innerHTML = `
                    <div class="row g-4">
                        <!-- Order Info Section -->
                        <div class="col-md-6">
                            <div class="card order-info-card">
                                <div class="card-body">
                                    <h5 class="section-title"><i class="bi bi-info-circle-fill section-icon"></i> Order Information</h5>
                                    <div class="mb-3">
                                        <label class="order-info-label">Order ID</label>
                                        <div class="order-info-value">#${order.id}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="order-info-label">Date & Time</label>
                                        <div class="order-info-value">
                                            <i class="bi bi-calendar-check"></i> ${new Date(order.ordered_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}
                                            <div class="order-time">${new Date(order.ordered_at).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })}</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="order-info-label">Status</label>
                                        <div>
                                            <span class="status-badge ${statusClass} status-modal">${order.status.charAt(0).toUpperCase() + order.status.slice(1)}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="order-info-label">Total Amount</label>
                                        <div class="order-total-value"><i class="bi bi-currency-dollar"></i> ₱${parseFloat(order.total_amount).toFixed(2)}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Info Section -->
                        <div class="col-md-6">
                            <div class="card customer-info-card">
                                <div class="card-body">
                                    <h5 class="section-title"><i class="bi bi-person-fill section-icon"></i> Customer Information</h5>
                                    ${order.customer ? `
                                        <div class="mb-3">
                                            <label class="order-info-label">Name</label>
                                            <div class="order-info-value"><i class="bi bi-person-badge"></i> ${order.customer.name}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="order-info-label">Email</label>
                                            <div class="order-info-value"><i class="bi bi-envelope"></i> ${order.customer.email}</div>
                                        </div>
                                        <div>
                                            <label class="order-info-label">Phone</label>
                                            <div class="order-info-value"><i class="bi bi-telephone"></i> ${order.customer.phone}</div>
                                        </div>
                                    ` : `
                                        <p class="walkin-text"><i class="bi bi-person-dash"></i> Walk-in Customer</p>
                                    `}
                                </div>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <div class="col-12">
                            <div class="card order-items-card">
                                <div class="card-body p-0">
                                    <div class="order-items-header">
                                        <h5 class="order-items-title"><i class="bi bi-cart3"></i> Order Items</h5>
                                    </div>
                                    <table class="table mb-0 order-items-table">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-end">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${itemsHtml}
                                            <tr class="order-total-row">
                                                <td colspan="3" class="order-total-label"><i class="bi bi-cash-stack"></i> Total Cost</td>
                                                <td class="text-end order-total-amount">₱${parseFloat(order.total_amount).toFixed(2)}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-12">
                            <div class="action-buttons">
                                <button type="button" class="btn update-status-btn" onclick="updateOrderStatus(${order.id})">
                                    <i class="bi bi-arrow-repeat"></i> Update Status
                                </button>
                                <button type="button" class="btn delete-order-btn" onclick="deleteOrder(${order.id})">
                                    <i class="bi bi-trash"></i> Delete Order
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }

            // Print order
            document.getElementById('printOrderBtn').addEventListener('click', function() {
                if (currentOrderId) {
                    window.open(`/orders/${currentOrderId}/print`, '_blank');
                }
            });

            // Update order status (placeholder - you'll need to implement the modal)
            window.updateOrderStatus = function(orderId) {
                // Implement status update modal or form here
                alert('Status update functionality - implement as needed');
            };

            // Delete order (placeholder - you'll need to implement confirmation)
            window.deleteOrder = function(orderId) {
                if (confirm('Are you sure you want to delete this order? This action cannot be undone.')) {
                    // Submit delete form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/orders/${orderId}`;
                    form.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            };
        });
    </script>
@endsection
