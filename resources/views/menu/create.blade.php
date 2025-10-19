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
    .card {
        background-color: var(--light) !important;
        border-radius: 20px !important;
        border: 3px dashed var(--dark-autumn) !important;
    }
    .card-header {
        border-top-right-radius: 20px !important;
        border-top-left-radius: 20px !important;
        background-color: var(--soft-apricot) !important;
        border-bottom: 2px solid var(--dark-autumn);
        font-size: 1rem !important;
        font-weight: 900 !important;
        color: var(--dark-autumn) !important;
    }
    label {
        color: var(--dark-brown) !important;
    }
    .btn {
        border-radius: 20px;
        padding: 10px 20px;
        font-weight: 500 !important;
    }
    .create-menu-btn {
        background-color: var(--soft-apricot) !important;
        color: var(--dark-autumn) !important;
    }
    .create-menu-btn:hover {
        background-color: var(--pale-autumn) !important;
        color: white !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Menu Item</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="image" class="form-label">Item Image</label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   onchange="previewImage(this)">
                            <small class="text-muted">Supported: JPEG, PNG, JPG, GIF, WEBP. Max size: 2MB</small>
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
                                   value="{{ old('name') }}" 
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
                                <option value="Coffee" {{ old('category') == 'Coffee' ? 'selected' : '' }}>Coffee</option>
                                <option value="Tea" {{ old('category') == 'Tea' ? 'selected' : '' }}>Tea</option>
                                <option value="Pastries" {{ old('category') == 'Pastries' ? 'selected' : '' }}>Pastries</option>
                                <option value="Sandwiches" {{ old('category') == 'Sandwiches' ? 'selected' : '' }}>Sandwiches</option>
                                <option value="Desserts" {{ old('category') == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                                <option value="Beverages" {{ old('category') == 'Beverages' ? 'selected' : '' }}>Beverages</option>
                                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
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
                                      placeholder="Enter item description...">{{ old('description') }}</textarea>
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
                                       value="{{ old('price') }}" 
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
                                       value="{{ old('stock', 0) }}" 
                                       min="0" 
                                       required 
                                       placeholder="0">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('menu.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary create-menu-btn">
                                <i class="bi bi-check-circle"></i> Create Menu Item
                            </button>
                        </div>
                    </form>
                </div>
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
