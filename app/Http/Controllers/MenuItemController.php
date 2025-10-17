<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuItems = MenuItem::orderBy('category')->orderBy('name')->get();
        return view('menu.index', compact('menuItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu-items', 'public');
        }
        
        MenuItem::create($validated);
        
        return redirect()->route('menu.index')->with('success', 'Menu item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menu)
    {
        return view('menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        // Update slug only if name changed
        if ($menu->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menu->image && \Storage::disk('public')->exists($menu->image)) {
                \Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $request->file('image')->store('menu-items', 'public');
        }
        
        $menu->update($validated);
        
        return redirect()->route('menu.index')->with('success', 'Menu item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menu)
    {
        try {
            // Check if menu item has any orders
            if ($menu->orderItems()->count() > 0) {
                return redirect()->route('menu.index')
                    ->with('error', 'Cannot delete this menu item because it has existing orders. Consider marking it as out of stock instead.');
            }
            
            // Delete image if exists
            if ($menu->image && \Storage::disk('public')->exists($menu->image)) {
                \Storage::disk('public')->delete($menu->image);
            }
            
            $menu->delete();
            return redirect()->route('menu.index')
                ->with('success', 'Menu item deleted successfully.');
                
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle foreign key constraint error
            return redirect()->route('menu.index')
                ->with('error', 'Cannot delete this menu item because it is referenced in existing orders.');
        } catch (\Exception $e) {
            return redirect()->route('menu.index')
                ->with('error', 'Failed to delete menu item: ' . $e->getMessage());
        }
    }
}
