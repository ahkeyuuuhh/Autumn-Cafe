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
            color: var(--brown-900);
            font-size: 16px;
            line-height: 1.6;
        }

        .container {
            max-width: 1100px;
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
            padding: 0.9rem 1.5rem !important;
            margin-bottom: 2rem !important;
            border-radius: 12px !important;
            background-color: var(--brown-600) !important;
            color: white !important;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.25s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(107, 86, 53, 0.3);
        }
        
        .back-btn:hover {
            background-color: var(--brown-700) !important;
            transform: translateX(-2px);
            box-shadow: 0 6px 16px rgba(107, 86, 53, 0.4);
        }
        
        .back-btn i {
            font-size: 1.2rem;
        }
        
        /* Redesigned order header with better visual hierarchy */
        .order-header {
            background: linear-gradient(135deg, var(--brown-600) 0%, var(--brown-700) 100%);
            color: white;
            padding: 3rem 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(107, 86, 53, 0.35);
            margin-bottom: 3rem;
        }
        
        .order-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
        }

        .order-header h1 i {
            font-size: 2.2rem;
            margin-right: 0.5rem;
        }
        
        .order-header .order-date {
            font-size: 1.1rem;
            opacity: 0.95;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .order-header .order-date i {
            font-size: 1.2rem;
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
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 6px 25px rgba(107, 86, 53, 0.12);
            margin-bottom: 2rem;
            border-left: 6px solid var(--brown-500);
            transition: all 0.25s ease;
        }
        
        .order-info-card:hover {
            box-shadow: 0 8px 35px rgba(107, 86, 53, 0.18);
            transform: translateY(-3px);
        }
        
        .order-info-card h4 {
            color: var(--brown-700);
            font-weight: 800;
            font-size: 1.4rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .order-info-card h4 i {
            font-size: 1.6rem;
            color: var(--brown-600);
        }
        
        /* Better info label and value styling */
        .info-label {
            color: var(--brown-500);
            font-weight: 800;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.6rem;
            display: block;
        }
        
        .info-value {
            color: var(--brown-900);
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1.75rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            line-height: 1.4;
        }
        
        .info-value i {
            color: var(--brown-600);
            font-size: 1.3rem;
        }
        
        .info-value small {
            display: block;
            margin-left: 1.9rem;
            font-size: 1rem;
            color: var(--brown-700);
            opacity: 0.9;
            margin-top: 0.3rem;
            font-weight: 500;
        }
        
        /* Enhanced items table styling */
        .items-table {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 6px 25px rgba(107, 86, 53, 0.15);
            border-top: 6px solid var(--brown-600);
        }
        
        .items-table thead {
            background: linear-gradient(135deg, var(--brown-600) 0%, var(--brown-700) 100%);
            color: white;
        }
        
        .items-table th {
            padding: 1.5rem 1.5rem;
            font-weight: 800;
            border: none;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .items-table td {
            padding: 1.5rem 1.5rem;
            vertical-align: middle;
            border-bottom: 2px solid var(--brown-100);
            font-size: 1.1rem;
            color: var(--brown-900);
            font-weight: 500;
        }
        
        .items-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .items-table tbody tr:hover {
            background-color: var(--brown-50);
        }
        
        /* Improved total row styling */
        .total-row {
            background: linear-gradient(135deg, var(--brown-200) 0%, var(--brown-300) 100%);
            font-weight: 800;
            color: var(--brown-900);
        }
        
        .total-row td {
            padding: 2rem 1.5rem;
            border-top: 3px solid var(--brown-500);
            font-size: 1.1rem;
        }
        
        .total-cost-label {
            color: var(--brown-800);
            font-size: 1.2rem;
            font-weight: 800;
        }

        .total-cost-label i {
            font-size: 1.3rem;
            margin-right: 0.5rem;
        }
        
        .total-cost-value {
            font-size: 1.8rem;
            color: var(--brown-900);
            font-weight: 900;
        }
        
        /* Better item image styling */
        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 3px solid var(--brown-100);
        }
        
        .item-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--brown-200) 0%, var(--brown-300) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid var(--brown-200);
        }

        .item-placeholder i {
            font-size: 2rem;
            color: var(--brown-600);
        }
        
        .item-name {
            font-weight: 700;
            color: var(--brown-900);
            margin-bottom: 0.4rem;
            font-size: 1.15rem;
        }
        
        .item-category {
            font-size: 1rem;
            color: var(--brown-600);
            font-weight: 500;
        }
        
        /* Improved status badge styling */
        .status-badge {
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 800;
            font-size: 1rem;
            display: inline-block;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .status-pending {
            background: #FFF3CD;
            color: #856404;
            border: 2px solid #FFE69C;
        }
        
        .status-paid {
            background: #D1ECF1;
            color: #0C5460;
            border: 2px solid #BEE5EB;
        }
        
        .status-completed {
            background: #D4EDDA;
            color: #155724;
            border: 2px solid #C3E6CB;
        }
        
        .status-cancelled {
            background: #F8D7DA;
            color: #721C24;
            border: 2px solid #F5C6CB;
        }
        
        /* Enhanced action buttons with better styling */
        .action-buttons {
            display: flex;
            gap: 1.25rem;
            justify-content: center;
            margin-top: 3rem;
            flex-wrap: wrap;
        }
        
        .action-buttons .btn {
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-weight: 800;
            transition: all 0.25s ease;
            border: none;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .action-buttons .btn i {
            font-size: 1.2rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--brown-500) 0%, var(--brown-600) 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 111, 71, 0.4);
            background: linear-gradient(135deg, var(--brown-600) 0%, var(--brown-700) 100%);
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
            border-radius: 16px;
            box-shadow: 0 15px 50px rgba(107, 86, 53, 0.4);
            overflow: hidden;
        }
        
        .modal-header {
            border-bottom: none;
            padding: 1.75rem 2rem 1rem 2rem;
            position: relative;
        }

        .modal-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 2rem;
            right: 2rem;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }
        
        .modal-header.bg-danger {
            background: linear-gradient(135deg, #E74C3C 0%, #C0392B 100%) !important;
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .modal-title i {
            font-size: 1.5rem;
        }
        
        .modal-body {
            padding: 2rem;
            font-size: 1rem;
            color: var(--brown-800);
            background: linear-gradient(to bottom, #ffffff 0%, #faf8f6 100%);
            line-height: 1.6;
        }
        
        .modal-footer {
            border-top: 2px solid var(--brown-200);
            padding: 1.5rem 2rem;
            gap: 0.75rem;
            background: linear-gradient(to bottom, #f5f0eb 0%, #e8ddd2 100%);
        }

        .modal-footer .btn {
            border-radius: 10px;
            padding: 0.7rem 1.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }
        
        .form-label {
            font-weight: 700;
            color: var(--brown-800);
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }
        
        .form-select {
            border: 2px solid var(--brown-200);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            color: var(--brown-800);
        }
        
        .form-select:focus {
            border-color: var(--brown-500);
            box-shadow: 0 0 0 3px rgba(139, 111, 71, 0.15);
        }
        
        /* Decorative elements with better positioning */
        .autumn-decoration {
            position: fixed;
            opacity: 0.05;
            pointer-events: none;
            z-index: 0;
        }
        
        .leaf-1 {
            top: 100px;
            left: 50px;
            font-size: 80px;
            color: var(--brown-500);
            transform: rotate(20deg);
        }
        
        .leaf-2 {
            bottom: 100px;
            right: 50px;
            font-size: 100px;
            color: var(--brown-400);
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
                        <p style="color: var(--brown-600); font-weight: 600; font-size: 1.1rem;">
                            <i class="bi bi-person-dash" style="font-size: 1.2rem; margin-right: 0.5rem;"></i> Walk-in Customer
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
                        <div class="info-value" style="font-size: 1.5rem; color: var(--brown-900); font-weight: 900;">
                            <i class="bi bi-currency-dollar"></i>
                            ₱{{ number_format($order->total_amount, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        /* Order Items */
        <div class="mt-4">
            <h4 style="color: var(--brown-800); font-weight: 800; margin-bottom: 2rem; font-size: 1.5rem;">
                <i class="bi bi-cart3" style="font-size: 1.6rem; margin-right: 0.5rem;"></i> Items Ordered
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
                                                <i class="bi bi-cup-straw"></i>
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
                                <td><strong style="font-size: 1.15rem;">₱{{ number_format($item->unit_price, 2) }}</strong></td>
                                <td class="text-center">
                                    <span class="badge" style="background: var(--brown-600); color: white; padding: 0.6rem 1rem; font-size: 1.05rem; font-weight: 700;">{{ $item->quantity }}</span>
                                </td>
                                <td class="text-end">
                                    <strong style="font-size: 1.2rem; color: var(--brown-900);">₱{{ number_format($item->subtotal, 2) }}</strong>
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
                <div class="modal-header bg-primary text-white">
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
