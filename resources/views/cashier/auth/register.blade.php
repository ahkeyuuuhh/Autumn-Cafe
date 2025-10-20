<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Register - Autumn Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            /* Monochromatic Brown Palette */
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
        }

        body {
            background: linear-gradient(135deg, var(--brown-50) 0%, var(--brown-100) 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .auth-container {
            max-width: 420px;
            width: 90%;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
        }
        
        .auth-header {
            background: linear-gradient(135deg, var(--brown-600) 0%, var(--brown-700) 100%);
            color: white;
            padding: 1.2rem 1rem;
            text-align: center;
        }
        
        .auth-header h1 {
            font-size: 1.4rem;
            margin-bottom: 0.15rem;
            font-weight: 700;
        }
        
        .auth-header p {
            opacity: 0.95;
            margin: 0;
            font-size: 0.8rem;
        }
        
        .badge {
            background: rgba(255,255,255,0.2);
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            font-size: 0.65rem;
            margin-top: 0.3rem;
            display: inline-block;
        }
        
        .auth-body {
            padding: 0.9rem 1.3rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--brown-800);
            margin-bottom: 0.2rem;
            font-size: 0.75rem;
        }
        
        .form-control {
            border: 2px solid var(--brown-200);
            border-radius: 8px;
            padding: 0.4rem 0.55rem;
            font-size: 0.82rem;
        }
        
        .form-control:focus {
            border-color: var(--brown-500);
            box-shadow: 0 0 0 3px rgba(139, 111, 71, 0.1);
        }
        
        .input-group-text {
            background: var(--brown-100);
            border: 2px solid var(--brown-200);
            border-right: none;
            color: var(--brown-700);
            padding: 0.4rem 0.55rem;
            font-size: 0.82rem;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--brown-500) 0%, var(--brown-600) 100%);
            border: none;
            padding: 0.5rem;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(139, 111, 71, 0.3);
            font-size: 0.85rem;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--brown-600) 0%, var(--brown-700) 100%);
            transform: translateY(-2px);
        }
        
        .auth-footer {
            text-align: center;
            padding: 0.8rem 1.3rem;
            background: var(--brown-50);
        }
        
        .mb-3 {
            margin-bottom: 0.55rem !important;
        }
        
        small {
            font-size: 0.68rem;
        }
        
        a {
            color: var(--brown-600);
            text-decoration: none;
        }
        
        a:hover {
            color: var(--brown-700);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="bi bi-cup-hot-fill" style="font-size: 1.8rem;"></i>
                <h1>Cashier Register</h1>
                <p>Create your account</p>
                <span class="badge">🛒 Cashier Portal</span>
            </div>
            
            <div class="auth-body">
                <form method="POST" action="{{ route('cashier.register') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="bi bi-person-badge"></i> Full Name
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   placeholder="Juan Dela Cruz"
                                   required 
                                   autofocus>
                        </div>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope"></i> Email
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   placeholder="juan@example.com"
                                   required>
                        </div>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">
                            <i class="bi bi-person"></i> Username
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-at"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('username') is-invalid @enderror" 
                                   id="username" 
                                   name="username" 
                                   value="{{ old('username') }}"
                                   placeholder="cashier01"
                                   required>
                        </div>
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            <i class="bi bi-telephone"></i> Phone (Optional)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-telephone-fill"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   placeholder="09123456789">
                        </div>
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock"></i> Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password"
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-color: var(--brown-200);">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        <small class="text-muted">Min. 6 characters</small>
                        @error('password')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            <i class="bi bi-lock-fill"></i> Confirm Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-shield-fill-check"></i>
                            </span>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation"
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm" style="border-color: var(--brown-200);">
                                <i class="bi bi-eye" id="toggleIconConfirm"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid mb-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus"></i> Register
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="auth-footer">
                <p class="mb-1" style="font-size: 0.75rem;">
                    Already have an account? 
                    <a href="{{ route('cashier.login') }}" style="font-weight: 600;">Login</a>
                </p>
                <small class="text-muted" style="font-size: 0.68rem;">🍂 Autumn Café Cashier 🍂</small>
            </div>
        </div>
    </div>

    @include('components.modals')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        });

        // Toggle password confirmation visibility
        document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
            const toggleIcon = document.getElementById('toggleIconConfirm');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        });

        @if($errors->any())
            const modal = new bootstrap.Modal(document.getElementById('errorModal'));
            modal.show();
        @endif
    </script>
</body>
</html>
