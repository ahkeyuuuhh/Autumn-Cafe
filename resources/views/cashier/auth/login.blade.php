<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Login - Autumn Café</title>
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
            max-width: 400px;
            width: 90%;
        }
        
        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .auth-header {
            background: linear-gradient(135deg, var(--brown-600) 0%, var(--brown-700) 100%);
            color: white;
            padding: 1.5rem 1.2rem;
            text-align: center;
        }
        
        .auth-header h1 {
            font-size: 1.5rem;
            margin-bottom: 0.2rem;
            font-weight: 700;
        }
        
        .auth-header p {
            opacity: 0.95;
            margin: 0;
            font-size: 0.85rem;
        }
        
        .badge {
            background: rgba(255,255,255,0.2);
            padding: 0.25rem 0.6rem;
            border-radius: 15px;
            font-size: 0.7rem;
            margin-top: 0.4rem;
            display: inline-block;
        }
        
        .auth-body {
            padding: 1.3rem 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--brown-800);
            margin-bottom: 0.3rem;
            font-size: 0.82rem;
        }
        
        .form-control {
            border: 2px solid var(--brown-200);
            border-radius: 10px;
            padding: 0.55rem 0.65rem;
            font-size: 0.88rem;
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
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--brown-500) 0%, var(--brown-600) 100%);
            border: none;
            padding: 0.6rem;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(139, 111, 71, 0.3);
            font-size: 0.9rem;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--brown-600) 0%, var(--brown-700) 100%);
            transform: translateY(-2px);
        }
        
        .auth-footer {
            text-align: center;
            padding: 1rem 1.5rem;
            background: var(--brown-50);
        }
        
        .mb-3 {
            margin-bottom: 0.85rem !important;
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
                <i class="bi bi-cup-hot-fill" style="font-size: 2rem;"></i>
                <h1>Cashier Login</h1>
                <p>Autumn Café POS</p>
                <span class="badge">🛒 Cashier Portal</span>
            </div>
            
            <div class="auth-body">
                <form method="POST" action="{{ route('cashier.login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">
                            <i class="bi bi-person"></i> Username
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('username') is-invalid @enderror" 
                                   id="username" 
                                   name="username" 
                                   value="{{ old('username') }}"
                                   placeholder="Enter username"
                                   required 
                                   autofocus>
                        </div>
                        @error('username')
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
                                   placeholder="••••••••"
                                   required>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="auth-footer">
                <p class="mb-1" style="font-size: 0.82rem;">
                    Don't have an account? 
                    <a href="{{ route('cashier.register') }}" style="font-weight: 600;">Register</a>
                </p>
                <small class="text-muted" style="font-size: 0.75rem;">🍂 Autumn Café Cashier 🍂</small>
            </div>
        </div>
    </div>

    @include('components.modals')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        @if(session('success'))
            const modal = new bootstrap.Modal(document.getElementById('successModal'));
            modal.show();
        @endif

        @if(session('error'))
            const modal = new bootstrap.Modal(document.getElementById('errorModal'));
            modal.show();
        @endif
    </script>
</body>
</html>
