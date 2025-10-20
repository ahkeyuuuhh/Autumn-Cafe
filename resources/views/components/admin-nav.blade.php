<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand">
        <h3><i class="bi bi-cup-hot-fill"></i> Autumn Café</h3>
        <small>Admin Panel</small>
    </div>

    <ul class="sidebar-nav">
        <li class="sidebar-nav-item">
            <a href="{{ route('dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ route('menu.index') }}" class="sidebar-nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}">
                <i class="bi bi-grid-3x3-gap"></i>
                <span>Menu</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ route('orders.index') }}" class="sidebar-nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                <i class="bi bi-card-list"></i>
                <span>Order Management</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ route('transactions.index') }}" class="sidebar-nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i>
                <span>Transactions</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ route('customers.index') }}" class="sidebar-nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Customers</span>
            </a>
        </li>
    </ul>

    @auth
    <div class="sidebar-user">
        <div class="sidebar-user-info">
            <strong><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</strong>
            <small>{{ ucfirst(Auth::user()->role) }}</small>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
    @endauth
</div>

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
        
        --beige: #d4c4b5;
        --pale-autumn: #b8a08a;
        --autumn-primary: #8b6f47;
        --dark-autumn: #6b5635;
        --dark-brown: #352b1d;
    }

    /* Sidebar Styling */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 280px;
        background: linear-gradient(180deg, var(--dark-brown) 0%, var(--brown-800) 100%);
        padding: 20px 0;
        z-index: 1000;
        overflow-y: auto;
        box-shadow: 4px 0 20px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }

    .sidebar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.02) 10px,
                rgba(255, 255, 255, 0.02) 20px
            );
        pointer-events: none;
    }

    .sidebar-brand {
        padding: 20px 25px;
        text-align: center;
        border-bottom: 2px solid rgba(255,255,255,0.1);
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .sidebar-brand h3 {
        color: white;
        font-weight: 800;
        font-size: 1.5rem;
        margin: 0;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .sidebar-brand small {
        color: rgba(255,255,255,0.7);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .sidebar-nav {
        padding: 0;
        list-style: none;
        position: relative;
        z-index: 1;
    }

    .sidebar-nav-item {
        margin-bottom: 5px;
    }

    .sidebar-nav-link {
        display: flex;
        align-items: center;
        padding: 15px 25px;
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .sidebar-nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--pale-autumn);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .sidebar-nav-link i {
        font-size: 1.2rem;
        margin-right: 15px;
        width: 25px;
        text-align: center;
    }

    .sidebar-nav-link:hover {
        background: rgba(255,255,255,0.1);
        color: white;
        padding-left: 30px;
    }

    .sidebar-nav-link:hover::before {
        transform: scaleY(1);
    }

    .sidebar-nav-link.active {
        background: rgba(255,255,255,0.15);
        color: white;
        font-weight: 600;
        border-left: 4px solid var(--pale-autumn);
    }

    .sidebar-user {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px 25px;
        border-top: 2px solid rgba(255,255,255,0.1);
        background: rgba(0,0,0,0.2);
        z-index: 1;
    }

    .sidebar-user-info {
        color: white;
        margin-bottom: 10px;
    }

    .sidebar-user-info strong {
        display: block;
        font-size: 0.95rem;
    }

    .sidebar-user-info small {
        color: rgba(255,255,255,0.7);
        font-size: 0.75rem;
    }

    .btn-logout {
        width: 100%;
        background: rgba(220, 53, 69, 0.2);
        border: 2px solid rgba(220, 53, 69, 0.5);
        color: white;
        padding: 10px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-logout:hover {
        background: #dc3545;
        border-color: #dc3545;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }
    }

    @media (min-width: 769px) {
        body {
            padding-left: 280px;
        }
    }
</style>
