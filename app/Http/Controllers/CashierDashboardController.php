<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CashierDashboardController extends Controller
{
    public function index()
    {
        // Check if cashier is logged in
        if (!session('cashier_id')) {
            return redirect()->route('cashier.login');
        }

        // Get pending orders
        $pendingOrders = Order::with(['customer', 'items.menuItem'])
            ->where('status', 'pending')
            ->orderBy('ordered_at', 'desc')
            ->get();

        // Get recent transactions (last 20 orders)
        $recentTransactions = Order::with(['customer'])
            ->whereIn('status', ['paid', 'completed'])
            ->orderBy('ordered_at', 'desc')
            ->limit(20)
            ->get();

        // Calculate stats
        $stats = [
            'pending_count' => $pendingOrders->count(),
            'today_revenue' => Order::whereDate('ordered_at', today())
                ->whereIn('status', ['paid', 'completed'])
                ->sum('total_amount'),
            'today_completed' => Order::whereDate('ordered_at', today())
                ->where('status', 'completed')
                ->count(),
        ];

        return view('cashier.dashboard', compact('pendingOrders', 'recentTransactions', 'stats'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        // Check if cashier is logged in
        if (!session('cashier_id')) {
            return redirect()->route('cashier.login');
        }

        $request->validate([
            'status' => 'required|in:paid,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        return back()->with('success', "Order #{$order->id} status updated from {$oldStatus} to {$request->status}.");
    }
}
