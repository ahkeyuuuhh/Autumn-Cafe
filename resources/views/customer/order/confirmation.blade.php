<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Autumn Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --autumn-orange: #E67E22;
            --autumn-cream: #FFF9F3;
            --autumn-brown: #3B2F2F;
            --autumn-light-orange: #F39C12;
        }
        
        body {
            background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 40px 0;
        }
        
        .confirmation-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            overflow: hidden;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .success-header {
            background: linear-gradient(135deg, #27AE60 0%, #229954 100%);
            color: white;
            padding: 50px 30px;
            text-align: center;
        }
        
        .success-icon {
            font-size: 5rem;
            margin-bottom: 20px;
            animation: scaleIn 0.5s ease-in-out;
        }
        
        @keyframes scaleIn {
            from { transform: scale(0); }
            to { transform: scale(1); }
        }
        
        .confirmation-body {
            padding: 40px;
        }
        
        .order-info {
            background: var(--autumn-cream);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .order-items-table {
            margin-bottom: 30px;
        }
        
        .order-items-table table {
            width: 100%;
        }
        
        .order-items-table th {
            background: var(--autumn-orange);
            color: white;
            padding: 15px;
            font-weight: 600;
        }
        
        .order-items-table td {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .total-row {
            background: linear-gradient(135deg, var(--autumn-cream) 0%, #FFE8D6 100%);
            font-weight: bold;
            font-size: 1.3rem;
        }
        
        .total-row td {
            color: var(--autumn-orange);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            border: none;
            padding: 15px 40px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(230, 126, 34, 0.4);
        }
        
        .btn-outline-primary {
            color: var(--autumn-orange);
            border: 2px solid var(--autumn-orange);
            padding: 15px 40px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-outline-primary:hover {
            background: var(--autumn-orange);
            border-color: var(--autumn-orange);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="confirmation-card">
            <div class="success-header">
                <div class="success-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h1 class="mb-3">Order Confirmed!</h1>
                <p class="mb-0">Thank you for your order, {{ $order->customer->name }}!</p>
            </div>
            
            <div class="confirmation-body">
                <!-- Order Information -->
                <div class="order-info">
                    <h4 class="mb-3" style="color: var(--autumn-brown);">
                        <i class="bi bi-info-circle"></i> Order Information
                    </h4>
                    
                    <div class="info-row">
                        <span class="text-muted">Order Number:</span>
                        <span class="fw-bold">#{{ $order->id }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="text-muted">Order Date & Time:</span>
                        <span class="fw-bold">{{ $order->ordered_at->format('F d, Y \a\t h:i A') }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="text-muted">Status:</span>
                        <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="text-muted">Customer Name:</span>
                        <span class="fw-bold">{{ $order->customer->name }}</span>
                    </div>
                    
                    @if($order->customer->phone)
                        <div class="info-row">
                            <span class="text-muted">Phone:</span>
                            <span class="fw-bold">{{ $order->customer->phone }}</span>
                        </div>
                    @endif
                    
                    @if($order->customer->email)
                        <div class="info-row">
                            <span class="text-muted">Email:</span>
                            <span class="fw-bold">{{ $order->customer->email }}</span>
                        </div>
                    @endif
                </div>

                <!-- Order Items -->
                <h4 class="mb-3" style="color: var(--autumn-brown);">
                    <i class="bi bi-basket"></i> Order Summary
                </h4>
                
                <div class="order-items-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->menuItem->name }}</td>
                                    <td>₱{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">₱{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="total-row">
                                <td colspan="3" class="text-end"><strong>TOTAL AMOUNT:</strong></td>
                                <td class="text-end"><strong>₱{{ number_format($order->total_amount, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Important Notice -->
                <div class="alert alert-info" style="border-radius: 15px; border: none;">
                    <h5><i class="bi bi-info-circle-fill"></i> What's Next?</h5>
                    <ul class="mb-0">
                        <li>Your order has been received and is being prepared</li>
                        <li>Please proceed to the counter to complete your payment</li>
                        <li>Show your order number <strong>#{{ $order->id }}</strong> to the staff</li>
                        <li>Your order will be ready shortly!</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-4">
                    <a href="{{ route('customer.menu') }}" class="btn btn-primary">
                        <i class="bi bi-house"></i> Back to Menu
                    </a>
                    <button onclick="window.print()" class="btn btn-outline-primary">
                        <i class="bi bi-printer"></i> Print Receipt
                    </button>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <p class="text-muted">
                🍂 Thank you for choosing Autumn Café! 🍂
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
