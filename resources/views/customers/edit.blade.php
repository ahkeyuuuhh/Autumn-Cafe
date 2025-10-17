@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Customer
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.update', $customer) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Customer Info Alert -->
                        <div class="alert alert-info d-flex align-items-center">
                            <div class="avatar-circle bg-primary bg-opacity-10 text-primary me-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>
                            <div>
                                <strong>{{ $customer->name }}</strong><br>
                                <small class="text-muted">Customer ID: #{{ $customer->id }} | Member since {{ $customer->created_at->format('M d, Y') }}</small>
                            </div>
                        </div>

                        @if($customer->orders_count > 0)
                            <div class="alert alert-success">
                                <i class="bi bi-cart-check"></i> This customer has <strong>{{ $customer->orders_count }} order(s)</strong>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Customer Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $customer->name) }}" 
                                   required 
                                   placeholder="e.g., John Doe"
                                   autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email Address
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $customer->email) }}" 
                                       placeholder="customer@example.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Optional - for sending receipts or promotions</small>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                Phone Number
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', $customer->phone) }}" 
                                       placeholder="e.g., +63 912 345 6789">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Optional - for order notifications</small>
                        </div>

                        <div class="alert alert-light border">
                            <small class="text-muted">
                                <i class="bi bi-clock-history"></i> Last updated: {{ $customer->updated_at->format('M d, Y h:i A') }}
                            </small>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Customer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order History Preview (if any) -->
            @if($customer->orders_count > 0)
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="bi bi-clock-history"></i> Recent Order History
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">
                            This customer has placed {{ $customer->orders_count }} order(s). 
                            <a href="{{ route('transactions.index') }}" class="text-decoration-none">View all transactions</a>
                        </p>
                        <div class="alert alert-warning mb-0">
                            <small>
                                <i class="bi bi-info-circle"></i> Note: Customers with existing orders cannot be deleted to maintain data integrity.
                            </small>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .avatar-circle {
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
