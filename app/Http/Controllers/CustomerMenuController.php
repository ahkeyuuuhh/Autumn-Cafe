<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerMenuController extends Controller
{
    /**
     * Display menu items for customers
     */
    public function index(Request $request)
    {
        $query = MenuItem::where('stock', '>', 0);
        
        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        // Category filter
        if ($request->has('category') && $request->category != '' && $request->category != 'all') {
            $query->where('category', $request->category);
        }
        
        $menuItems = $query->orderBy('category')
            ->orderBy('name')
            ->get()
            ->groupBy('category');
        
        // Get all unique categories for the filter
        $categories = MenuItem::where('stock', '>', 0)
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();
            
        return view('customer.menu.index', compact('menuItems', 'categories'));
    }

    /**
     * Show cart/order form
     */
    public function showCart()
    {
        // Get cart from session
        $cart = session()->get('cart', []);
        
        // Calculate totals
        $subtotal = 0;
        $cartItems = [];
        
        foreach ($cart as $itemId => $quantity) {
            $menuItem = MenuItem::find($itemId);
            if ($menuItem && $menuItem->stock >= $quantity) {
                $cartItems[] = [
                    'item' => $menuItem,
                    'quantity' => $quantity,
                    'subtotal' => $menuItem->price * $quantity
                ];
                $subtotal += $menuItem->price * $quantity;
            }
        }
        
        return view('customer.cart.index', compact('cartItems', 'subtotal'));
    }

    /**
     * Add item to cart
     */
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menuItem = MenuItem::findOrFail($validated['menu_item_id']);
        
        // Check stock
        if ($menuItem->stock < $validated['quantity']) {
            return back()->with('error', 'Insufficient stock for ' . $menuItem->name);
        }

        // Get current cart
        $cart = session()->get('cart', []);
        
        // Add or update item in cart
        if (isset($cart[$menuItem->id])) {
            $newQuantity = $cart[$menuItem->id] + $validated['quantity'];
            if ($newQuantity > $menuItem->stock) {
                return back()->with('error', 'Cannot add more than available stock');
            }
            $cart[$menuItem->id] = $newQuantity;
        } else {
            $cart[$menuItem->id] = $validated['quantity'];
        }

        session()->put('cart', $cart);

        return back()->with('success', $menuItem->name . ' added to cart!');
    }

    /**
     * Update cart item quantity
     */
    public function updateCart(Request $request)
    {
        $validated = $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);
        $menuItem = MenuItem::findOrFail($validated['menu_item_id']);

        if ($validated['quantity'] == 0) {
            unset($cart[$validated['menu_item_id']]);
        } else {
            if ($validated['quantity'] > $menuItem->stock) {
                return back()->with('error', 'Quantity exceeds available stock');
            }
            $cart[$validated['menu_item_id']] = $validated['quantity'];
        }

        session()->put('cart', $cart);

        return back()->with('cart_updated', 'Cart updated successfully');
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart($menuItemId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$menuItemId]);
        session()->put('cart', $cart);

        return back()->with('cart_updated', 'Item removed from cart');
    }

    /**
     * Clear entire cart
     */
    public function clearCart()
    {
        session()->forget('cart');
        return back()->with('cart_updated', 'Cart cleared successfully');
    }

    /**
     * Process order/checkout
     */
    public function checkout(Request $request)
    {
        // Check if customer is logged in
        if (!session()->has('customer_id')) {
            return redirect()->route('customer.login')
                ->with('error', 'Please login to place an order');
        }

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('customer.menu')
                ->with('error', 'Your cart is empty');
        }

        DB::beginTransaction();
        
        try {
            $totalAmount = 0;
            $orderItems = [];
            
            // Validate and calculate
            foreach ($cart as $itemId => $quantity) {
                $menuItem = MenuItem::findOrFail($itemId);
                
                if ($menuItem->stock < $quantity) {
                    DB::rollBack();
                    return back()->with('error', "Insufficient stock for {$menuItem->name}");
                }
                
                $subtotal = $menuItem->price * $quantity;
                $totalAmount += $subtotal;
                
                $orderItems[] = [
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $quantity,
                    'unit_price' => $menuItem->price,
                    'subtotal' => $subtotal,
                ];
            }
            
            // Create order
            $order = Order::create([
                'customer_id' => session('customer_id'),
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
            
            // Clear cart
            session()->forget('cart');
            
            return redirect()->route('customer.order.confirmation', $order->id)
                ->with('success', 'Order placed successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to process order: ' . $e->getMessage());
        }
    }

    /**
     * Show order confirmation
     */
    public function orderConfirmation($orderId)
    {
        $order = Order::with(['customer', 'items.menuItem'])
            ->where('id', $orderId)
            ->where('customer_id', session('customer_id'))
            ->firstOrFail();
            
        return view('customer.order.confirmation', compact('order'));
    }
}
