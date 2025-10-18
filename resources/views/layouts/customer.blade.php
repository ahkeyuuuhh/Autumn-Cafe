<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Autumn Café')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --beige: #dec3a6;
            --pale-autumn: #d98b4c;
            --autumn-primary: #bc5227;
            --dark-autumn: #914420;
            --soft-apricot: #f2c198;
            --dusty-rose: #e7b7a1;
            --warm-cream: #fff3e2;
            --light-beige: #f5e7d0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--warm-cream) 0%, var(--light-beige) 100%);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            color: var(--dark-autumn);
        }

        /* Modal Styles - Consistent with Admin */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .modal-header {
            border-bottom: 3px solid rgba(255, 255, 255, 0.2);
            padding: 1.5rem 2rem;
            border-radius: 20px 20px 0 0;
        }

        .modal-header.bg-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
        }

        .modal-header.bg-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
        }

        .modal-header.bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
        }

        .modal-header.bg-primary {
            background: linear-gradient(135deg, var(--pale-autumn) 0%, var(--autumn-primary) 100%) !important;
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .modal-body {
            padding: 2rem;
            color: var(--dark-autumn);
        }

        .modal-footer {
            border-top: 1px solid var(--beige);
            padding: 1.5rem 2rem;
            background: var(--warm-cream);
        }

        .modal-footer .btn {
            border-radius: 10px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-backdrop.show {
            opacity: 0.6;
        }

        /* Additional Customer-Specific Styles */
        main {
            min-height: calc(100vh - 80px);
            padding-bottom: 3rem;
        }

        @yield('styles')
    </style>
</head>
<body>
    @include('components.customer-nav')

    <main>
        @yield('content')
    </main>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">
                        <i class="bi bi-check-circle-fill"></i> Success
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">
                        <i class="bi bi-exclamation-triangle-fill"></i> Error
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ session('error') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Universal Modal Cleanup Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to properly clean up modal backdrops
            function cleanupModals() {
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
            }

            // Add cleanup to all modals on the page
            const allModals = document.querySelectorAll('.modal');
            allModals.forEach(function(modalElement) {
                modalElement.addEventListener('hidden.bs.modal', function () {
                    setTimeout(cleanupModals, 100);
                });

                modalElement.addEventListener('show.bs.modal', function () {
                    const oldBackdrops = document.querySelectorAll('.modal-backdrop');
                    if (oldBackdrops.length > 1) {
                        oldBackdrops.forEach((backdrop, index) => {
                            if (index < oldBackdrops.length - 1) {
                                backdrop.remove();
                            }
                        });
                    }
                });
            });

            // Cleanup on ESC key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    setTimeout(cleanupModals, 100);
                }
            });
        });
    </script>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('successModal');
            if (modalElement) {
                const successModal = new bootstrap.Modal(modalElement);
                successModal.show();
            }
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('errorModal');
            if (modalElement) {
                const errorModal = new bootstrap.Modal(modalElement);
                errorModal.show();
            }
        });
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>
