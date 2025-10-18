<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings - Autumn Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/autumn-theme.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, var(--autumn-secondary) 0%, var(--autumn-dark) 100%);
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
            z-index: 1000;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
        }
        
        .sidebar.collapsed {
            transform: translateX(-280px);
        }
        
        .sidebar-brand {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            background: rgba(0,0,0,0.1);
        }
        
        .sidebar-brand h3 {
            color: var(--autumn-accent);
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            margin: 0;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 16px 25px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            border-left: 3px solid transparent;
        }
        
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(210, 105, 30, 0.2);
            padding-left: 30px;
            border-left-color: var(--autumn-accent);
            color: white;
        }
        
        .sidebar-menu i {
            margin-right: 12px;
            font-size: 1.3rem;
        }
        
        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 300px;
            z-index: 1001;
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            border: none;
            color: white;
            padding: 12px 16px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(210, 105, 30, 0.4);
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle.collapsed {
            left: 20px;
        }
        
        .sidebar-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(210, 105, 30, 0.5);
        }
        
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 50px;
        }
        
        .main-content.expanded {
            margin-left: 0;
        }
        
        .user-info {
            padding: 20px 25px;
            border-top: 1px solid rgba(255,255,255,0.15);
            color: rgba(255, 255, 255, 0.85);
        }
        
        .settings-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            border: 1px solid rgba(210, 105, 30, 0.1);
        }

        .settings-card h5 {
            color: var(--autumn-dark);
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid transparent;
            border-image: linear-gradient(90deg, var(--autumn-primary) 0%, transparent 100%);
            border-image-slice: 1;
        }

        .form-label {
            font-weight: 600;
            color: var(--autumn-dark);
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            padding: 14px 18px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--autumn-primary);
            box-shadow: 0 0 0 4px rgba(210, 105, 30, 0.1);
            outline: none;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            color: white;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 8px 30px rgba(210, 105, 30, 0.25);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(255,255,255,0.1) 0%, transparent 50%);
        }

        .page-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(210, 105, 30, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(210, 105, 30, 0.4);
        }
        
        .btn-secondary {
            background: #6c757d;
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }
            
            .sidebar:not(.collapsed) {
                transform: translateX(0);
            }
            
            .sidebar-toggle {
                left: 20px;
            }
            
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h3><i class="bi bi-cup-hot-fill"></i> Autumn Café</h3>
            <p class="text-muted small mb-0">Customer Portal</p>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('customer.menu') }}">
                    <i class="bi bi-shop"></i> Menu
                </a>
            </li>
            <li>
                <a href="{{ route('customer.cart') }}">
                    <i class="bi bi-cart3"></i> My Cart
                </a>
            </li>
            <li>
                <a href="{{ route('customer.settings') }}" class="active">
                    <i class="bi bi-gear"></i> Account Settings
                </a>
            </li>
        </ul>
        
        <div class="user-info">
            <div class="mb-3">
                <i class="bi bi-person-circle"></i> {{ session('customer_name') }}
            </div>
            <form action="{{ route('customer.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
    
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
        <i class="bi bi-list" id="toggleIcon"></i>
    </button>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="bi bi-gear-fill"></i> Account Settings</h1>
            <p class="mb-0 opacity-75">Manage your account information</p>
        </div>

        <!-- Settings Form -->
        <div class="settings-card">
            <h4 class="mb-4" style="color: var(--autumn-brown);">
                <i class="bi bi-person-circle"></i> Personal Information
            </h4>
            
            <form method="POST" action="{{ route('customer.settings') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" 
                               class="form-control" 
                               id="name" 
                               value="{{ $customer->name }}" 
                               disabled
                               readonly>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> Name cannot be changed
                        </small>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email"
                               value="{{ old('email', $customer->email) }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Mobile Number</label>
                        <input type="text" 
                               class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" 
                               name="phone"
                               value="{{ old('phone', $customer->phone) }}" 
                               placeholder="+639123456789 or 09123456789"
                               required>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> Format: +639XXXXXXXXX or 09XXXXXXXXX
                        </small>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Save Changes
                    </button>
                    <a href="{{ route('customer.menu') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-check-circle me-2"></i>Success</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Error</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if(session('error'))
                        {{ session('error') }}
                    @elseif($errors->any())
                        <strong>Validation Errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        @if(session('success'))
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif

        @if(session('error') || $errors->any())
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif

        // Clean up modal backdrops
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function () {
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        });

        // Sidebar toggle functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleBtn = document.getElementById('sidebarToggle');
            const toggleIcon = document.getElementById('toggleIcon');
            
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            toggleBtn.classList.toggle('collapsed');
            
            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.className = 'bi bi-list';
            } else {
                toggleIcon.className = 'bi bi-x-lg';
            }
        }
    </script>
</div>
</body>
</html>
