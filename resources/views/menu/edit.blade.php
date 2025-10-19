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

    body, html {
        height: 100%;
        overflow: hidden;
        background-color: var(--brown-300);
    }

    .container {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background-color: var(--light) !important;
        border-radius: 20px !important;
        border: 3px dashed var(--dark-autumn) !important;
        height: 90vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        border-top-right-radius: 20px !important;
        border-top-left-radius: 20px !important;
        background-color: var(--soft-apricot) !important;
        border-bottom: 2px solid var(--dark-autumn);
        font-size: 1rem !important;
        font-weight: 900 !important;
        color: var(--dark-autumn) !important;
        text-align: center;
        padding: 15px 0;
    }

    .card-body {
        flex: 1;
        overflow-y: auto;
        padding: 25px 30px;
    }

    .card-body::-webkit-scrollbar {
        width: 8px;
    }

    .card-body::-webkit-scrollbar-thumb {
        background-color: var(--pale-autumn);
        border-radius: 10px;
    }

    label {
        color: var(--dark-brown) !important;
        font-weight: 600;
    }

    .btn {
        border-radius: 20px;
        padding: 10px 20px;
        font-weight: 500 !important;
        transition: all 0.3s ease;
    }

    .update-btn {
        background-color: var(--soft-apricot) !important;
        color: var(--dark-autumn) !important;
    }

    .update-btn:hover {
        background-color: var(--pale-autumn) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-secondary {
        background-color: var(--brown-400) !important;
        border: none;
    }

    .btn-secondary:hover {
        background-color: var(--dark-autumn) !important;
    }

    .form-control, .form-select {
        border-radius: 12px;
        border: 1px solid var(--brown-200);
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--pale-autumn);
        box-shadow: 0 0 0 0.2rem rgba(184, 160, 138, 0.3);
    }

    .alert-info {
        background-color: var(--light-beige);
        color: var(--dark-brown);
        border: none;
        border-left: 4px solid var(--pale-autumn);
        border-radius: 12px;
        font-size: 0.9rem;
    }

    .img-thumbnail {
        border-radius: 12px;
    }
</style>

<div class="container">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Edit Menu Item</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('menu.update', $menu) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="image" class="form-label">Item Image</label>
                        @if($menu->image)
                            <div class="mb-2">
                                <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               onchange="previewImage(this)">
                        <small class="text-muted">Leave empty to keep current image. Supported: JPEG, PNG, JPG, GIF, WEBP. Max size: 2MB</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <img id="imagePreview" src="" alt="Preview" style="max-width: 200px; display: none;" class="img-thumbnail">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $menu->name) }}" 
                               required 
                               placeholder="e.g., Pumpkin Spice Latte">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select @error('category') is-invalid @enderror" 
                                id="category" 
                                name="category">
                            <option value="">Select a category</option>
                            <option value="Coffee" {{ old('category', $menu->category) == 'Coffee' ? 'selected' : '' }}>Coffee</option>
                            <option value="Tea" {{ old('category', $menu->category) == 'Tea' ? 'selected' : '' }}>Tea</option>
                            <option value="Pastries" {{ old('category', $menu->category) == 'Pastries' ? 'selected' : '' }}>Pastries</option>
                            <option value="Sandwiches" {{ old('category', $menu->category) == 'Sandwiches' ? 'selected' : '' }}>Sandwiches</option>
                            <option value="Desserts" {{ old('category', $menu->category) == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                            <option value="Beverages" {{ old('category', $menu->category) == 'Beverages' ? 'selected' : '' }}>Beverages</option>
                            <option value="Other" {{ old('category', $menu->category) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Enter item description...">{{ old('description', $menu->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price (₱) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price', $menu->price) }}" 
                                   step="0.01" 
                                   min="0" 
                                   required 
                                   placeholder="0.00">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('stock') is-invalid @enderror" 
                                   id="stock" 
                                   name="stock" 
                                   value="{{ old('stock', $menu->stock) }}" 
                                   min="0" 
                                   required 
                                   placeholder="0">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <small><i class="bi bi-info-circle"></i> Last updated: {{ $menu->updated_at->format('M d, Y h:i A') }}</small>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('menu.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary update-btn">
                            <i class="bi bi-check-circle"></i> Update Menu Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

@endsection
