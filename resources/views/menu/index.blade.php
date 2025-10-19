@extends('layouts.app')

@section('content')
<style>
     :root {
      /* Monochromatic Brown Palette */
      --brown-50: #faf8f6;
      --brown-100: #f5f0eb;
      --brown-200: #e8ddd2;
      --brown-300: #d4c4b5;
      --brown-400: #b8a08a;
      --brown-500: #8b6f47;
      --brown-600: #6b5635;
      --brown-700: #4a3d28;
      --brown-800: #352b1d;
      --brown-900: #1f1710;
      
      /* Semantic naming */
      --beige: #d4c4b5;
      --pale-autumn: #b8a08a;
      --autumn-primary: #8b6f47;
      --dark-autumn: #6b5635;
      --green-brown: #6b5635;
      --dark-brown: #352b1d;
      --light: #faf8f6;
      --light-beige: #f5f0eb;
      --soft-apricot: #e8ddd2;
      --dusty-rose: #d4c4b5;
      --light-coral: #b8a08a;
      --warm-cream: #faf8f6;
    }
    .category-tabs {
        border-bottom: 3px solid #e9ecef;
        margin-bottom: 30px;
    }
    .card {
        background-color: var(--light);
        border-radius: 20px !important;
        border-top: 10px solid var(--soft-apricot) !important;
    }
    .category-tab {
        padding: 15px 25px;
        background: transparent;
        border: none;
        color: var(--soft-apricot);
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        position: relative;
        cursor: pointer;
        margin-right: 10px;
    }
    
    .category-tab:hover {
        color: var(--autumn-primary);
        background: rgba(210, 105, 30, 0.05);
    }
    
    .category-tab.active {
        color: var(--autumn-primary);
        background: transparent;
    }
    
    .category-tab.active::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
    }
    
    .category-tab .badge {
        margin-left: 8px;
        background: rgba(210, 105, 30, 0.1);
        color: var(--pale-autumn);
        padding: 4px 8px;
        font-size: 0.75rem;
    }
    
    .category-tab.active .badge {
        background: var(--pale-autumn);
        color: white;
    }
    
    .category-content {
        display: none;
    }
    
    .category-content.active {
        display: block;
    }
    
    .empty-category {
        text-align: center;
        padding: 60px 20px;
        color: var(--dusty-rose);
    }
    
    .empty-category i {
        font-size: 4rem;
        opacity: 0.3;
        margin-bottom: 20px;
    }
    th {
        color: var(--pale-autumn) !important;
    }
    .modal-body, .modal-footer, .modal-header {
        background-color: var(--warm-cream) !important;
    }
    .modal-header {
        color: var(--autumn-primary) !important;
    }
    .header {
        color: var(--dark-autumn) !important;
    }
    .add-menu-btn {
        background-color: var(--pale-autumn) !important;
        border-radius: 20px;
        padding: 10px 20px;
    }
    .add-menu-btn:hover {
        background-color: var(--autumn-primary) !important;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary header">Menu Management</h1>
        <a href="{{ route('menu.create') }}" class="btn btn-primary add-menu-btn">
            <i class="bi bi-plus-circle"></i> Add New Item
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($menuItems->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted">No menu items yet. Click "Add New Item" to create one.</p>
                </div>
            @else
                <!-- Category Tabs -->
                <div class="category-tabs d-flex flex-wrap">
                    <button class="category-tab active" data-category="all">
                        All Items
                        <span class="badge">{{ $menuItems->count() }}</span>
                    </button>
                    <button class="category-tab" data-category="Coffee">
                        <i class="bi bi-cup-hot-fill"></i> Coffee
                        <span class="badge">{{ $menuItems->where('category', 'Coffee')->count() }}</span>
                    </button>
                    <button class="category-tab" data-category="Tea">
                        <i class="bi bi-cup-straw"></i> Tea
                        <span class="badge">{{ $menuItems->where('category', 'Tea')->count() }}</span>
                    </button>
                    <button class="category-tab" data-category="Pastries">
                        <i class="bi bi-egg-fried"></i> Pastries
                        <span class="badge">{{ $menuItems->where('category', 'Pastries')->count() }}</span>
                    </button>
                    <button class="category-tab" data-category="Sandwiches">
                        <i class="bi bi-grid-3x3-gap-fill"></i> Sandwiches
                        <span class="badge">{{ $menuItems->where('category', 'Sandwiches')->count() }}</span>
                    </button>
                    <button class="category-tab" data-category="Desserts">
                        <i class="bi bi-cake2"></i> Desserts
                        <span class="badge">{{ $menuItems->where('category', 'Desserts')->count() }}</span>
                    </button>
                    <button class="category-tab" data-category="Beverages">
                        <i class="bi bi-droplet-fill"></i> Beverages
                        <span class="badge">{{ $menuItems->where('category', 'Beverages')->count() }}</span>
                    </button>
                    <button class="category-tab" data-category="Other">
                        <i class="bi bi-three-dots"></i> Other
                        <span class="badge">{{ $menuItems->where('category', 'Other')->count() }}</span>
                    </button>
                </div>

                <!-- All Items Tab Content -->
                <div class="category-content active" data-category-content="all">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menuItems as $item)
                                <tr>
                                    <td>
                                        <img src="{{ $item->image_url }}" 
                                             alt="{{ $item->name }}" 
                                             class="img-thumbnail" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td class="fw-semibold">{{ $item->name }}</td>
                                    <td>
                                        @if($item->category)
                                            <span class="badge bg-secondary">{{ $item->category }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>{{ Str::limit($item->description, 50) }}</small>
                                    </td>
                                    <td class="text-success fw-semibold">₱{{ number_format($item->price, 2) }}</td>
                                    <td>
                                        @if($item->stock > 0)
                                            <span class="badge bg-success">{{ $item->stock }}</span>
                                        @else
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('menu.edit', $item) }}" class="btn btn-outline-primary" title="Edit">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}" title="Delete">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </div>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content delete-modal-content">
                                                    <div class="modal-header bg-warning text-dark">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">
                                                            <i class="bi bi-exclamation-triangle-fill"></i> Confirm Delete
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: var(--dark-autumn);">Are you sure you want to delete <strong>{{ $item->name }}</strong>?</p>
                                                        
                                                        @if($item->orderItems()->count() > 0)
                                                            <div class="alert alert-warning mb-0">
                                                                <i class="bi bi-exclamation-triangle-fill"></i>
                                                                <strong>Warning:</strong> This item has {{ $item->orderItems()->count() }} order(s) and cannot be deleted.
                                                                Consider setting stock to 0 instead.
                                                            </div>
                                                        @else
                                                            <p class="text-muted mb-0">This action cannot be undone.</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        @if($item->orderItems()->count() > 0)
                                                            <button type="button" class="btn btn-danger" disabled title="Cannot delete - has orders">
                                                                <i class="bi bi-lock"></i> Cannot Delete
                                                            </button>
                                                        @else
                                                            <form action="{{ route('menu.destroy', $item) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="bi bi-trash"></i> Delete
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Category-specific Tab Contents -->
                @foreach(['Coffee', 'Tea', 'Pastries', 'Sandwiches', 'Desserts', 'Beverages', 'Other'] as $category)
                    <div class="category-content" data-category-content="{{ $category }}">
                        @php
                            $categoryItems = $menuItems->where('category', $category);
                        @endphp
                        
                        @if($categoryItems->isEmpty())
                            <div class="empty-category">
                                <i class="bi bi-inbox"></i>
                                <h5>No {{ $category }} items yet</h5>
                                <p class="text-muted">Add your first {{ strtolower($category) }} item to get started.</p>
                                <a href="{{ route('menu.create') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-plus-circle"></i> Add {{ $category }} Item
                                </a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categoryItems as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ $item->image_url }}" 
                                                         alt="{{ $item->name }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                </td>
                                                <td class="fw-semibold">{{ $item->name }}</td>
                                                <td>
                                                    <small>{{ Str::limit($item->description, 50) }}</small>
                                                </td>
                                                <td class="text-success fw-semibold">₱{{ number_format($item->price, 2) }}</td>
                                                <td>
                                                    @if($item->stock > 0)
                                                        <span class="badge bg-success">{{ $item->stock }}</span>
                                                    @else
                                                        <span class="badge bg-danger">Out of Stock</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('menu.edit', $item) }}" class="btn btn-outline-primary" title="Edit">
                                                            <i class="bi bi-pencil"></i> Edit
                                                        </a>
                                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}" title="Delete">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="mt-3">
        <small class="text-muted">Total Items: {{ $menuItems->count() }}</small>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Category Tab Switching
        const categoryTabs = document.querySelectorAll('.category-tab');
        const categoryContents = document.querySelectorAll('.category-content');
        
        categoryTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                
                // Remove active class from all tabs and contents
                categoryTabs.forEach(t => t.classList.remove('active'));
                categoryContents.forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Show corresponding content
                const targetContent = document.querySelector(`[data-category-content="${category}"]`);
                if (targetContent) {
                    targetContent.classList.add('active');
                }
            });
        });
    });
</script>

@endsection
