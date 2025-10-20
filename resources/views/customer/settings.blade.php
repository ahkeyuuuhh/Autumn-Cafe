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
            
            /* Semantic naming */
            --beige: #d4c4b5;
            --pale-autumn: #b8a08a;
            --autumn-primary: #8b6f47;
            --dark-autumn: #6b5635;
            --dark-brown: #352b1d;
            --light-beige: #f5f0eb;
            --soft-apricot: #e8ddd2;
            --warm-cream: #faf8f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: 
                /* Coffee bean texture pattern */
                radial-gradient(circle at 15% 25%, rgba(139, 111, 71, 0.05) 2px, transparent 2px),
                radial-gradient(circle at 85% 75%, rgba(139, 111, 71, 0.05) 2px, transparent 2px),
                radial-gradient(circle at 45% 55%, rgba(107, 86, 53, 0.04) 1.5px, transparent 1.5px),
                radial-gradient(circle at 65% 35%, rgba(107, 86, 53, 0.04) 1.5px, transparent 1.5px),
                /* Subtle grain texture */
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 2px,
                    rgba(139, 111, 71, 0.01) 2px,
                    rgba(139, 111, 71, 0.01) 4px
                ),
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 2px,
                    rgba(139, 111, 71, 0.01) 2px,
                    rgba(139, 111, 71, 0.01) 4px
                ),
                /* Base gradient */
                linear-gradient(135deg, var(--brown-300) 0%, var(--brown-200) 100%);
            background-size: 80px 80px, 90px 90px, 60px 60px, 70px 70px, 100% 100%, 100% 100%, 100% 100%;
            background-position: 0 0, 40px 40px, 20px 20px, 50px 50px, 0 0, 0 0, 0 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            color: var(--dark-brown);
            position: relative;
            overflow-x: hidden;
        }

        /* Coffee shop themed background elements */
        body::before {
            content: '⚙️';
            position: fixed;
            top: 10%;
            left: 5%;
            font-size: 120px;
            opacity: 0.08;
            animation: float 6s ease-in-out infinite;
            z-index: 0;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.1));
        }

        body::after {
            content: '👤';
            position: fixed;
            bottom: 10%;
            right: 5%;
            font-size: 100px;
            opacity: 0.08;
            animation: float 8s ease-in-out infinite reverse;
            z-index: 0;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.1));
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Background decorative icons */
        .bg-icon {
            position: fixed;
            font-size: 70px;
            opacity: 0.06;
            z-index: 0;
            pointer-events: none;
            filter: drop-shadow(1px 1px 2px rgba(0,0,0,0.08));
        }

        .bg-icon-1 { top: 15%; right: 10%; animation: float 7s ease-in-out infinite 0.5s; }
        .bg-icon-2 { top: 35%; left: 8%; animation: float 9s ease-in-out infinite 1.5s; }
        .bg-icon-3 { top: 50%; right: 18%; animation: float 6s ease-in-out infinite 2s; }
        .bg-icon-4 { top: 65%; left: 12%; animation: float 8s ease-in-out infinite 1s; }
        .bg-icon-5 { top: 75%; right: 25%; animation: float 7s ease-in-out infinite 2.5s; }

        /* Navbar styling */
        .navbar {
            background: linear-gradient(135deg, rgba(139, 111, 71, 0.95) 0%, rgba(107, 86, 53, 0.95) 100%);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .navbar::before {
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

        .container {
            position: relative;
            z-index: 1;
        }
        

        
        .settings-card {
            background: white;
            border-radius: 20px;
            padding: 45px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            border: 1px solid rgba(139, 111, 71, 0.1);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.6s ease-out;
            transition: all 0.3s ease;
        }

        .settings-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(139, 111, 71, 0.02) 1px, transparent 1px),
                radial-gradient(circle at 80% 80%, rgba(139, 111, 71, 0.02) 1px, transparent 1px);
            background-size: 40px 40px, 60px 60px;
            background-position: 0 0, 20px 20px;
            pointer-events: none;
        }

        .settings-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(139, 111, 71, 0.15);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .settings-card h5 {
            color: var(--dark-brown);
            font-weight: 800;
            font-size: 1.4rem;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid transparent;
            border-image: linear-gradient(90deg, var(--autumn-primary) 0%, transparent 100%);
            border-image-slice: 1;
            position: relative;
            z-index: 1;
            letter-spacing: -0.3px;
        }

        .settings-card h4 {
            position: relative;
            z-index: 1;
        }

        .form-label {
            font-weight: 700;
            color: var(--dark-brown);
            margin-bottom: 10px;
            font-size: 0.95rem;
            position: relative;
            z-index: 1;
            letter-spacing: 0.2px;
        }

        .form-label i {
            color: var(--autumn-primary);
            margin-right: 5px;
        }

        .form-control {
            border: 2px solid var(--light-beige);
            border-radius: 12px;
            padding: 16px 20px;
            transition: all 0.3s ease;
            background: var(--warm-cream);
            color: var(--dark-brown);
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        .form-control:hover {
            border-color: var(--pale-autumn);
            background: white;
        }

        .form-control:focus {
            border-color: var(--autumn-primary);
            box-shadow: 0 0 0 4px rgba(139, 111, 71, 0.1);
            outline: none;
            background: white;
            transform: scale(1.01);
        }

        .form-control:disabled {
            background: var(--light-beige);
            cursor: not-allowed;
            opacity: 0.7;
        }

        .form-control::placeholder {
            color: #999;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            color: white;
            padding: 60px 40px;
            border-radius: 20px;
            margin-bottom: 50px;
            box-shadow: 0 8px 32px rgba(139, 111, 71, 0.25);
            position: relative;
            overflow: hidden;
            animation: slideInDown 0.6s ease-out;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px, 70px 70px;
            pointer-events: none;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0;
            position: relative;
            z-index: 1;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            animation: fadeInUp 0.8s ease-out;
            color: white !important;
        }

        .page-header p {
            position: relative;
            z-index: 1;
            font-size: 1.1rem;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            border: none;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 6px 20px rgba(139, 111, 71, 0.3);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            color: white;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-primary:active::before {
            width: 500px;
            height: 500px;
            transition: width 0s, height 0s;
        }

        .btn-primary:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 10px 30px rgba(139, 111, 71, 0.4);
            color: white;
        }

        .btn-primary:active {
            transform: translateY(-2px) scale(0.98);
        }
        
        .btn-secondary {
            background: white;
            border: 2px solid var(--pale-autumn);
            color: var(--dark-brown);
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .btn-secondary:hover {
            background: var(--pale-autumn);
            color: white;
            border-color: var(--autumn-primary);
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(139, 111, 71, 0.3);
        }

        .btn-secondary:active {
            transform: translateY(-2px);
        }

        /* Info badge styling */
        .text-muted {
            font-size: 0.85rem;
            color: #888 !important;
            position: relative;
            z-index: 1;
        }

        .text-muted i {
            color: var(--autumn-primary);
        }

        /* Input group styling */
        .mb-3 {
            position: relative;
            animation: fadeIn 0.5s ease-out;
            animation-fill-mode: both;
        }

        .mb-3:nth-child(1) { animation-delay: 0.1s; }
        .mb-3:nth-child(2) { animation-delay: 0.2s; }
        .mb-3:nth-child(3) { animation-delay: 0.3s; }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Invalid feedback styling */
        .invalid-feedback {
            color: #dc3545;
            font-weight: 600;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.15) !important;
        }
    </style>
</head>
<body>
    <!-- Background decorative icons -->
    <div class="bg-icon bg-icon-1">📧</div>
    <div class="bg-icon bg-icon-2">📱</div>
    <div class="bg-icon bg-icon-3">✏️</div>
    <div class="bg-icon bg-icon-4">📝</div>
    <div class="bg-icon bg-icon-5">✅</div>

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
                        <label for="name" class="form-label">
                            <i class="bi bi-person-fill"></i> Full Name
                        </label>
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
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope-fill"></i> Email Address
                        </label>
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
                        <label for="phone" class="form-label">
                            <i class="bi bi-phone-fill"></i> Mobile Number
                        </label>
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

        // Add input focus effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateX(5px)';
                    this.parentElement.style.transition = 'transform 0.3s ease';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateX(0)';
                });
            });
        });

        // Add ripple effect to buttons
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-primary, .btn-secondary').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s ease-out';
                    ripple.style.pointerEvents = 'none';
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });
        });

        // Scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.settings-card').forEach(card => {
                observer.observe(card);
            });
        });

        // Add ripple animation style
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Smooth scroll
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</div>
</body>
</html>
