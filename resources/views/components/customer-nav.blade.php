<!-- Customer Navigation Component -->
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

    .customer-navbar {
        background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .customer-navbar .navbar-brand {
        font-weight: 700;
        font-size: 1.75rem;
        color: white !important;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .customer-navbar .navbar-brand i {
        color: var(--soft-apricot);
        font-size: 2rem;
    }

    .customer-navbar .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        font-size: 1rem;
        transition: all 0.3s ease;
        margin: 0 0.5rem;
        padding: 0.5rem 1rem !important;
        border-radius: 10px;
        position: relative;
    }

    .customer-navbar .nav-link:hover {
        color: white !important;
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .customer-navbar .nav-link.active {
        background: rgba(255, 255, 255, 0.15);
        color: white !important;
    }

    .customer-navbar .cart-link {
        position: relative;
        background: var(--soft-apricot);
        color: var(--dark-autumn) !important;
        font-weight: 600;
        padding: 0.5rem 1.25rem !important;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .customer-navbar .cart-link:hover {
        background: var(--pale-autumn);
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(242, 193, 152, 0.4);
    }

    .customer-navbar .cart-badge {
        background: var(--autumn-primary);
        color: white;
        border-radius: 50%;
        padding: 2px 8px;
        font-size: 0.7rem;
        font-weight: 700;
        margin-left: 6px;
        position: absolute;
        top: -5px;
        right: -5px;
        box-shadow: 0 2px 8px rgba(188, 82, 39, 0.4);
        min-width: 20px;
        text-align: center;
    }

    .customer-navbar .dropdown-menu {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        padding: 0.5rem;
        margin-top: 0.5rem;
    }

    .customer-navbar .dropdown-item {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        color: var(--dark-autumn);
    }

    .customer-navbar .dropdown-item:hover {
        background: var(--warm-cream);
        color: var(--autumn-primary);
        transform: translateX(5px);
    }

    .customer-navbar .dropdown-divider {
        border-color: var(--beige);
        margin: 0.5rem 0;
    }

    @media (max-width: 991px) {
        .customer-navbar .navbar-collapse {
            background: rgba(0, 0, 0, 0.05);
            padding: 1rem;
            border-radius: 15px;
            margin-top: 1rem;
        }
    }
</style>

<nav class="navbar navbar-expand-lg customer-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('customer.menu') }}">
            <i class="bi bi-cup-hot-fill"></i>
            Autumn Café
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#customerNav" 
                style="border-color: rgba(255,255,255,0.5); color: white;">
            <i class="bi bi-list" style="font-size: 1.5rem; color: white;"></i>
        </button>
        <div class="collapse navbar-collapse" id="customerNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.menu') ? 'active' : '' }}" 
                       href="{{ route('customer.menu') }}">
                        <i class="bi bi-grid-fill"></i> Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cart-link" href="{{ route('customer.cart') }}">
                        <i class="bi bi-cart-fill"></i> Cart
                        @php
                            $cartCount = session()->has('cart') ? count(session('cart')) : 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
                @if(session('customer_id'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> 
                            {{ session('customer_name', 'Account') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.settings') }}">
                                    <i class="bi bi-gear-fill"></i> Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('customer.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
