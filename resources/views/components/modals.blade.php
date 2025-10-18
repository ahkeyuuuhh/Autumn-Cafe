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
                @if(session('error'))
                    <p class="mb-0">{{ session('error') }}</p>
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
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Modal Styles - Autumn Café Theme */
    .modal-backdrop {
        background-color: rgba(59, 47, 47, 0.6);
    }
    
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 50px rgba(188, 82, 39, 0.3);
        overflow: hidden;
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        border-bottom: none;
        padding: 2rem 2rem 1rem 2rem;
        border-radius: 20px 20px 0 0;
        position: relative;
    }

    .modal-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 2rem;
        right: 2rem;
        height: 3px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
    }

    .modal-header.bg-success {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%) !important;
    }

    .modal-header.bg-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%) !important;
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .modal-title i {
        font-size: 1.6rem;
        animation: iconPop 0.5s ease-out;
    }

    @keyframes iconPop {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
        }
    }

    .modal-body {
        padding: 2rem 2rem 1.5rem 2rem;
        color: #3b2f2f;
        background: linear-gradient(to bottom, #ffffff 0%, #fff9f3 100%);
        font-size: 1.05rem;
        line-height: 1.6;
    }

    .modal-body p {
        margin-bottom: 0;
    }

    .modal-body ul {
        padding-left: 1.5rem;
    }

    .modal-body li {
        margin-bottom: 0.5rem;
    }

    .modal-footer {
        border-top: 2px solid #f5e7d0;
        padding: 1.5rem 2rem;
        background: linear-gradient(to bottom, #fff3e2 0%, #f5e7d0 100%);
        border-radius: 0 0 20px 20px;
    }

    .modal-footer .btn {
        border-radius: 12px;
        padding: 0.65rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modal-footer .btn-success {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
    }

    .modal-footer .btn-success:hover {
        background: linear-gradient(135deg, #229954 0%, #1e8449 100%);
        box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        transform: translateY(-2px);
    }

    .modal-footer .btn-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
    }

    .modal-footer .btn-danger:hover {
        background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        transform: translateY(-2px);
    }

    .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .btn-close:hover {
        opacity: 1;
        transform: rotate(90deg);
        transition: all 0.3s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .modal-header,
        .modal-body,
        .modal-footer {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .modal-title {
            font-size: 1.2rem;
        }

        .modal-footer .btn {
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
        }
    }
</style>
