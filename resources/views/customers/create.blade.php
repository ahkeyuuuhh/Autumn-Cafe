@extends('layouts.app')

@section('content')
<style>
    :root {
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
    }

    body {
        background-color: var(--brown-50) !important;
    }

    .container {
        margin-bottom: 40px;
    }

    .card {
        border-radius: 25px !important;
        border: 2px dashed var(--brown-600) !important;
        overflow: hidden;
        background-color: var(--brown-100) !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .card-header {
        background-color: var(--brown-300) !important;
        color: var(--brown-700) !important;
        border: none !important;
        padding: 1rem 1.5rem;
    }

    .card-body {
        background-color: var(--brown-100) !important;
        padding: 1.5rem;
    }

    .card-footer {
        background-color: var(--brown-200) !important;
        border-top: 1px solid var(--brown-300);
        padding: 1rem 1.5rem;
    }

    .btn-primary {
        background-color: var(--brown-500) !important;
        border: none !important;
    }

    .btn-primary:hover {
        background-color: var(--brown-600) !important;
    }

    .btn-secondary {
        background-color: var(--brown-400) !important;
        border: none !important;
        color: #fff !important;
    }

    .btn-secondary:hover {
        background-color: var(--brown-500) !important;
    }

    .tips-card {
        border-radius: 15px;
        background-color: var(--brown-100) !important;
        border: 1px solid var(--brown-300) !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .tips-card h6 {
        color: var(--brown-700);
    }

    .tips-card ul {
        margin-bottom: 0;
    }

    .form-control:focus {
        border-color: var(--brown-500);
        box-shadow: 0 0 0 0.2rem rgba(139, 111, 71, 0.25);
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="bi bi-person-plus"></i> Add New Customer
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Customer Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   placeholder="e.g., John Doe"
                                   autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="customer@example.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Optional - for sending receipts or promotions</small>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="e.g., +63 912 345 6789">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Optional - for order notifications</small>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Add Customer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick Tips Card -->
            <div class="tips-card mt-4 p-3">
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-lightbulb text-warning"></i> Quick Tips
                </h6>
                <ul class="small">
                    <li>Customer name is required to create a profile</li>
                    <li>Email and phone are optional but helpful for communication</li>
                    <li>Email addresses must be unique (no duplicates)</li>
                    <li>You can edit customer information later from the customer list</li>
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
