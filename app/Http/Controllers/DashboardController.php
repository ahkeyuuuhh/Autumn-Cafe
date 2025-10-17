<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get today's date
        $today = Carbon::today();
        
        // Statistics
        $stats = [
            // Today's orders
            'orders_today' => Order::whereDate('created_at', $today)->count(),
            
            // Today's sales
            'sales_today' => Order::whereDate('created_at', $today)->sum('total_amount'),
            
            // Total orders (all time)
            'total_orders' => Order::count(),
            
            // Total sales (all time)
            'total_sales' => Order::sum('total_amount'),
            
            // Total customers
            'total_customers' => Customer::count(),
            
            // Total menu items
            'total_menu_items' => MenuItem::count(),
            
            // Low stock items (stock <= 5)
            'low_stock_items' => MenuItem::where('stock', '<=', 5)->count(),
            
            // Recent orders (last 5)
            'recent_orders' => Order::with('customer')
                ->latest()
                ->take(5)
                ->get(),
            
            // Top selling items (this week)
            'top_items' => MenuItem::withCount(['orderItems' => function($query) {
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }])
            ->orderByDesc('order_items_count')
            ->take(5)
            ->get(),
        ];
        
        return view('dashboard', compact('stats'));
    }
}
