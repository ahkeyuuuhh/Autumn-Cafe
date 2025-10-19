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
            
            /* Legacy naming */
            --autumn-orange: #8b6f47;
            --autumn-cream: #faf8f6;
            --autumn-brown: #352b1d;
            --autumn-light-orange: #b8a08a;
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
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #faf8f6 0%, #f5f0eb 100%);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
            color: var(--autumn-brown);
        }

        .container {
            max-width: 1000px;
        }
        
        /* Improved navbar styling with better spacing and typography */
        .navbar {
            background: linear-gradient(135deg, var(--brown-700) 0%, var(--brown-800) 100%);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--autumn-light-orange) !important;
            letter-spacing: -0.5px;
        }
        
        .navbar-brand i {
            color: var(--autumn-orange);
            margin-right: 0.5rem;
        }
        
        .nav-link {
            color: rgba(255, 249, 243, 0.85) !important;
            transition: all 0.25s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .nav-link:hover {
            color: var(--autumn-light-orange) !important;
        }
        
        /* Enhanced back button with better styling */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem !important;
            margin-bottom: 2rem !important;
            border-radius: 8px !important;
            background-color: var(--dark-autumn) !important;
            color: white !important;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        
        .back-btn:hover {
            background-color: #6d3319 !important;
            transform: translateX(-2px);
            box-shadow: 0 4px 12px rgba(145, 68, 32, 0.25);
        }
        
        /* Redesigned order header with better visual hierarchy */
        .order-header {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(230, 126, 34, 0.2);
            margin-bottom: 2.5rem;
        }
        
        .order-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }
        
        .order-header .order-date {
            font-size: 0.95rem;
            opacity: 0.95;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .order-header-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 1rem;
        }
        
        /* Improved info cards with better spacing and borders */
        .order-info-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            border-left: 5px solid var(--soft-apricot);
            transition: all 0.25s ease;
        }
        
        .order-info-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }
        
        .order-info-card h4 {
            color: var(--pale-autumn);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .order-info-card h4 i {
            font-size: 1.3rem;
        }
        
        /* Better info label and value styling */
        .info-label {
            color: var(--soft-apricot);
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .info-value {
            color: var(--pale-autumn);
            font-weight: 600;
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .info-value i {
            color: var(--pale-autumn);
            opacity: 0.8;
        }
        
        .info-value small {
            display: block;
            margin-left: 1.75rem;
            font-size: 0.85rem;
            color: var(--autumn-brown);
            opacity: 0.8;
            margin-top: 0.25rem;
        }
        
        /* Enhanced items table styling */
        .items-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-top: 5px solid var(--dusty-rose);
        }
        
        .items-table thead {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
        }
        
        .items-table th {
            padding: 1.25rem;
            font-weight: 700;
            border: none;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }
        
        .items-table td {
            padding: 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f5f0eb;
            font-size: 0.95rem;
        }
        
        .items-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .items-table tbody tr:hover {
            background-color: #faf7f3;
        }
        
        /* Improved total row styling */
        .total-row {
            background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%);
            font-weight: 700;
            color: var(--autumn-brown);
        }
        
        .total-row td {
            padding: 1.5rem 1.25rem;
            border-top: 2px solid #f0e8df;
        }
        
        .total-cost-label {
            color: var(--pale-autumn);
            font-size: 1rem;
        }
        
        .total-cost-value {
            font-size: 1.4rem;
            color: var(--autumn-orange);
        }
        
        /* Better item image styling */
        .item-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
            border: 2px solid #f5f0eb;
        }
        
        .item-placeholder {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            background: linear-gradient(135deg, #f5e7d0 0%, #f2c198 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #f0e8df;
        }
        
        .item-name {
            font-weight: 600;
            color: var(--autumn-brown);
            margin-bottom: 0.25rem;
        }
        
        .item-category {
            font-size: 0.85rem;
            color: var(--soft-apricot);
        }
        
        /* Improved status badge styling */
        .status-badge {
            padding: 0.6rem 1.2rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-block;
            letter-spacing: 0.3px;
            text-transform: uppercase;
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
        
        /* Enhanced action buttons with better styling */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2.5rem;
            flex-wrap: wrap;
        }
        
        .action-buttons .btn {
            padding: 0.85rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            transition: all 0.25s ease;
            border: none;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(230, 126, 34, 0.3);
            color: white;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #27AE60 0%, #229954 100%);
            color: white;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(39, 174, 96, 0.3);
            color: white;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #E74C3C 0%, #C0392B 100%);
            color: white;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(231, 76, 60, 0.3);
            color: white;
        }
        
        .btn-secondary {
            background: #6C757D;
            color: white;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(108, 117, 125, 0.3);
            color: white;
        }
        
        /* Improved modal styling */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }
        
        .modal-header {
            border-bottom: 2px solid #f5f0eb;
            padding: 1.5rem;
        }
        
        .modal-header.bg-danger {
            background: linear-gradient(135deg, #E74C3C 0%, #C0392B 100%) !important;
        }
        
        .modal-body {
            padding: 2rem;
            font-size: 0.95rem;
        }
        
        .modal-footer {
            border-top: 1px solid #f5f0eb;
            padding: 1.5rem;
            gap: 0.75rem;
        }
        
        .form-label {
            font-weight: 700;
            color: var(--autumn-brown);
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }
        
        .form-select {
            border: 2px solid #f0e8df;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }
        
        .form-select:focus {
            border-color: var(--autumn-orange);
            box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.1);
        }
        
        /* Decorative elements with better positioning */
        .autumn-decoration {
            position: fixed;
            opacity: 0.08;
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
        
        /* Better responsive design */
        @media (max-width: 768px) {
            .order-header {
                padding: 1.5rem;
            }
            
            .order-header h1 {
                font-size: 1.5rem;
            }
            
            .order-header-right {
                align-items: flex-start;
            }
            
            .order-info-card {
                padding: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .action-buttons .btn {
                width: 100%;
                justify-content: center;
            }
            
            .items-table th,
            .items-table td {
                padding: 0.75rem;
                font-size: 0.85rem;
            }
            
            .item-image {
                width: 50px;
                height: 50px;
            }
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

    <div class="container" style="position: relative; z-index: 1;">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm shadow-sm back-btn">
            <i class="bi bi-arrow-left"></i> Back to Order Management
        </a>

        <!-- Order Header -->
        <div class="order-header">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h1>
                        <i class="bi bi-receipt-cutoff"></i> Order #{{ $order->id }}
                    </h1>
                    <p class="order-date">
                        <i class="bi bi-calendar-event"></i> 
                        {{ $order->ordered_at->format('F d, Y \a\t h:i A') }}
                    </p>
                </div>
                <div class="order-header-right">
                    <span class="status-badge status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Customer Information -->
            <div class="col-md-6">
                <div class="order-info-card">
                    <h4>
                        <i class="bi bi-person-circle"></i> Customer Information
                    </h4>
                    
                    @if($order->customer)
                        <div>
                            <span class="info-label">Customer Name</span>
                            <div class="info-value">
                                <i class="bi bi-person-fill"></i>
                                {{ $order->customer->name }}
                            </div>
                        </div>
                        
                        @if($order->customer->phone)
                            <div>
                                <span class="info-label">Phone Number</span>
                                <div class="info-value">
                                    <i class="bi bi-telephone-fill"></i>
                                    {{ $order->customer->phone }}
                                </div>
                            </div>
                        @endif
                        
                        @if($order->customer->email)
                            <div>
                                <span class="info-label">Email Address</span>
                                <div class="info-value">
                                    <i class="bi bi-envelope-fill"></i>
                                    {{ $order->customer->email }}
                                </div>
                            </div>
                        @endif
                    @else
                        <p style="color: var(--soft-apricot); font-weight: 600;">
                            <i class="bi bi-person-dash"></i> Walk-in Customer
                        </p>
                    @endif
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-6">
                <div class="order-info-card">
                    <h4>
                        <i class="bi bi-info-circle"></i> Order Summary
                    </h4>
                    
                    <div>
                        <span class="info-label">Order Date & Time</span>
                        <div class="info-value">
                            <i class="bi bi-clock-fill"></i>
                            {{ $order->ordered_at->format('l, F d, Y') }}
                            <small>{{ $order->ordered_at->format('h:i:s A') }}</small>
                        </div>
                    </div>
                    
                    <div>
                        <span class="info-label">Total Items</span>
                        <div class="info-value">
                            <i class="bi bi-basket-fill"></i>
                            {{ $order->items->sum('quantity') }} item(s)
                        </div>
                    </div>
                    
                    <div>
                        <span class="info-label">Total Cost</span>
                        <div class="info-value" style="font-size: 1.3rem; color: var(--autumn-orange); font-weight: 700;">
                            <i class="bi bi-currency-dollar"></i>
                            ₱{{ number_format($order->total_amount, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mt-4">
            <h4 style="color: var(--dark-autumn); font-weight: 700; margin-bottom: 1.5rem;">
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
                                    <div class="d-flex align-items-center gap-3">
                                        @if($item->menuItem && $item->menuItem->image)
                                            <img src="{{ $item->menuItem->image_url }}" 
                                                 alt="{{ $item->menuItem->name }}" 
                                                 class="item-image">
                                        @else
                                            <div class="item-placeholder">
                                                <i class="bi bi-cup-straw" style="font-size: 1.5rem; color: var(--pale-autumn);"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="item-name">{{ $item->menuItem->name ?? 'Item Deleted' }}</div>
                                            @if($item->menuItem)
                                                <div class="item-category">{{ $item->menuItem->category }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>₱{{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary" style="padding: 0.5rem 0.75rem;">{{ $item->quantity }}</span>
                                </td>
                                <td class="text-end">
                                    <strong>₱{{ number_format($item->subtotal, 2) }}</strong>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="3" class="text-end">
                                <span class="total-cost-label">
                                    <i class="bi bi-calculator"></i> <strong>TOTAL COST:</strong>
                                </span>
                            </td>
                            <td class="text-end">
                                <strong class="total-cost-value">
                                    ₱{{ number_format($order->total_amount, 2) }}
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons no-print">
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
                            <label class="form-label">Current Status</label>
                            <p class="mb-3">
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            
                            <label for="status" class="form-label">New Status</label>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.modal').forEach(function(modalElement) {
                modalElement.addEventListener('hidden.bs.modal', function () {
                    document.body.classList.remove('modal-open');
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                });
            });
        });
    </script>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('successModal');
            const successModal = new bootstrap.Modal(modalElement);
            successModal.show();
        });
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
