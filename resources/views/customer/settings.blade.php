<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings - Autumn Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --autumn-orange: #E67E22;
            --autumn-cream: #FFF9F3;
            --autumn-brown: #3B2F2F;
            --autumn-light-orange: #F39C12;
        }
        
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
            width: 250px;
            background: linear-gradient(180deg, var(--autumn-brown) 0%, #2C1810 100%);
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar.collapsed {
            transform: translateX(-250px);
        }
        
        .sidebar-brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-brand h3 {
            color: var(--autumn-light-orange);
            margin: 0;
            font-weight: bold;
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
            padding: 15px 25px;
            color: var(--autumn-cream);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255,255,255,0.1);
            padding-left: 30px;
        }
        
        .sidebar-menu i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 270px;
            z-index: 1001;
            background: var(--autumn-orange);
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }
        
        .sidebar-toggle.collapsed {
            left: 20px;
        }
        
        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            padding: 40px;
        }
        
        .main-content.expanded {
            margin-left: 0;
        }
        
        .user-info {
            padding: 15px 25px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: var(--autumn-cream);
        }
        
        .settings-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(230, 126, 34, 0.3);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
        }
        
        .btn-secondary {
            background: var(--autumn-brown);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
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
