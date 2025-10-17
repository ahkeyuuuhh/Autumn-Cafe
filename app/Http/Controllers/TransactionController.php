<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of all transactions (orders)
     */
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'items']);

        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search by order ID or customer name
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // If search is numeric, search by ID
                if (is_numeric($search)) {
                    $q->where('id', $search);
                }
                // Always search by customer name
                $q->orWhereHas('customer', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            });
        }

        // Sort by date (newest first by default)
        $sortBy = $request->get('sort', 'desc');
        $orders = $query->orderBy('ordered_at', $sortBy)
                       ->paginate(20);

        // Get statistics
        $stats = [
            'total_orders' => Order::count(),
            'total_revenue' => Order::sum('total_amount'),
            'pending' => Order::where('status', 'pending')->count(),
            'paid' => Order::where('status', 'paid')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('transactions.index', compact('orders', 'stats'));
    }

    /**
     * Display the specified transaction (order details)
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'items.menuItem']);
        
        return view('transactions.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()
            ->with('success', 'Order status updated to ' . ucfirst($request->status));
    }
}
