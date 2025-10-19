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

    body {
        background-color: var(--brown-300);
    }

    .menu-header {
        background: var(--warm-cream);
        padding: 2rem;
        border-radius: 20px;
        border: 3px dashed var(--beige);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .menu-header::before {
        content: '☕';
        position: absolute;
        font-size: 6rem;
        opacity: 0.1;
        right: -1rem;
        top: -1rem;
    }

    .menu-header h1 {
        color: var(--dark-autumn);
        font-weight: 700;
        margin: 0;
        font-size: 2rem;
    }

    .menu-header .lead {
        color: var(--pale-autumn);
        margin: 0.5rem 0 0 0;
        font-size: 1rem;
    }

    .card {
        background-color: var(--light);
        border-radius: 20px !important;
        border: none;
        border-top: 8px solid var(--dusty-rose) !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05),
                    0 10px 20px rgba(0, 0, 0, 0.05),
                    0 15px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    th {
        color: var(--pale-autumn) !important;
    }

    .btn-add-menu {
        background: linear-gradient(135deg, var(--pale-autumn) 0%, var(--autumn-primary) 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add-menu:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(188, 82, 39, 0.3);
        color: white;
    }

    .btn-edit {
        background: var(--soft-apricot);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background: var(--pale-autumn);
        transform: scale(1.05);
        color: white;
    }

    .btn-delete {
        background: #e7b7a1;
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background: #d98b4c;
        transform: scale(1.05);
        color: white;
    }

    /* Tabs */
    .category-tabs {
        border-bottom: 3px solid #e9ecef;
        margin-bottom: 30px;
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
        color: var(--brown-400);
        background: rgba(210, 105, 30, 0.05);
    }

    .category-tab.active {
        color: var(--brown-500);
    }

    .category-tab.active::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--autumn-primary), var(--pale-autumn));
        border-radius: 3px;
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

    /* MODAL STYLES */
    .modal-content.delete-modal-content {
        background-color: var(--warm-cream) !important;
        border-radius: 20px !important;
        border: none !important;
        box-shadow: 0 6px 20px rgba(0,0,0,0.25);
        overflow: hidden;
        animation: fadeInUp 0.3s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        background: linear-gradient(90deg, var(--soft-apricot), var(--pale-autumn)) !important;
        color: var(--dark-brown) !important;
        border-bottom: none !important;
        padding: 1rem 1.5rem;
    }

    .modal-title i {
        margin-right: 6px;
    }

    .modal-body {
        background-color: var(--warm-cream) !important;
        color: var(--dark-autumn);
        padding: 1.5rem;
    }

    .modal-body p {
        font-size: 1rem;
    }

    .modal-body .alert {
        border-radius: 12px;
        background-color: var(--brown-100);
        border: 1px solid var(--pale-autumn);
        color: var(--dark-brown);
    }

    .modal-footer {
        background-color: var(--light-beige) !important;
        border-top: 1px solid var(--soft-apricot);
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
    }

    .modal-footer .btn {
        border-radius: 12px;
        padding: 8px 18px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .modal-footer .btn-secondary {
        background-color: var(--brown-300);
        color: var(--brown-900);
        border: none;
    }

    .modal-footer .btn-secondary:hover {
        background-color: var(--brown-400);
    }

    .modal-footer .btn-danger {
        background: linear-gradient(90deg, var(--pale-autumn), var(--autumn-primary));
        border: none;
        color: #fff;
        box-shadow: 0 3px 6px rgba(0,0,0,0.2);
    }

    .modal-footer .btn-danger:hover {
        background: linear-gradient(90deg, var(--autumn-primary), var(--dark-autumn));
        transform: translateY(-1px);
    }

    .btn-outline-danger,
    .btn-outline-primary {
        border-radius: 12px;
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
</style>

<div class="container">
    <!-- Page Header -->
    <div class="menu-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1>
                    <i class="bi bi-cup-hot-fill"></i> Menu Management
                </h1>
                <p class="lead">☕ Manage all café menu items and their availability</p>
            </div>
            <a href="{{ route('menu.create') }}" class="btn btn-add-menu">
                <i class="bi bi-plus-circle"></i> Add New Item
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($menuItems->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted">No menu items yet. Click "Add New Item" to create one.</p>
                </div>
            @else
                <div class="category-tabs d-flex flex-wrap">
                    <button class="category-tab active" data-category="all">
                        All Items <span class="badge">{{ $menuItems->count() }}</span>
                    </button>
                    @foreach(['Coffee','Tea','Pastries','Sandwiches','Desserts','Beverages','Other'] as $category)
                        <button class="category-tab" data-category="{{ $category }}">
                            <i class="bi bi-cup-hot-fill"></i> {{ $category }}
                            <span class="badge">{{ $menuItems->where('category',$category)->count() }}</span>
                        </button>
                    @endforeach
                </div>

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
                                    <td><img src="{{ $item->image_url }}" class="img-thumbnail" style="width:60px;height:60px;object-fit:cover;"></td>
                                    <td class="fw-semibold">{{ $item->name }}</td>
                                    <td><span class="badge bg-secondary">{{ $item->category ?? '-' }}</span></td>
                                    <td><small>{{ Str::limit($item->description, 50) }}</small></td>
                                    <td class="text-success fw-semibold">₱{{ number_format($item->price, 2) }}</td>
                                    <td>
                                        @if($item->stock>0)
                                            <span class="badge bg-success">{{ $item->stock }}</span>
                                        @else
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('menu.edit',$item) }}" 
                                               class="btn btn-edit"
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-delete" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $item->id }}"
                                                    title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>

                                        <!-- ENHANCED MODAL -->
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content delete-modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill"></i> Confirm Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete <strong>{{ $item->name }}</strong>?</p>
                                                        @if($item->orderItems()->count()>0)
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
                                                        @if($item->orderItems()->count()>0)
                                                            <button type="button" class="btn btn-danger" disabled>
                                                                <i class="bi bi-lock"></i> Cannot Delete
                                                            </button>
                                                        @else
                                                            <form action="{{ route('menu.destroy',$item) }}" method="POST" class="d-inline">
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
            @endif
        </div>
    </div>

    <div class="mt-3">
        <small class="text-muted">Total Items: {{ $menuItems->count() }}</small>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.category-tab');
    const contents = document.querySelectorAll('.category-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const category = this.dataset.category;
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            document.querySelector(`[data-category-content="${category}"]`)?.classList.add('active');
        });
    });
});
</script>
@endsection
