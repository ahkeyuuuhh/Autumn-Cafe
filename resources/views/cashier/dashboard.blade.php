@extends('layouts.cashier')

@section('title', 'Cashier Dashboard')

@section('styles')
<style>
    .welcome-header {
        background: linear-gradient(135deg, var(--warm-cream) 0%, var(--light-beige) 100%);
        border: 3px dashed var(--beige);
        position: relative;
        overflow: hidden;
        padding: 50px;
        margin-bottom: 30px;
        border-radius: 20px;
        animation: slideInDown 0.6s ease-out;
    }
    
    .welcome-header::before {
        content: '\F284';
        font-family: 'bootstrap-icons';
        position: absolute;
        font-size: 8rem;
        opacity: 0.1;
        right: 2rem;
        top: -1rem;
        animation: float 6s ease-in-out infinite;
    }

    .welcome-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 25% 25%, rgba(139, 111, 71, 0.03) 2px, transparent 2px),
            radial-gradient(circle at 75% 75%, rgba(139, 111, 71, 0.03) 2px, transparent 2px);
        background-size: 50px 50px;
        pointer-events: none;
    }
    
    .welcome-header h1 {
        color: var(--dark-autumn);
        font-weight: 800;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        animation: fadeInUp 0.8s ease-out 0.2s both;
        position: relative;
        z-index: 1;
    }

    .welcome-header p {
        animation: fadeInUp 0.8s ease-out 0.4s both;
        position: relative;
        z-index: 1;
    }
        
        .navbar {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .bg-autumn {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
        }
        
        .stats-card {
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .stats-card.pending {
            background: linear-gradient(135deg, #b8a08a 0%, #8b6f47 100%);
            color: white;
        }
        
        .stats-card.revenue {
            background: linear-gradient(135deg, #66BB6A 0%, #43A047 100%);
            color: white;
        }
        
        .stats-card.completed {
            background: linear-gradient(135deg, #42A5F5 0%, #1E88E5 100%);
            color: white;
        }
        
        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
        }
    
    .stats-card {
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
        animation: scaleIn 0.5s ease-out backwards;
    }

    .stats-card:nth-child(1) { animation-delay: 0.1s; }
    .stats-card:nth-child(2) { animation-delay: 0.2s; }
    .stats-card:nth-child(3) { animation-delay: 0.3s; }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 30px 30px, 40px 40px;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stats-card:hover::before {
        opacity: 1;
    }

    .stats-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 12px 35px rgba(0,0,0,0.2);
    }

    .stats-card h3 {
        transition: transform 0.3s ease;
    }

    .stats-card:hover h3 {
        transform: scale(1.1);
    }
    
    .stats-card.pending {
        background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%);
        border-top: 4px solid var(--autumn-primary);
    }

    .stats-card.pending h3 {
        color: var(--autumn-primary);
    }

    .stats-card.pending i {
        color: var(--autumn-primary);
    }
    
    .stats-card.revenue {
        background: linear-gradient(135deg, #E8DDD2 0%, #D4C4B5 100%);
        border-top: 4px solid var(--dark-autumn);
    }

    .stats-card.revenue h3 {
        color: var(--dark-autumn);
    }

    .stats-card.revenue i {
        color: var(--dark-autumn);
    }
    
    .stats-card.completed {
        background: linear-gradient(135deg, #F5F0EB 0%, #E8DDD2 100%);
        border-top: 4px solid var(--pale-autumn);
    }

    .stats-card.completed h3 {
        color: var(--pale-autumn);
    }

    .stats-card.completed i {
        color: var(--pale-autumn);
    }
    
    .stats-card h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 10px 0;
    }
    
    .stats-card i {
        opacity: 0.9;
    }
    
    .table-container {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        border-top: 8px solid var(--pale-autumn);
        animation: fadeInUp 0.6s ease-out 0.5s backwards;
    }

    .table-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 15% 30%, rgba(139, 111, 71, 0.02) 2px, transparent 2px),
            radial-gradient(circle at 85% 70%, rgba(139, 111, 71, 0.02) 2px, transparent 2px);
        background-size: 60px 60px, 70px 70px;
        pointer-events: none;
        border-radius: 20px;
    }
    
    .table-container h4 {
        color: var(--autumn-secondary);
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
        z-index: 1;
    }
    
    .table {
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }
    
    .table thead {
        background: linear-gradient(135deg, var(--light-beige) 0%, var(--warm-cream) 100%);
        border-bottom: 2px solid var(--autumn-light);
        position: relative;
    }

    .table thead::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(139, 111, 71, 0.02) 10px,
                rgba(139, 111, 71, 0.02) 20px
            );
        pointer-events: none;
    }
    
    .table thead th {
        color: var(--autumn-dark);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 15px;
        position: relative;
    }
    
    .table tbody tr {
        border-bottom: 1px solid #f1f1f1;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .table tbody tr:hover {
        background: linear-gradient(90deg, rgba(255, 243, 224, 0.4) 0%, transparent 100%) !important;
        transform: translateX(8px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.08) !important;
    }
    
    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        font-size: 0.95rem;
    }
    
    /* Improved readability styles */
    body {
        font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, 'Roboto', 'Helvetica Neue', Arial, sans-serif;
        letter-spacing: 0.3px;
        line-height: 1.6;
    }
    
    h1, h2, h3, h4, h5, h6 {
        letter-spacing: 0.5px;
    }
    
    .table thead th {
        letter-spacing: 0.8px;
    }
    
    strong {
        font-weight: 600;
    }
    
    .badge-status {
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        position: relative;
        overflow: hidden;
    }

    .badge-status::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }

    .badge-status:hover::before {
        left: 100%;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #8b6f47 0%, #6b5635 100%) !important;
        border: none !important;
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        color: white !important;
        box-shadow: 0 2px 8px rgba(139, 111, 71, 0.3);
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .btn-primary:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #6b5635 0%, #4a3d28 100%) !important;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(139, 111, 71, 0.5) !important;
        color: white !important;
    }

    .btn-primary:active {
        transform: translateY(-1px);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #4CAF50 0%, #45A049 100%) !important;
        border: none !important;
        border-radius: 10px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        color: white !important;
        box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);
    }

    .btn-success::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .btn-success:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .btn-success:hover {
        background: linear-gradient(135deg, #45A049 0%, #388E3C 100%) !important;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4) !important;
        color: white !important;
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #757575 0%, #616161 100%) !important;
        border: none !important;
        color: white !important;
        border-radius: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(117, 117, 117, 0.3);
    }
    
    .btn-secondary:hover {
        background: linear-gradient(135deg, #616161 0%, #424242 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(117, 117, 117, 0.4) !important;
        color: white !important;
    }
    
    .btn-outline-secondary {
        border: 2px solid #8b6f47 !important;
        color: #8b6f47 !important;
        background: white !important;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .btn-outline-secondary:hover {
        background: linear-gradient(135deg, #8b6f47 0%, #6b5635 100%) !important;
        color: white !important;
        border-color: #8b6f47 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 111, 71, 0.3);
    }

    .btn-success::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .btn-success:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .btn-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(139, 111, 71, 0.4);
    }

    /* Animations */
    @keyframes slideInDown {
        from {
            transform: translateY(-30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes scaleIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(5deg); }
    }
    
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    
    .modal-header {
        border-bottom: none;
        border-radius: 20px 20px 0 0;
        padding: 25px 30px;
        background-color: brown !important;
    }
    
    .modal-body {
        padding: 30px;
    }
    
    .modal-footer {
        border-top: none;
        padding: 20px 30px;
    }
    
    .alert {
        border-radius: 10px;
        border: none;
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="welcome-header">
    <h1 class="mb-2">
        <i class="bi bi-cash-register"></i> Cashier Dashboard
    </h1>
    <p class="lead text-muted mb-0">Process orders and manage transactions efficiently</p>
</div>

<!-- Stats Cards -->
        <div class="row">
            <div class="col-md-4">
                <div class="stats-card pending">
                    <i class="bi bi-hourglass-split" style="font-size: 2rem;"></i>
                    <h3>{{ $stats['pending_count'] }}</h3>
                    <p class="mb-0">Pending Orders</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card revenue">
                    <i class="bi bi-cash-stack" style="font-size: 2rem;"></i>
                    <h3>₱{{ number_format($stats['today_revenue'], 2) }}</h3>
                    <p class="mb-0">Today's Revenue</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card completed">
                    <i class="bi bi-check-circle-fill" style="font-size: 2rem;"></i>
                    <h3>{{ $stats['today_completed'] }}</h3>
                    <p class="mb-0">Completed Today</p>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0" style="color: var(--autumn-secondary); font-weight: 700; font-size: 1.5rem;">
                    <i class="bi bi-clock-history me-2"></i>Pending Orders
                </h4>
                <span class="badge text-dark" style="background-color: var(--pale-autumn); padding: 10px 18px; font-size: 1rem; border-radius: 20px; font-weight: 600;">
                    {{ $pendingOrders->count() }} {{ $pendingOrders->count() === 1 ? 'Order' : 'Orders' }}
                </span>
            </div>
            
            @if($pendingOrders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" style="border-collapse: separate; border-spacing: 0 10px;">
                        <thead>
                            <tr>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Order #</th>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Customer</th>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Items</th>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Total</th>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Ordered At</th>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingOrders as $order)
                                <tr style="cursor: pointer; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border-radius: 10px;" onclick="showOrderDetails({{ $order->id }})">
                                    <td style="padding: 20px 15px; border: none; border-radius: 10px 0 0 10px;">
                                        <strong style="color: var(--autumn-primary); font-size: 1.05rem;">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</strong>
                                    </td>
                                    <td style="padding: 20px 15px; border: none;">
                                        <div>
                                            <strong style="color: var(--autumn-dark); font-size: 0.95rem;">{{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}</strong>
                                            @if($order->customer && $order->customer->phone)
                                                <br><small class="text-muted" style="font-size: 0.85rem;">{{ $order->customer->phone }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="padding: 20px 15px; border: none;">
                                        <span class="badge" style="background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%); color: var(--autumn-primary); padding: 8px 14px; font-weight: 600; border-radius: 20px;">
                                            <i class="bi bi-basket me-1"></i>{{ $order->items->count() }} {{ $order->items->count() === 1 ? 'item' : 'items' }}
                                        </span>
                                    </td>
                                    <td style="padding: 20px 15px; border: none;">
                                        <strong style="color: var(--dark-autumn); font-size: 1.1rem;">₱{{ number_format($order->total_amount, 2) }}</strong>
                                    </td>
                                    <td style="padding: 20px 15px; border: none;">
                                        <div style="line-height: 1.4;">
                                            <strong style="color: var(--autumn-dark); font-size: 0.9rem;">{{ $order->ordered_at->format('M d, Y') }}</strong><br>
                                            <small class="text-muted">{{ $order->ordered_at->format('h:i A') }}</small>
                                        </div>
                                    </td>
                                    <td style="padding: 20px 15px; border: none; border-radius: 0 10px 10px 0;">
                                        <button class="btn btn-sm btn-primary" 
                                                onclick="event.stopPropagation(); showStatusModal({{ $order->id }}, '{{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}')"
                                                style="padding: 10px 20px; font-weight: 600; border-radius: 20px; font-size: 0.85rem; background: linear-gradient(135deg, #8b6f47 0%, #6b5635 100%) !important; color: white !important; border: none !important;">
                                            <i class="bi bi-pencil-square me-1"></i>Update Status
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert" style="background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%); border: none; border-radius: 15px; padding: 25px; border-left: 5px solid #2196F3;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle" style="font-size: 2.5rem; color: #2196F3; margin-right: 20px;"></i>
                        <div>
                            <h5 style="color: #1976D2; margin-bottom: 5px; font-weight: 600;">All Caught Up!</h5>
                            <p class="mb-0" style="color: #1565C0;">No pending orders at the moment. Great job!</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Recent Transactions -->
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0" style="color: var(--autumn-secondary); font-weight: 700; font-size: 1.5rem;">
                    <i class="bi bi-receipt me-2"></i>Recent Transactions
                </h4>
                <span class="badge" style="background: linear-gradient(135deg, #E8DDD2 0%, #D4C4B5 100%); color: var(--dark-autumn); padding: 10px 18px; font-size: 1rem; border-radius: 20px; font-weight: 600;">
                    Last {{ $recentTransactions->count() }} Orders
                </span>
            </div>
            
            @if($recentTransactions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" style="border-collapse: separate; border-spacing: 0 10px;">
                        <thead>
                            <tr>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Order #</th>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Customer</th>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Total</th>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Status</th>
                                <th style="padding: 18px 15px; font-size: 0.9rem;">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $transaction)
                                <tr style="background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border-radius: 10px; transition: all 0.3s ease;">
                                    <td style="padding: 20px 15px; border: none; border-radius: 10px 0 0 10px;">
                                        <strong style="color: var(--autumn-primary); font-size: 1.05rem;">#{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}</strong>
                                    </td>
                                    <td style="padding: 20px 15px; border: none;">
                                        <strong style="color: var(--autumn-dark); font-size: 0.95rem;">{{ $transaction->customer ? $transaction->customer->name : 'Walk-in Customer' }}</strong>
                                    </td>
                                    <td style="padding: 20px 15px; border: none;">
                                        <strong style="color: var(--dark-autumn); font-size: 1.05rem;">₱{{ number_format($transaction->total_amount, 2) }}</strong>
                                    </td>
                                    <td style="padding: 20px 15px; border: none;">
                                        @if($transaction->status == 'completed')
                                            <span class="badge" style="background: linear-gradient(135deg, #4CAF50 0%, #45A049 100%); color: white; padding: 8px 16px; font-weight: 600; border-radius: 20px; font-size: 0.85rem;">
                                                <i class="bi bi-check-circle-fill me-1"></i>Completed
                                            </span>
                                        @elseif($transaction->status == 'cancelled')
                                            <span class="badge" style="background: linear-gradient(135deg, #F44336 0%, #E53935 100%); color: white; padding: 8px 16px; font-weight: 600; border-radius: 20px; font-size: 0.85rem;">
                                                <i class="bi bi-x-circle-fill me-1"></i>Cancelled
                                            </span>
                                        @else
                                            <span class="badge" style="background: linear-gradient(135deg, #FFC107 0%, #FFB300 100%); color: white; padding: 8px 16px; font-weight: 600; border-radius: 20px; font-size: 0.85rem;">
                                                <i class="bi bi-clock-fill me-1"></i>Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td style="padding: 20px 15px; border: none; border-radius: 0 10px 10px 0;">
                                        <div style="line-height: 1.4;">
                                            <strong style="color: var(--autumn-dark); font-size: 0.9rem;">{{ $transaction->ordered_at->format('M d, Y') }}</strong><br>
                                            <small class="text-muted">{{ $transaction->ordered_at->format('h:i A') }}</small>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert" style="background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%); border: none; border-radius: 15px; padding: 25px; border-left: 5px solid #2196F3;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle" style="font-size: 2.5rem; color: #2196F3; margin-right: 20px;"></i>
                        <div>
                            <h5 style="color: #1976D2; margin-bottom: 5px; font-weight: 600;">No Transactions Yet</h5>
                            <p class="mb-0" style="color: #1565C0;">Recent transactions will appear here once orders are processed.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Update Status Modal - Enhanced -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
                <form id="statusForm" method="POST">
                    @csrf
                    <div class="modal-header text-white" style="background: linear-gradient(135deg, #8b6f47 0%, #6b5635 100%); border: none; padding: 30px;">
                        <div>
                            <h5 class="modal-title mb-2" style="font-weight: 700; font-size: 1.3rem;">
                                <i class="bi bi-pencil-square me-2"></i>Update Order Status
                            </h5>
                            <p class="mb-0" style="opacity: 0.95; font-size: 0.9rem;">Change the status of this order</p>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="padding: 30px;">
                        <div style="background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%); border-radius: 12px; padding: 20px; margin-bottom: 25px;">
                            <p class="mb-0" style="color: var(--autumn-dark);">
                                <i class="bi bi-person-circle me-2" style="color: var(--autumn-primary);"></i>
                                <strong>Order for:</strong> <span id="customerName" style="color: var(--autumn-secondary); font-weight: 600;"></span>
                            </p>
                        </div>
                        
                        <div class="mb-4">
                            <label for="status" class="form-label" style="font-weight: 600; color: var(--autumn-secondary); font-size: 0.95rem; margin-bottom: 12px;">
                                <i class="bi bi-tag me-1"></i>Select New Status
                            </label>
                            <select class="form-select" id="status" name="status" required style="padding: 14px; border: 2px solid #e0e0e0; border-radius: 12px; font-size: 1rem;">
                                <option value="">-- Choose Status --</option>
                                <option value="completed">✓ Completed</option>
                                <option value="cancelled">✗ Cancelled</option>
                            </select>
                        </div>
                        
                        <div class="alert" style="background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%); border: none; border-radius: 12px; padding: 18px; border-left: 4px solid #FF9800;">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.5rem; color: #F57C00;"></i>
                                <div>
                                    <strong style="color: #E65100; font-size: 0.95rem;">Important Notice</strong>
                                    <p class="mb-0 mt-1" style="color: #EF6C00; font-size: 0.85rem;">This action cannot be undone. Please confirm the status before updating.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="background: var(--warm-cream); border: none; padding: 20px 30px; gap: 10px;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="padding: 12px 30px; border-radius: 25px; font-weight: 600; background: linear-gradient(135deg, #757575 0%, #616161 100%) !important; color: white !important; border: none !important;">
                            <i class="bi bi-x-circle me-1"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" style="padding: 12px 30px; border-radius: 25px; font-weight: 600; background: linear-gradient(135deg, #8b6f47 0%, #6b5635 100%) !important; color: white !important; border: none !important;">
                            <i class="bi bi-check-circle me-1"></i>Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Order Details Modal - Enhanced with Customer-Style UI -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
                <!-- Success-Style Header -->
                <div class="modal-header" style="background: linear-gradient(135deg, #8b6f47 0%, #6b5635 100%); color: white; padding: 35px 30px; border: none;">
                    <div class="w-100 text-center">
                        <div style="font-size: 3rem; margin-bottom: 15px;">
                            <i class="bi bi-receipt-cutoff"></i>
                        </div>
                        <h4 class="modal-title mb-2" style="font-weight: 700;">Order Details</h4>
                        <p class="mb-0" style="opacity: 0.95; font-size: 0.95rem;">
                            Order <span id="modalOrderIdHeader" style="font-weight: 600;"></span>
                        </p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" style="position: absolute; top: 20px; right: 20px;"></button>
                </div>
                
                <div class="modal-body" style="padding: 35px;">
                    <!-- Order Information Card -->
                    <div style="background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 50%, #FFF9F3 100%); border-radius: 15px; padding: 25px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <h5 class="mb-4" style="color: var(--autumn-secondary); font-weight: 700;">
                            <i class="bi bi-info-circle me-2"></i>Order Information
                        </h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div style="padding: 12px 0; border-bottom: 1px solid rgba(139, 111, 71, 0.15);">
                                    <small class="text-muted d-block mb-1">Order Number</small>
                                    <strong id="modalOrderId" style="color: var(--autumn-secondary); font-size: 1.1rem;"></strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="padding: 12px 0; border-bottom: 1px solid rgba(139, 111, 71, 0.15);">
                                    <small class="text-muted d-block mb-1">Status</small>
                                    <span id="modalOrderStatus" class="badge bg-warning" style="padding: 6px 14px; font-size: 0.85rem;"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="padding: 12px 0; border-bottom: 1px solid rgba(139, 111, 71, 0.15);">
                                    <small class="text-muted d-block mb-1">Customer Name</small>
                                    <strong id="modalCustomerName" style="color: var(--autumn-dark);"></strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="padding: 12px 0; border-bottom: 1px solid rgba(139, 111, 71, 0.15);">
                                    <small class="text-muted d-block mb-1">Contact</small>
                                    <strong id="modalCustomerContact" style="color: var(--autumn-dark);"></strong>
                                </div>
                            </div>
                            <div class="col-12">
                                <div style="padding: 12px 0;">
                                    <small class="text-muted d-block mb-1">Order Date & Time</small>
                                    <strong id="modalOrderDate" style="color: var(--autumn-dark);"></strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items Section -->
                    <h5 class="mb-3" style="color: var(--autumn-secondary); font-weight: 700;">
                        <i class="bi bi-basket me-2"></i>Order Summary
                    </h5>
                    
                    <div class="table-responsive" style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <table class="table mb-0" style="border-collapse: separate; border-spacing: 0;">
                            <thead>
                                <tr style="background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);">
                                    <th style="color: white; padding: 15px; font-weight: 600; border: none;">Item</th>
                                    <th style="color: white; padding: 15px; font-weight: 600; border: none;">Price</th>
                                    <th class="text-center" style="color: white; padding: 15px; font-weight: 600; border: none;">Qty</th>
                                    <th class="text-end" style="color: white; padding: 15px; font-weight: 600; border: none;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="modalOrderItems" style="background: white;">
                                <!-- Items will be loaded here -->
                            </tbody>
                            <tfoot>
                                <tr style="background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%);">
                                    <td colspan="3" class="text-end" style="padding: 20px; font-weight: 700; font-size: 1.15rem; color: var(--autumn-secondary); border: none;">
                                        TOTAL AMOUNT:
                                    </td>
                                    <td class="text-end" style="padding: 20px; font-weight: 700; font-size: 1.3rem; border: none;">
                                        <span id="modalTotalAmount" style="color: var(--autumn-primary);"></span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <div class="modal-footer" style="background: var(--warm-cream); border: none; padding: 25px 35px; gap: 10px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 25px; padding: 12px 30px; font-weight: 600; background: linear-gradient(135deg, #757575 0%, #616161 100%) !important; color: white !important; border: none !important;">
                        <i class="bi bi-x-circle me-1"></i>Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showStatusModalFromDetails()" style="border-radius: 25px; padding: 12px 30px; font-weight: 600; background: linear-gradient(135deg, #8b6f47 0%, #6b5635 100%) !important; color: white !important; border: none !important;">
                        <i class="bi bi-pencil-square me-1"></i>Update Status
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @include('components.modals')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Universal Modal Cleanup
        document.addEventListener('DOMContentLoaded', function() {
            function cleanupModals() {
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            }
            
            document.querySelectorAll('.modal').forEach(function(modalElement) {
                modalElement.addEventListener('hidden.bs.modal', function () {
                    setTimeout(cleanupModals, 100);
                });
            });
        });

        // Show modals
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('successModal'));
                modal.show();
            });
        @endif

        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('errorModal'));
                modal.show();
            });
        @endif
    </script>
    <script>
        // Store current order ID for status update
        let currentOrderId = null;
        let currentCustomerName = null;

        // Show order details modal
        function showOrderDetails(orderId) {
            // Find the order data from the pending orders
            const orderData = @json($pendingOrders);
            const order = orderData.find(o => o.id === orderId);
            
            if (!order) return;
            
            // Store for later use
            currentOrderId = orderId;
            currentCustomerName = order.customer ? order.customer.name : 'Walk-in Customer';
            
            // Populate modal - Header
            document.getElementById('modalOrderIdHeader').textContent = '#' + String(order.id).padStart(4, '0');
            
            // Populate modal - Order Info
            document.getElementById('modalOrderId').textContent = '#' + String(order.id).padStart(4, '0');
            document.getElementById('modalCustomerName').textContent = currentCustomerName;
            
            // Customer contact
            const contact = order.customer ? (order.customer.phone || order.customer.email || 'N/A') : 'N/A';
            document.getElementById('modalCustomerContact').textContent = contact;
            
            // Status badge
            const statusBadge = document.getElementById('modalOrderStatus');
            statusBadge.textContent = 'Pending';
            statusBadge.className = 'badge bg-warning';
            statusBadge.style.cssText = 'padding: 6px 14px; font-size: 0.85rem;';
            
            // Format date
            const orderDate = new Date(order.ordered_at);
            document.getElementById('modalOrderDate').textContent = orderDate.toLocaleString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
            
            // Populate items table
            const itemsContainer = document.getElementById('modalOrderItems');
            itemsContainer.innerHTML = '';
            
            order.items.forEach(item => {
                const subtotal = item.quantity * item.price;
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td style="padding: 15px; border-bottom: 1px solid #f0f0f0; font-weight: 500; color: var(--autumn-dark);">${item.menu_item.name}</td>
                    <td style="padding: 15px; border-bottom: 1px solid #f0f0f0; color: var(--autumn-dark);">₱${parseFloat(item.price).toFixed(2)}</td>
                    <td class="text-center" style="padding: 15px; border-bottom: 1px solid #f0f0f0;">
                        <span style="background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%); color: var(--autumn-primary); padding: 5px 12px; border-radius: 15px; font-weight: 600;">${item.quantity}</span>
                    </td>
                    <td class="text-end" style="padding: 15px; border-bottom: 1px solid #f0f0f0; font-weight: 600; color: var(--dark-autumn);">₱${subtotal.toFixed(2)}</td>
                `;
                itemsContainer.appendChild(row);
            });
            
            // Total amount
            document.getElementById('modalTotalAmount').textContent = '₱' + parseFloat(order.total_amount).toFixed(2);
            
            // Show modal
            const orderModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
            orderModal.show();
        }

        // Show status modal from order details modal
        function showStatusModalFromDetails() {
            // Close order details modal
            const orderModal = bootstrap.Modal.getInstance(document.getElementById('orderDetailsModal'));
            if (orderModal) {
                orderModal.hide();
            }
            
            // Show status modal after a brief delay
            setTimeout(() => {
                showStatusModal(currentOrderId, currentCustomerName);
            }, 300);
        }

        function showStatusModal(orderId, customerName) {
            currentOrderId = orderId;
            currentCustomerName = customerName;
            document.getElementById('customerName').textContent = customerName;
            document.getElementById('statusForm').action = `/cashier/order/${orderId}/status`;
            const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
            statusModal.show();
        }

        @if(session('success'))
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif

        // Clean up modal backdrops
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function () {
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        });

        // Auto-refresh every 10 seconds for smooth user experience
        let autoRefreshTimer;
        function startAutoRefresh() {
            autoRefreshTimer = setTimeout(function() {
                // Only refresh if no modal is open
                if (!document.querySelector('.modal.show')) {
                    window.location.reload();
                } else {
                    // Try again in 5 seconds if modal is open
                    clearTimeout(autoRefreshTimer);
                    autoRefreshTimer = setTimeout(function() {
                        if (!document.querySelector('.modal.show')) {
                            window.location.reload();
                        } else {
                            startAutoRefresh();
                        }
                    }, 5000);
                }
            }, 10000); // 10 seconds
        }
        
        startAutoRefresh();

        // Enhanced interactivity - Ripple effects on buttons
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-primary, .btn-success, .btn-secondary');
            
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s ease-out';
                    ripple.style.pointerEvents = 'none';
                    
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                });
            });

            // Add ripple animation
            if (!document.getElementById('ripple-animation')) {
                const style = document.createElement('style');
                style.id = 'ripple-animation';
                style.textContent = `
                    @keyframes ripple {
                        to {
                            transform: scale(2);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(style);
            }

            // Scroll-triggered animations for table rows
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.animation = 'fadeInUp 0.5s ease-out forwards';
                            entry.target.style.opacity = '1';
                        }, index * 50);
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.table tbody tr').forEach(row => {
                row.style.opacity = '0';
                observer.observe(row);
            });

            // 3D tilt effect for stat cards
            const statCards = document.querySelectorAll('.stats-card');
            statCards.forEach(card => {
                card.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = (y - centerY) / 10;
                    const rotateY = (centerX - x) / 10;
                    
                    this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px) scale(1.02)`;
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0) scale(1)';
                });
            });
        });
    </script>
@endsection
