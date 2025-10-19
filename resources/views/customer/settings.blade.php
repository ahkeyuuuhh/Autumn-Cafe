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
            background: linear-gradient(135deg, #faf8f6 0%, #f5f0eb 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
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

    </style>
</head>
<body>
    @include('components.customer-nav')
    
    <div class="container mt-4">
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

    <!-- Modals -->
    @include('components.modals')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Universal Modal Cleanup
        document.addEventListener('DOMContentLoaded', function() {
            function cleanupModals() {
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            }
            
            document.querySelectorAll('.modal').forEach(function(modalElement) {
                modalElement.addEventListener('hidden.bs.modal', function () {
                    setTimeout(cleanupModals, 100);
                });
            });
        });

        // Show modals
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('successModal'));
                modal.show();
            });
        @endif

        @if(session('error') || $errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('errorModal'));
                modal.show();
            });
        @endif
    </script>
</div>
</body>
</html>
