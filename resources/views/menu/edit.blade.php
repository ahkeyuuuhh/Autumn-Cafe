@extends('layouts.app')

@section('content')

<style>
    :root {
        --beige: #dec3a6;
        --pale-autumn: #d98b4c;
        --autumn-primary: #bc5227;
        --dark-autumn: #914420;
        --green-brown: #914420;
        --dark-brown: #352011;
        --light: #faf3e9ff;
        --light-beige: #f5e7d0;
        --soft-apricot: #f2c198;
        --dusty-rose: #e7b7a1;
        --light-coral: #f08080;
        --warm-cream:#fff3e2;
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
    .update-btn {
        background-color: var(--soft-apricot) !important;
        color: var(--dark-autumn) !important;
    }
    .update-btn:hover {
        background-color: var(--pale-autumn) !important;
        color: white !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
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

                        <div class="d-flex justify-content-between">
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
