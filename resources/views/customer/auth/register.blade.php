<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration - Autumn Café</title>
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
            display: flex;
            align-items: center;
            padding: 40px 0;
        }
        
        .auth-container {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            overflow: hidden;
        }
        
        .auth-header {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        
        .auth-header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        .auth-header p {
            opacity: 0.9;
            margin: 0;
        }
        
        .auth-body {
            padding: 40px 30px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--autumn-brown);
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--autumn-orange);
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
        }
        
        .input-group-text {
            background: var(--autumn-cream);
            border: 2px solid #e0e0e0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: var(--autumn-brown);
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--autumn-orange);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-orange) 0%, var(--autumn-light-orange) 100%);
            border: none;
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(230, 126, 34, 0.4);
        }
        
        .password-requirements {
            font-size: 0.85rem;
            color: #666;
            margin-top: 8px;
        }
        
        .password-requirements ul {
            padding-left: 20px;
            margin-bottom: 0;
        }
        
        .password-requirements li {
            margin-bottom: 4px;
        }
        
        .password-requirements li.valid {
            color: #28a745;
        }
        
        .password-requirements li.invalid {
            color: #dc3545;
        }
        
        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e0e0e0;
        }
        
        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
            color: #999;
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
                    <i class="bi bi-cup-hot-fill" style="font-size: 3rem;"></i>
                    <h1>Join Autumn Café</h1>
                    <p>Create your account to start ordering</p>
                </div>
                
                <div class="auth-body">
                    <form action="{{ route('customer.register') }}" method="POST" id="registerForm">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-person"></i> Full Name
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
                                       minlength="2"
                                       pattern="[a-zA-Z\s]+"
                                       title="Name can only contain letters and spaces">
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

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
                                       placeholder="juan@example.com"
                                       required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                <i class="bi bi-telephone"></i> Phone Number
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-telephone-fill"></i>
                                </span>
                                <input type="tel" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}"
                                       placeholder="09123456789 or +639123456789"
                                       required
                                       pattern="(\+63|0)[0-9]{10}"
                                       title="Enter a valid Philippine phone number">
                            </div>
                            <small class="text-muted">Format: 09123456789 or +639123456789</small>
                            @error('phone')
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
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password"
                                       required
                                       minlength="8">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="password-requirements">
                                <strong>Password must contain:</strong>
                                <ul id="passwordChecks">
                                    <li id="check-length" class="invalid">
                                        <i class="bi bi-x-circle"></i> At least 8 characters
                                    </li>
                                    <li id="check-uppercase" class="invalid">
                                        <i class="bi bi-x-circle"></i> One uppercase letter (A-Z)
                                    </li>
                                    <li id="check-lowercase" class="invalid">
                                        <i class="bi bi-x-circle"></i> One lowercase letter (a-z)
                                    </li>
                                    <li id="check-number" class="invalid">
                                        <i class="bi bi-x-circle"></i> One number (0-9)
                                    </li>
                                    <li id="check-special" class="invalid">
                                        <i class="bi bi-x-circle"></i> One special character (!@#$%^&*)
                                    </li>
                                </ul>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                <i class="bi bi-shield-check"></i> Confirm Password
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-shield-fill-check"></i>
                                </span>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation"
                                       required
                                       minlength="8">
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div id="passwordMatch" class="mt-2" style="display: none;">
                                <small class="text-danger">
                                    <i class="bi bi-exclamation-circle"></i> Passwords do not match
                                </small>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-person-plus"></i> Create Account
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="auth-footer">
                    <p class="mb-0">
                        Already have an account? 
                        <a href="{{ route('customer.login') }}" style="color: var(--autumn-orange); font-weight: 600;">
                            Sign In
                        </a>
                    </p>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted">
                    🍂 Autumn Café - Where Every Sip Tells a Story 🍂
                </p>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill"></i> Validation Errors
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2"><strong>Please fix the following errors:</strong></p>
                    <ul id="errorList" class="mb-0">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show error modal if there are validation errors
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

        document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
            const password = document.getElementById('password_confirmation');
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

        // Password validation
        const passwordInput = document.getElementById('password');
        const checks = {
            length: /^.{8,}$/,
            uppercase: /[A-Z]/,
            lowercase: /[a-z]/,
            number: /[0-9]/,
            special: /[!@#$%^&*(),.?":{}|<>]/
        };

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            
            // Check each requirement
            Object.keys(checks).forEach(check => {
                const element = document.getElementById(`check-${check}`);
                const icon = element.querySelector('i');
                
                if (checks[check].test(password)) {
                    element.classList.remove('invalid');
                    element.classList.add('valid');
                    icon.classList.remove('bi-x-circle');
                    icon.classList.add('bi-check-circle');
                } else {
                    element.classList.remove('valid');
                    element.classList.add('invalid');
                    icon.classList.remove('bi-check-circle');
                    icon.classList.add('bi-x-circle');
                }
            });
        });

        // Password match validation
        const passwordConfirm = document.getElementById('password_confirmation');
        const matchWarning = document.getElementById('passwordMatch');

        function checkPasswordMatch() {
            if (passwordConfirm.value.length > 0) {
                if (passwordInput.value !== passwordConfirm.value) {
                    matchWarning.style.display = 'block';
                    passwordConfirm.setCustomValidity('Passwords do not match');
                } else {
                    matchWarning.style.display = 'none';
                    passwordConfirm.setCustomValidity('');
                }
            }
        }

        passwordInput.addEventListener('input', checkPasswordMatch);
        passwordConfirm.addEventListener('input', checkPasswordMatch);

        // Form validation on submit
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            if (passwordInput.value !== passwordConfirm.value) {
                e.preventDefault();
                matchWarning.style.display = 'block';
                passwordConfirm.focus();
                return false;
            }
            
            // Sanitize inputs before submission to prevent XSS
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            
            // Remove HTML tags and trim whitespace
            nameInput.value = sanitizeText(nameInput.value);
            emailInput.value = sanitizeText(emailInput.value).toLowerCase();
            phoneInput.value = phoneInput.value.replace(/[^0-9+]/g, '');
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
        document.getElementById('name').addEventListener('input', function(e) {
            // Remove dangerous characters in real-time
            this.value = this.value.replace(/[<>]/g, '');
        });
        
        document.getElementById('email').addEventListener('input', function(e) {
            // Remove dangerous characters in real-time
            this.value = this.value.replace(/[<>'"]/g, '');
        });
    </script>
</body>
</html>
