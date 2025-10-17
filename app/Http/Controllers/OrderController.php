<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index()
    {
        $orders = Order::with(['customer', 'items'])
            ->latest('ordered_at')
            ->paginate(15);
            
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $menuItems = MenuItem::where('stock', '>', 0)
            ->orderBy('category')
            ->orderBy('name')
            ->get();
            
        return view('orders.create', compact('customers', 'menuItems'));
    }

    /**
     * Store a newly created order
     */
    public function store(Request $request)
    {
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
            
            return redirect()->route('orders.show', $order)
                ->with('success', 'Order created successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'items.menuItem']);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order
     */
    public function edit(Order $order)
    {
        $customers = Customer::orderBy('name')->get();
        $menuItems = MenuItem::orderBy('category')->orderBy('name')->get();
        $order->load(['customer', 'items.menuItem']);
        
        return view('orders.edit', compact('order', 'customers', 'menuItems'));
    }

    /**
     * Update the specified order
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,completed,cancelled',
        ]);

        $order->update($validated);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order status updated successfully!');
    }

    /**
     * Remove the specified order
     */
    public function destroy(Order $order)
    {
        // Restore stock before deleting
        foreach ($order->items as $item) {
            $menuItem = MenuItem::find($item->menu_item_id);
            if ($menuItem) {
                $menuItem->increment('stock', $item->quantity);
            }
        }
        
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
