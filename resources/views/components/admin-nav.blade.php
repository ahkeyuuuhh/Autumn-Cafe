<!-- Mobile Toggle Button -->
<button class="sidebar-toggle" id="sidebarToggle">
    <i class="bi bi-list"></i>
</button>

<!-- Floating Sidebar -->
<nav class="admin-sidebar glassy" id="adminSidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <i class="bi bi-cup-hot-fill"></i>
            <span class="brand-text">Autumn Café</span>
        </a>
    </div>

    <div class="sidebar-menu">
        <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span class="link-text">Dashboard</span>
        </a>
        
        <a class="sidebar-link {{ request()->routeIs('menu.*') ? 'active' : '' }}" href="{{ route('menu.index') }}">
            <i class="bi bi-grid-3x3-gap"></i>
            <span class="link-text">Menu</span>
        </a>
        
        <a class="sidebar-link {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
            <i class="bi bi-card-list"></i>
            <span class="link-text">Order Management</span>
        </a>

        <a class="sidebar-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
            <i class="bi bi-receipt"></i>
            <span class="link-text">Transactions</span>
        </a>
        
        <a class="sidebar-link {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
            <i class="bi bi-people"></i>
            <span class="link-text">Customers</span>
        </a>
    </div>

    @auth
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                <i class="bi bi-person-circle"></i>
            </div>
            <div class="user-details">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
                <span class="link-text">Logout</span>
            </button>
        </form>
    </div>
    @endauth
</nav>

<!-- Overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<style>
    :root {
        --brown-50: #fdfbf9;
        --brown-100: #f8f1ea;
        --brown-200: #e7d5c6;
        --brown-300: #d2b18a;
        --brown-400: #b8824e;
        --brown-500: #8f5a2d;
        --brown-600: #704320;
        --brown-700: #513019;
        --brown-800: #382113;
        --brown-900: #24160d;
        --accent: #f3b37d;
        --sidebar-width: 260px;
    }

    /* Glassy Sidebar */
    .glassy {
        backdrop-filter: blur(10px);
        background: rgba(73, 44, 22, 0.92);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Toggle Button */
    .sidebar-toggle {
        position: fixed;
        top: 18px;
        left: 18px;
        z-index: 1100;
        background: linear-gradient(135deg, var(--brown-400), var(--brown-600));
        border: none;
        width: 48px;
        height: 48px;
        border-radius: 14px;
        color: #fff;
        font-size: 1.6rem;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .sidebar-toggle:hover {
        transform: scale(1.08);
        background: linear-gradient(145deg, var(--brown-500), var(--brown-400));
    }

    /* Sidebar Structure */
    .admin-sidebar {
        position: fixed;
        top: 20px;
        left: 20px;
        bottom: 20px;
        width: var(--sidebar-width);
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .sidebar-header {
        padding: 1.8rem 1.2rem;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-brand {
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .sidebar-brand i {
        font-size: 2.1rem;
        margin-right: 10px;
        color: var(--accent);
        filter: drop-shadow(0 0 3px rgba(243, 179, 125, 0.6));
    }

    .sidebar-brand:hover {
        color: var(--accent);
        transform: scale(1.05);
    }

    /* Sidebar Links */
    .sidebar-menu {
        flex: 1;
        padding: 1.5rem 1rem;
        overflow-y: auto;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 0.85rem 1rem;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        border-radius: 12px;
        font-weight: 500;
        margin-bottom: 0.6rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .sidebar-link i {
        font-size: 1.3rem;
        margin-right: 12px;
        color: var(--accent);
        transition: all 0.3s ease;
    }

    .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateX(5px);
        color: #fff;
    }

    .sidebar-link:hover i {
        transform: scale(1.2);
    }

    .sidebar-link.active {
        background: linear-gradient(135deg, var(--brown-500), var(--brown-400));
        color: #fff;
        font-weight: 600;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    }

    .sidebar-link.active::before {
        content: '';
        position: absolute;
        left: -8px;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 60%;
        background: var(--accent);
        border-radius: 0 4px 4px 0;
    }

    /* User Section */
    .sidebar-footer {
        padding: 1.2rem;
        background: rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .user-info {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 0.7rem;
    }

    .user-avatar {
        font-size: 2.4rem;
        color: var(--accent);
        margin-right: 10px;
    }

    .user-name {
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .user-role {
        color: var(--brown-200);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    .logout-btn {
        width: 100%;
        background: rgba(220, 38, 38, 0.15);
        border: 1px solid rgba(220, 38, 38, 0.3);
        color: #fca5a5;
        padding: 0.75rem;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background: rgba(220, 38, 38, 0.35);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
    }

    .logout-btn i {
        margin-right: 8px;
    }

    /* Overlay */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sidebar-overlay.active {
        display: block;
        opacity: 1;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar-toggle {
            display: flex;
        }

        .admin-sidebar {
            left: -100%;
            top: 0;
            bottom: 0;
            width: 270px;
            border-radius: 0 18px 18px 0;
        }

        .admin-sidebar.active {
            left: 0;
        }

        .sidebar-overlay.active {
            display: block;
        }
    }

    @media (min-width: 769px) {
        body {
            padding-left: calc(var(--sidebar-width) + 40px);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        sidebarToggle?.addEventListener('click', toggleSidebar);
        overlay?.addEventListener('click', toggleSidebar);

        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) toggleSidebar();
            });
        });
    });
</script>
