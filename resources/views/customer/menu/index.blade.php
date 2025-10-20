<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Autumn Café</title>
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
            
            /* Semantic naming for easy replacement */
            --beige: #d4c4b5;
            --pale-autumn: #b8a08a;
            --autumn-primary: #8b6f47;
            --dark-autumn: #6b5635;
            --green-brown: #6b5635;
            --dark-brown: #352b1d;
            --light: #faf8f6;
            --light-beige: #f5f0eb;
            --soft-apricot: #e8ddd2;
            --dusty-rose: #d4c4b5;
            --light-coral: #b8a08a;
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
            content: '\F284';
            font-family: 'bootstrap-icons';
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
            content: '\F29E';
            font-family: 'bootstrap-icons';
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

        /* Additional decorative background icons */
        .bg-icon {
            position: fixed;
            font-size: 70px;
            opacity: 0.06;
            z-index: 0;
            pointer-events: none;
            filter: drop-shadow(1px 1px 2px rgba(0,0,0,0.08));
            font-family: 'bootstrap-icons';
        }

        /* Scattered coffee and pastry icons across the page */
        .bg-icon-1 { content: '\F4AE'; top: 15%; right: 10%; animation: float 7s ease-in-out infinite 0.5s; }
        .bg-icon-2 { content: '\F29E'; top: 35%; left: 8%; animation: float 9s ease-in-out infinite 1.5s; }
        .bg-icon-3 { content: '\F4AE'; top: 50%; right: 18%; animation: float 6s ease-in-out infinite 2s; }
        .bg-icon-4 { content: '�'; top: 65%; left: 12%; animation: float 8s ease-in-out infinite 1s; }
        .bg-icon-5 { content: '\F284'; top: 75%; right: 25%; animation: float 7s ease-in-out infinite 2.5s; }
        .bg-icon-6 { content: '\F29E'; top: 25%; left: 20%; animation: float 8.5s ease-in-out infinite 3s; }
        .bg-icon-7 { content: '\F284'; top: 45%; right: 5%; animation: float 7.5s ease-in-out infinite 0.8s; }
        .bg-icon-8 { content: '\F4AE'; top: 85%; left: 15%; animation: float 9s ease-in-out infinite 1.2s; }
        .bg-icon-9 { content: '\F29E'; top: 20%; right: 30%; animation: float 6.5s ease-in-out infinite 2.8s; }
        .bg-icon-10 { content: '\F284'; top: 55%; left: 25%; animation: float 8s ease-in-out infinite 0.3s; }
        
        /* Semi-transparent navbar with texture */
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
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            letter-spacing: -0.3px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 8px;
            position: relative;
            z-index: 1;
        }
        
        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--soft-apricot);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .cart-badge {
            background: var(--pale-autumn);
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-left: 6px;
            box-shadow: 0 2px 8px rgba(188, 82, 39, 0.3);
        }
        
        /* Main container with better padding and spacing */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            margin-top: 10rem !important;
        }
        
        /* Search and filter section with coffee texture */
        .search-filter-section {
            background: linear-gradient(135deg, #fff 0%, #faf8f6 100%);
            border-radius: 20px;
            padding: 40px;
            margin-top: 3rem !important;
            margin-bottom: 60px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            border: 1px solid rgba(188, 82, 39, 0.06);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.6s ease-out;
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

        /* Coffee bean texture overlay */
        .search-filter-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(139, 111, 71, 0.03) 1px, transparent 1px),
                radial-gradient(circle at 80% 80%, rgba(139, 111, 71, 0.03) 1px, transparent 1px);
            background-size: 50px 50px, 70px 70px;
            background-position: 0 0, 25px 25px;
            pointer-events: none;
        }

        /* Steam effect */
        .search-filter-section::after {
            content: '\F284';
            font-family: 'bootstrap-icons';
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 60px;
            opacity: 0.08;
            animation: steam 3s ease-in-out infinite;
        }

        @keyframes steam {
            0%, 100% { transform: translateY(0) scale(1); opacity: 0.08; }
            50% { transform: translateY(-10px) scale(1.1); opacity: 0.12; }
        }
        
        .search-filter-section h3 {
            color: var(--dark-brown);
            font-weight: 700;
            margin-bottom: 24px;
            font-size: 1.3rem;
            letter-spacing: -0.2px;
            position: relative;
            z-index: 1;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .search-bar {
            border: 2px solid var(--light-beige);
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: var(--warm-cream);
            color: var(--dark-brown);
            position: relative;
            z-index: 1;
        }
        
        .search-bar::placeholder {
            color: #999;
        }
        
        .search-bar:focus {
            border-color: var(--autumn-primary);
            box-shadow: 0 0 0 4px rgba(188, 82, 39, 0.1);
            outline: none;
            background: white;
            transform: scale(1.02);
        }
        
        .category-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
        }
        
        .category-pill {
            padding: 12px 24px;
            border: 2px solid var(--light-beige);
            border-radius: 25px;
            background: white;
            color: var(--dark-brown);
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
            position: relative;
            overflow: hidden;
        }

        .category-pill::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(139, 111, 71, 0.15);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
            z-index: 0;
        }

        .category-pill span {
            position: relative;
            z-index: 1;
        }
        
        .category-pill:hover {
            background: var(--soft-apricot);
            border-color: var(--pale-autumn);
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 20px rgba(188, 82, 39, 0.3);
            color: var(--dark-brown);
        }

        .category-pill:hover::before {
            width: 300px;
            height: 300px;
        }

        .category-pill:active {
            transform: translateY(-2px) scale(1.02);
        }
        
        .category-pill.active {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            color: white;
            border-color: var(--autumn-primary);
            box-shadow: 0 6px 18px rgba(188, 82, 39, 0.4);
            transform: translateY(-2px);
        }

        .category-pill.active::before {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .btn-search {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            border: none;
            color: white;
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(188, 82, 39, 0.25);
            letter-spacing: 0.3px;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .btn-search::before {
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

        .btn-search:active::before {
            width: 300px;
            height: 300px;
            transition: width 0s, height 0s;
        }
        
        .btn-search:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 24px rgba(188, 82, 39, 0.4);
            color: white;
        }

        .btn-search:active {
            transform: translateY(-1px) scale(0.98);
        }
        
        .btn-clear {
            background: var(--beige);
            border: none;
            color: var(--dark-brown);
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .btn-clear::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(139, 111, 71, 0.15);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-clear:active::before {
            width: 300px;
            height: 300px;
            transition: width 0s, height 0s;
        }
        
        .btn-clear:hover {
            background: var(--soft-apricot);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 6px 16px rgba(188, 82, 39, 0.2);
            color: var(--dark-brown);
        }

        .btn-clear:active {
            transform: translateY(-1px) scale(0.98);
        }
        
        /* Category section with improved typography and spacing */
        .category-section {
            margin-bottom: 70px;
        }
        
        .category-title {
            color: var(--dark-brown);
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 40px;
            padding-bottom: 16px;
            border-bottom: 3px solid var(--pale-autumn);
            position: relative;
            letter-spacing: -0.3px;
            transition: all 0.3s ease;
        }

        .category-title:hover {
            color: var(--autumn-primary);
            transform: translateX(10px);
        }

        .category-title::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            transition: width 0.4s ease;
        }

        .category-title:hover::before {
            width: 120px;
        }
        /* Menu grid with better responsive design */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        /* Menu card redesigned with better visual hierarchy (smaller and aligned) */
        .menu-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(188, 82, 39, 0.05);
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            transform-style: preserve-3d;
            perspective: 1000px;
            cursor: pointer;
        }

        /* Smaller image height for compact cards */
        .menu-card .menu-image {
            width: 100%;
            height: 180px !important;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
            z-index: 1;
        }

        .menu-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(188, 82, 39, 0.1) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            z-index: 0;
        }
        
        .menu-card:hover::before {
            transform: scaleX(1);
        }

        .menu-card:hover::after {
            opacity: 1;
        }
        
        .menu-card:hover {
            transform: translateY(-12px) rotateX(5deg);
            box-shadow: 0 20px 50px rgba(188, 82, 39, 0.25);
            border-color: var(--autumn-primary);
        }
        
        .menu-image {
            width: 100%;
            height: 200px !important;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            object-position: top !important;
        }
        
        .menu-card:hover .menu-image {
            transform: scale(1.15) translateZ(20px);
        }
        
        .menu-card-body {
            padding: 18px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .menu-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark-brown);
            margin-bottom: 6px;
            line-height: 1.3;
            letter-spacing: -0.2px;
            min-height: 2.6rem; /* ensures consistent height for alignment */
        }
        
        .menu-description {
            font-size: 0.8rem;
            color: #888;
            margin-bottom: 10px;
            line-height: 1.4;
            height: 32px; /* fixed height for alignment */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        .menu-price {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--pale-autumn) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
            letter-spacing: -0.3px;
        }
        
        .stock-badge {
            font-size: 0.75rem;
            padding: 6px 12px;
            border-radius: 16px;
            font-weight: 600;
            letter-spacing: 0.2px;
            display: inline-block;
            margin-bottom: 12px;
        }
        
        .stock-badge.in-stock {
            background: linear-gradient(135deg, var(--soft-apricot) 0%, var(--beige) 100%);
            color: var(--dark-brown);
            box-shadow: 0 2px 6px rgba(188, 82, 39, 0.12);
        }
        
        .stock-badge.low-stock {
            background: linear-gradient(135deg, var(--dusty-rose) 0%, var(--light-coral) 100%);
            color: white;
            box-shadow: 0 2px 6px rgba(224, 128, 128, 0.25);
        }
        
        .quantity-section {
            display: flex;
            gap: 8px;
            align-items: flex-end;
            margin-bottom: 12px;
        }
        
        .quantity-input {
            flex: 1;
            text-align: center;
            border: 2px solid var(--light-beige);
            border-radius: 8px;
            padding: 8px;
            transition: all 0.3s ease;
            font-weight: 600;
            color: var(--dark-brown);
            font-size: 0.9rem;
        }
        
        .quantity-input:focus {
            border-color: var(--autumn-primary);
            box-shadow: 0 0 0 3px rgba(188, 82, 39, 0.1);
            outline: none;
        }
        
        .btn-add-cart {
            background: linear-gradient(135deg, var(--autumn-primary) 0%, var(--dark-autumn) 100%);
            border: none;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 12px rgba(188, 82, 39, 0.25);
            cursor: pointer;
        }
        
        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(188, 82, 39, 0.35);
            color: white;
        }
        
        .btn-add-cart:active {
            transform: translateY(0);
        }
        
        .alert-info {
            background: linear-gradient(135deg, var(--light-beige) 0%, var(--warm-cream) 100%);
            border: 2px solid var(--soft-apricot);
            color: var(--dark-brown);
            border-radius: 14px;
            padding: 16px 20px;
            box-shadow: 0 4px 12px rgba(188, 82, 39, 0.1);
            font-weight: 500;
            letter-spacing: 0.2px;
            margin-bottom: 40px;
        }
        
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }
        
        .empty-state i {
            font-size: 5rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-state p {
            color: #999;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        
        /* User menu dropdown styling */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-name {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .dropdown-menu {
            background: white;
            border: 1px solid var(--light-beige);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .dropdown-item {
            color: var(--dark-brown);
            transition: all 0.2s ease;
            padding: 10px 16px;
        }
        
        .dropdown-item:hover {
            background: var(--light-beige);
            color: var(--dark-brown);
        }
        
        /* Modal styling */
        .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        
        .modal-header {
            border: none;
            padding: 24px;
        }
        
        .modal-body {
            padding: 24px;
            color: var(--dark-brown);
        }
        
        .modal-footer {
            border: none;
            padding: 16px 24px;
        }
        
        /* Responsive design improvements */
        @media (max-width: 768px) {
            .hero-section {
                padding: 50px 0;
            }
            
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .hero-section p {
                font-size: 1rem;
            }
            
            .search-filter-section {
                padding: 24px;
            }
            
            .menu-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 16px;
            }
            
            .category-title {
                font-size: 1.5rem;
                margin-bottom: 24px;
            }
            
            .category-pills {
                gap: 10px;
            }
            
            .category-pill {
                padding: 10px 18px;
                font-size: 0.85rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 1.5rem;
            }
            
            .hero-section p {
                font-size: 0.9rem;
            }
            
            .menu-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 12px;
            }
            
            .search-filter-section {
                padding: 16px;
            }
            
            .category-title {
                font-size: 1.3rem;
            }
            
            .menu-name {
                font-size: 1rem;
            }
            
            .menu-price {
                font-size: 1.3rem;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .menu-card-body {
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Background decorative icons -->
    <div class="bg-icon bg-icon-1">🥐</div>
    <div class="bg-icon bg-icon-2">🧁</div>
    <div class="bg-icon bg-icon-3">🍪</div>
    <div class="bg-icon bg-icon-4">🥖</div>
    <div class="bg-icon bg-icon-5">☕</div>
    <div class="bg-icon bg-icon-6">🍩</div>
    <div class="bg-icon bg-icon-7">🥤</div>
    <div class="bg-icon bg-icon-8">🧇</div>
    <div class="bg-icon bg-icon-9">🍰</div>
    <div class="bg-icon bg-icon-10">☕</div>

    @include('components.customer-nav')
    <!-- Main Content -->
    <div class="container pb-5">
        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <form method="GET" action="{{ route('customer.menu') }}">
                <h3><i class="bi bi-search"></i> Find Your Favorite</h3>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-8">
                        <input type="text" 
                               class="form-control search-bar" 
                               name="search" 
                               placeholder="Search by name or description..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-search flex-grow-1">
                                <i class="bi bi-search"></i> Search
                            </button>
                            <a href="{{ route('customer.menu') }}" class="btn btn-clear">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label class="form-label fw-bold mb-3">
                        <i class="bi bi-funnel"></i> Filter by Category
                    </label>
                    <div class="category-pills">
                        <a href="{{ route('customer.menu') }}" 
                           class="category-pill {{ !request('category') || request('category') == 'all' ? 'active' : '' }}">
                            <span>All Items</span>
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('customer.menu', ['category' => $cat, 'search' => request('search')]) }}" 
                               class="category-pill {{ request('category') == $cat ? 'active' : '' }}">
                                <span>
                                @if($cat == 'Pastries')
                                    🥖
                                @elseif($cat == 'Desserts')
                                    🧁
                                @elseif($cat == 'Coffee')
                                    ☕
                                @elseif($cat == 'Beverages')
                                    🥤
                                @endif
                                {{ $cat }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>

        @if(request('search') || request('category'))
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i>
                @if(request('search'))
                    Showing results for: <strong>"{{ request('search') }}"</strong>
                @endif
                @if(request('category') && request('category') != 'all')
                    in category: <strong>{{ request('category') }}</strong>
                @endif
            </div>
        @endif

        @forelse($menuItems as $category => $items)
            <div class="category-section">
                <h2 class="category-title">
                    @if($category == 'Pastries')
                        🥖
                    @elseif($category == 'Desserts')
                        🧁
                    @elseif($category == 'Coffee')
                        ☕
                    @elseif($category == 'Beverages')
                        🥤
                    @else
                        <i class="bi bi-cup-straw"></i>
                    @endif
                    {{ $category }}
                </h2>
                
                <div class="menu-grid">
                    @foreach($items as $item)
                        <div class="menu-card">
                            @if($item->image)
                                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="menu-image">
                            @else
                                <div class="menu-image bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cup-straw" style="font-size: 3rem; color: #ddd;"></i>
                                </div>
                            @endif
                            
                            <div class="menu-card-body">
                                <div class="menu-name">{{ $item->name }}</div>
                                
                                @if($item->description)
                                    <p class="menu-description">{{ $item->description }}</p>
                                @endif
                                
                                <div class="menu-price">₱{{ number_format($item->price, 2) }}</div>
                                
                                <span class="stock-badge {{ $item->stock > 10 ? 'in-stock' : 'low-stock' }}">
                                    <i class="bi bi-box-seam"></i> {{ $item->stock }} in stock
                                </span>
                                
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-auto">
                                    @csrf
                                    <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                                    <div class="quantity-section">
                                        <input type="number" 
                                               name="quantity" 
                                               class="quantity-input" 
                                               value="1" 
                                               min="1" 
                                               max="{{ $item->stock }}"
                                               required>
                                    </div>
                                    <button type="submit" class="btn-add-cart">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                @if(request('search') || request('category'))
                    <p>No menu items found matching your search criteria.</p>
                    <a href="{{ route('customer.menu') }}" class="btn btn-clear">
                        <i class="bi bi-arrow-left"></i> View All Items
                    </a>
                @else
                    <p>No menu items available at the moment.</p>
                @endif
            </div>
        @endforelse
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

        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('successModal'));
                modal.show();
            });
        @endif

        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('errorModal'));
                modal.show();
            });
        @endif

        // Scroll-triggered animations
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe menu cards for staggered animation
            document.querySelectorAll('.menu-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(card);
            });

            // Observe category sections
            document.querySelectorAll('.category-section').forEach((section) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(section);
            });
        });

        // Add mouse tracking for card spotlight effect
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.menu-card').forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = ((e.clientX - rect.left) / rect.width) * 100;
                    const y = ((e.clientY - rect.top) / rect.height) * 100;
                    card.style.setProperty('--mouse-x', `${x}%`);
                    card.style.setProperty('--mouse-y', `${y}%`);
                });
            });
        });

        // Smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>
</html>
