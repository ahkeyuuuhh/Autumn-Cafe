<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function createOrder()
    {
        // Check if cashier is logged in
        if (!session('cashier_id')) {
            return redirect()->route('cashier.login');
        }

        $customers = Customer::orderBy('name')->get();
        $menuItems = MenuItem::where('stock', '>', 0)
            ->orderBy('category')
            ->orderBy('name')
            ->get();
            
        return view('cashier.create-order', compact('customers', 'menuItems'));
    }

    public function storeOrder(Request $request)
    {
        // Check if cashier is logged in
        if (!session('cashier_id')) {
            return redirect()->route('cashier.login');
        }

        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'items' => 'required|array|min:1',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        
        try {
            // Calculate total
            $totalAmount = 0;
            $orderItems = [];
            
            foreach ($validated['items'] as $item) {
                $menuItem = MenuItem::findOrFail($item['menu_item_id']);
                
                // Check stock
                if ($menuItem->stock < $item['quantity']) {
                    DB::rollBack();
                    return back()->with('error', "Insufficient stock for {$menuItem->name}. Available: {$menuItem->stock}");
                }
                
                $subtotal = $menuItem->price * $item['quantity'];
                $totalAmount += $subtotal;
                
                $orderItems[] = [
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $menuItem->price,
                    'subtotal' => $subtotal,
                ];
            }
            
            // Create order
            $order = Order::create([
                'customer_id' => $validated['customer_id'],
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'ordered_at' => now(),
            ]);
            
            // Create order items and update stock
            foreach ($orderItems as $orderItem) {
                $order->items()->create($orderItem);
                
                $menuItem = MenuItem::find($orderItem['menu_item_id']);
                $menuItem->decrement('stock', $orderItem['quantity']);
            }
            
            DB::commit();
            
            return redirect()->route('cashier.dashboard')
                ->with('success', "Order #{$order->id} created successfully!");
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }
}
