<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="bi bi-cup-hot-fill"></i> Autumn Café
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav centered-links me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}" href="{{ route('menu.index') }}">
                        <i class="bi bi-grid-3x3-gap"></i> Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                        <i class="bi bi-card-list"></i> Order Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('orders.create') ? 'active' : '' }}" href="{{ route('orders.create') }}">
                        <i class="bi bi-plus-circle"></i> New Order
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                        <i class="bi bi-receipt"></i> Transactions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                        <i class="bi bi-people"></i> Customers
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span class="dropdown-item-text">
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <span class="dropdown-item-text">
                                    <small class="text-muted">
                                        <i class="bi bi-shield-check"></i> Role: {{ ucfirst(Auth::user()->role) }}
                                    </small>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    :root {
        --autumn-primary: #D2691E;
        --autumn-secondary: #8B4513;
        --autumn-accent: #CD853F;
        --autumn-light: #F4A460;
        --autumn-dark: #654321;
    }

    .navbar {
        background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 0.8rem 0;
    }

    .navbar-brand {
        font-size: 1.4rem;
        font-weight: 700;
        color: white !important;
        transition: all 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
    }

    .navbar-brand i {
        font-size: 1.5rem;
        margin-right: 8px;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        padding: 0.6rem 1rem !important;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 0 2px;
    }

    .nav-link i {
        margin-right: 6px;
        font-size: 1.1rem;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white !important;
        transform: translateY(-2px);
    }

    .nav-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white !important;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border-radius: 12px;
        padding: 0.5rem 0;
        margin-top: 0.5rem;
    }

    .dropdown-item {
        padding: 0.6rem 1.2rem;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background: rgba(210, 105, 30, 0.1);
        color: var(--autumn-primary);
    }

    .dropdown-item i {
        margin-right: 8px;
        width: 20px;
    }

    .dropdown-divider {
        margin: 0.5rem 0;
    }

    .dropdown-item-text {
        padding: 0.4rem 1.2rem;
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .navbar-nav {
            padding: 1rem 0;
        }

        .nav-link {
            padding: 0.8rem 1rem !important;
            margin: 2px 0;
        }

        .dropdown-menu {
            border: 1px solid rgba(0,0,0,0.1);
        }
    }
</style>
