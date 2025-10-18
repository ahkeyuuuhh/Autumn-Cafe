<!-- Cashier Navigation Component -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, var(--autumn-primary, #bc5227) 0%, var(--dark-autumn, #914420) 100%); box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('cashier.dashboard') }}" style="font-weight: 700; font-size: 1.5rem;">
            <i class="bi bi-cup-hot-fill me-2" style="font-size: 1.8rem;"></i>
            <span>Autumn Café</span>
            <span class="badge ms-2" style="background: rgba(255,255,255,0.2); font-size: 0.7rem; font-weight: 600;">Cashier</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#cashierNav" 
                aria-controls="cashierNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="cashierNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cashier.dashboard') ? 'active' : '' }}" 
                       href="{{ route('cashier.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cashier.order.create') ? 'active' : '' }}" 
                       href="{{ route('cashier.order.create') }}">
                        <i class="bi bi-plus-circle-fill"></i> Create Order
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="cashierDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> 
                        {{ session('cashier_name', 'Cashier') }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cashierDropdown">
                        <li>
                            <span class="dropdown-item-text text-muted small">
                                <i class="bi bi-person-badge"></i> Cashier Account
                            </span>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('cashier.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Cashier Navigation Styles */
    .navbar-dark .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.9);
        padding: 0.6rem 1.2rem;
        margin: 0 0.2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .navbar-dark .navbar-nav .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        transform: translateY(-2px);
    }

    .navbar-dark .navbar-nav .nav-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .navbar-dark .navbar-nav .nav-link i {
        font-size: 1.1rem;
    }

    .navbar-brand:hover {
        transform: scale(1.02);
        transition: transform 0.3s ease;
    }

    .dropdown-menu {
        border-radius: 12px;
        border: none;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        padding: 0.5rem;
        margin-top: 0.5rem;
    }

    .dropdown-item {
        border-radius: 8px;
        padding: 0.6rem 1rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .dropdown-item:hover {
        background: #f8f9fa;
        transform: translateX(5px);
    }

    .dropdown-item.text-danger:hover {
        background: #fee;
        color: #dc3545 !important;
    }

    .dropdown-item i {
        font-size: 1.1rem;
    }

    .dropdown-item-text {
        padding: 0.5rem 1rem;
    }

    .dropdown-divider {
        margin: 0.5rem 0;
    }

    @media (max-width: 991px) {
        .navbar-nav {
            padding: 1rem 0;
        }
        
        .nav-item {
            margin: 0.25rem 0;
        }
        
        .navbar-dark .navbar-nav .nav-link {
            border-radius: 8px;
            margin: 0.2rem 0;
        }
    }
</style>
