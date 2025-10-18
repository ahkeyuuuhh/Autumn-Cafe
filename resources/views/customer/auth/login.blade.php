<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login - Autumn Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/autumn-theme.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #FFF9F3 0%, #FFE8D6 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 40px 0;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 30%, rgba(210, 105, 30, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 70%, rgba(139, 69, 19, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .auth-container {
            max-width: 450px;
            margin: 0 auto;
        }
        
        .auth-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 15px 60px rgba(0,0,0,0.12);
            overflow: hidden;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(210, 105, 30, 0.1);
        }
        
        .auth-header {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            color: white;
            padding: 60px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .auth-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .auth-header h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 800;
            text-shadow: 0 4px 15px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1;
        }
        
        .auth-header p {
            opacity: 0.95;
            margin: 0;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .auth-body {
            padding: 40px 30px;
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
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: var(--autumn-primary);
            box-shadow: 0 0 0 4px rgba(210, 105, 30, 0.1);
            outline: none;
        }
        
        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e8e8e8;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: var(--autumn-dark);
            padding: 14px 15px;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--autumn-primary);
            background: rgba(210, 105, 30, 0.05);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--autumn-secondary) 100%);
            border: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.05rem;
            box-shadow: 0 4px 15px rgba(210, 105, 30, 0.3);
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(210, 105, 30, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }
        
        .form-check-input:checked {
            background-color: var(--autumn-orange);
            border-color: var(--autumn-orange);
        }
        
        .form-check-input:focus {
            border-color: var(--autumn-orange);
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
        }
        
        .auth-footer {
            text-align: center;
            padding: 20px 30px 30px;
            background: var(--autumn-cream);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .invalid-feedback {
            display: block;
            font-size: 0.9rem;
        }
        
        .autumn-decoration {
            position: fixed;
            opacity: 0.08;
            pointer-events: none;
            z-index: 0;
        }
        
        .leaf-1 {
            top: 50px;
            left: 50px;
            font-size: 100px;
            color: var(--autumn-orange);
            transform: rotate(25deg);
        }
        
        .leaf-2 {
            bottom: 50px;
            right: 50px;
            font-size: 120px;
            color: var(--autumn-light-orange);
            transform: rotate(-20deg);
        }
    </style>
</head>
<body>
    <!-- Autumn Decorations -->
    <div class="autumn-decoration leaf-1">🍂</div>
    <div class="autumn-decoration leaf-2">🍁</div>
    
    <div class="container" style="position: relative; z-index: 1;">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <i class="bi bi-cup-hot-fill" style="font-size: 3.5rem;"></i>
                    <h1>Welcome Back!</h1>
                    <p>Sign in to continue ordering</p>
                </div>
                
                <div class="auth-body">
                    <form action="{{ route('customer.login') }}" method="POST">
                        @csrf
                        
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope"></i> Email Address
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
                                       placeholder="Enter your email"
                                       required
                                       autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock"></i> Password
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       name="password"
                                       placeholder="Enter your password"
                                       required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="remember" 
                                       id="remember"
                                       value="1">
                                <label class="form-check-label" for="remember">
                                    Remember me on this device
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> Sign In
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="auth-footer">
                    <p class="mb-0">
                        Don't have an account? 
                        <a href="{{ route('customer.register') }}" style="color: var(--autumn-orange); font-weight: 600;">
                            Create Account
                        </a>
                    </p>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted">
                    <a href="{{ route('login') }}" style="color: var(--autumn-brown); text-decoration: none;">
                        <i class="bi bi-shield-lock"></i> Admin Login
                    </a>
                </p>
                <p class="text-muted">
                    🍂 Autumn Café - Where Every Sip Tells a Story 🍂
                </p>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-check-circle-fill"></i> Success
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill"></i> Login Failed
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ $errors->first() }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show success modal if there's a success message
        @if(session('success'))
            window.addEventListener('DOMContentLoaded', function() {
                const modalElement = document.getElementById('successModal');
                const successModal = new bootstrap.Modal(modalElement);
                successModal.show();
                
                modalElement.addEventListener('hidden.bs.modal', function () {
                    document.body.classList.remove('modal-open');
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                });
            });
        @endif

        // Show error modal if there are errors
        @if($errors->any())
            window.addEventListener('DOMContentLoaded', function() {
                const modalElement = document.getElementById('errorModal');
                const errorModal = new bootstrap.Modal(modalElement);
                errorModal.show();
                
                modalElement.addEventListener('hidden.bs.modal', function () {
                    document.body.classList.remove('modal-open');
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                });
            });
        @endif

        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
        
        // Sanitize inputs before submission to prevent XSS
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const emailInput = document.getElementById('email');
            
            // Sanitize email input
            emailInput.value = sanitizeText(emailInput.value).toLowerCase();
        });
        
        // Sanitize text input to prevent XSS
        function sanitizeText(input) {
            const div = document.createElement('div');
            div.textContent = input;
            let sanitized = div.innerHTML;
            
            // Remove script tags
            sanitized = sanitized.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
            
            // Remove event handlers
            sanitized = sanitized.replace(/on\w+\s*=\s*["'][^"']*["']/gi, '');
            
            // Remove javascript: protocol
            sanitized = sanitized.replace(/javascript:/gi, '');
            
            return sanitized.trim();
        }
        
        // Real-time input sanitization
        document.getElementById('email').addEventListener('input', function(e) {
            // Remove dangerous characters in real-time
            this.value = this.value.replace(/[<>'"]/g, '');
        });
    </script>
</body>
</html>
