@extends('layouts.app')

@section('content')
<style>
    :root {
        --beige: #dec3a6;
        --pale-autumn: #d98b4c;
        --autumn-primary: #bc5227;
        --dark-autumn: #914420;
        --soft-apricot: #f2c198;
        --dusty-rose: #e7b7a1;
        --warm-cream: #fff3e2;
        --light-beige: #f5e7d0;
    }

    .customers-header {
        background: var(--warm-cream);
        padding: 2rem;
        border-radius: 20px;
        border: 3px dashed var(--beige);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .customers-header::before {
        content: '👥';
        position: absolute;
        font-size: 6rem;
        opacity: 0.1;
        right: -1rem;
        top: -1rem;
    }

    .customers-header h1 {
        color: var(--dark-autumn);
        font-weight: 700;
        margin: 0;
        font-size: 2rem;
    }

    .customers-header .lead {
        color: var(--pale-autumn);
        margin: 0.5rem 0 0 0;
        font-size: 1rem;
    }

    .customers-card {
        background: white;
        border-radius: 20px;
        border: none;
        border-top: 8px solid var(--dusty-rose);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05),
                    0 10px 20px rgba(0, 0, 0, 0.05),
                    0 15px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .search-box {
        border: 2px solid var(--beige);
        border-radius: 15px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .search-box:focus {
        border-color: var(--pale-autumn);
        box-shadow: 0 0 0 0.2rem rgba(217, 139, 76, 0.25);
        outline: none;
    }

    .customers-card .table thead {
        background: linear-gradient(135deg, var(--light-beige) 0%, var(--warm-cream) 100%);
    }

    .customers-card .table thead th {
        color: var(--pale-autumn);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem;
    }

    .customers-card .table tbody tr {
        transition: all 0.2s ease;
    }

    .customers-card .table tbody tr:hover {
        background: var(--warm-cream);
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
        background: linear-gradient(135deg, var(--soft-apricot) 0%, var(--dusty-rose) 100%);
        color: white;
    }

    .badge-orders {
        background: linear-gradient(135deg, var(--soft-apricot) 0%, var(--dusty-rose) 100%);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-add-customer {
        background: linear-gradient(135deg, var(--pale-autumn) 0%, var(--autumn-primary) 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add-customer:hover {
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

    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
        color: var(--pale-autumn);
    }

    .empty-state i {
        font-size: 4rem;
        opacity: 0.3;
        margin-bottom: 1rem;
    }

    .total-customers {
        background: linear-gradient(135deg, var(--soft-apricot) 0%, var(--dusty-rose) 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 15px;
        font-weight: 600;
    }
</style>

<div class="container">
    <!-- Page Header -->
    <div class="customers-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1>
                    <i class="bi bi-people-fill"></i> Customer Management
                </h1>
                <p class="lead">👋 Manage all café customers and their information</p>
            </div>
            <a href="{{ route('customers.create') }}" class="btn btn-add-customer">
                <i class="bi bi-person-plus"></i> Add New Customer
            </a>
        </div>
    </div>

    <!-- Customers Table Card -->
    <div class="customers-card card">
        <div class="card-body">
            @if($customers->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-person-x d-block"></i>
                    <p class="mb-0">No customers yet. Click "Add New Customer" to create one.</p>
                </div>
            @else
                <!-- Search and Filter -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <input type="text" id="searchInput" class="form-control search-box" placeholder="🔍 Search by name, email, or phone...">
                    </div>
                    <div class="col-md-4 text-end d-flex align-items-center justify-content-end">
                        <span class="total-customers">
                            Total Customers: <strong>{{ $customers->count() }}</strong>
                        </span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="customersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Orders</th>
                                <th>Joined Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td class="fw-semibold" style="color: var(--dark-autumn);">#{{ $customer->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2">
                                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                                            </div>
                                            <strong style="color: var(--dark-autumn);">{{ $customer->name }}</strong>
                                        </div>
                                    </td>
                                    <td style="color: var(--pale-autumn);">
                                        @if($customer->email)
                                            <i class="bi bi-envelope"></i> {{ $customer->email }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td style="color: var(--pale-autumn);">
                                        @if($customer->phone)
                                            <i class="bi bi-telephone"></i> {{ $customer->phone }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-orders">{{ $customer->orders_count }} orders</span>
                                    </td>
                                    <td class="text-muted small">
                                        {{ $customer->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('customers.edit', $customer) }}" 
                                               class="btn btn-edit" 
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-delete"
                                                    data-id="{{ $customer->id }}"
                                                    data-name="{{ $customer->name }}"
                                                    data-has-orders="{{ $customer->orders_count > 0 ? 'true' : 'false' }}"
                                                    data-action="{{ route('customers.destroy', $customer) }}"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal"
                                                    title="Delete">
                                                <i class="bi bi-trash"></i>
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
    </div>
</div>

<!-- Delete Confirmation Modal (Single Instance) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content delete-modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="deleteModalLabel">
          <i class="bi bi-exclamation-triangle-fill"></i> Confirm Delete
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="deleteModalBody">
        <p style="color: var(--dark-autumn);">Are you sure you want to delete this customer?</p>
        <p class="text-muted">This action cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">
            <i class="bi bi-trash"></i> Delete Customer
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// Simple search functionality
document.getElementById('searchInput')?.addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#customersTable tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});

// Handle delete modal dynamically
document.addEventListener('DOMContentLoaded', function () {
  const deleteModal = document.getElementById('deleteModal');
  const deleteForm = document.getElementById('deleteForm');
  const deleteBody = document.getElementById('deleteModalBody');

  deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const name = button.getAttribute('data-name');
    const action = button.getAttribute('data-action');
    const hasOrders = button.getAttribute('data-has-orders') === 'true';

    deleteForm.action = action;

    if (hasOrders) {
      deleteBody.innerHTML = `
        <p style="color: var(--dark-autumn);">
          Are you sure you want to delete <strong>${name}</strong>?
        </p>
        <div class="alert alert-warning">
          <i class="bi bi-exclamation-triangle-fill"></i> 
          This customer has existing orders. Deletion is disabled to maintain data integrity.
        </div>
      `;
      deleteForm.querySelector('button[type="submit"]').disabled = true;
    } else {
      deleteBody.innerHTML = `
        <p style="color: var(--dark-autumn);">
          Are you sure you want to delete <strong>${name}</strong>?
        </p>
        <p class="text-muted">This action cannot be undone.</p>
      `;
      deleteForm.querySelector('button[type="submit"]').disabled = false;
    }
  });
});
</script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
