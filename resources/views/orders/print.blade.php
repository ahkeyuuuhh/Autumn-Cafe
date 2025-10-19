<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} - Print Receipt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .receipt {
            border: 2px solid #333;
            padding: 30px;
        }

        .header {
            text-align: center;
            border-bottom: 2px dashed #333;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 14px;
            line-height: 1.6;
        }

        .order-info {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px dashed #333;
        }

        .order-info table {
            width: 100%;
            font-size: 14px;
        }

        .order-info td {
            padding: 5px 0;
        }

        .order-info td:first-child {
            font-weight: bold;
            width: 150px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th {
            background: #333;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        .items-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .items-table .text-center {
            text-align: center;
        }

        .items-table .text-end {
            text-align: right;
        }

        .total-row {
            background: #f5f5f5;
            font-weight: bold;
            border-top: 2px solid #333;
        }

        .total-row td {
            padding: 15px 12px !important;
            font-size: 16px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px dashed #333;
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 12px;
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

        @media print {
            body {
                padding: 0;
            }

            .receipt {
                border: none;
            }

            @page {
                margin: 1cm;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <!-- Header -->
        <div class="header">
            <h1>🍂 AUTUMN CAFÉ 🍂</h1>
            <p>
                123 Coffee Street, Bean City<br>
                Phone: (123) 456-7890<br>
                Email: info@autumncafe.com
            </p>
        </div>

        <!-- Order Information -->
        <div class="order-info">
            <table>
                <tr>
                    <td>Order ID:</td>
                    <td>#{{ $order->id }}</td>
                </tr>
                <tr>
                    <td>Date & Time:</td>
                    <td>{{ $order->ordered_at->format('M d, Y - h:i A') }}</td>
                </tr>
                <tr>
                    <td>Customer:</td>
                    <td>
                        @if($order->customer)
                            {{ $order->customer->name }}<br>
                            {{ $order->customer->email }}<br>
                            {{ $order->customer->phone }}
                        @else
                            Walk-in Customer
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <span class="status-badge status-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Order Items -->
        <table class="items-table">
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
                        <td>
                            <strong>{{ $item->menuItem->name ?? 'Item Deleted' }}</strong>
                            @if($item->menuItem)
                                <br><small>{{ $item->menuItem->category }}</small>
                            @endif
                        </td>
                        <td>₱{{ number_format($item->unit_price, 2) }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-end">₱{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3">TOTAL AMOUNT</td>
                    <td class="text-end">₱{{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>
                <strong>Thank you for your order!</strong><br>
                Please visit us again soon.<br>
                <br>
                <em>This is a computer-generated receipt.</em>
            </p>
        </div>
    </div>

    <script>
        // Auto-print when page loads
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
