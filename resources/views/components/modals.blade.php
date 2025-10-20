<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content success-modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">
                    <i class="bi bi-check-circle-fill success-icon-pulse"></i> Success!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="success-animation mb-3">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
                <p class="mb-0 fs-5 fw-semibold text-success">{{ session('success') }}</p>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <button type="button" class="btn btn-success btn-lg px-5" data-bs-dismiss="modal">
                    <i class="bi bi-check2"></i> Got it!
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content error-modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">
                    <i class="bi bi-exclamation-triangle-fill error-icon-shake"></i> Oops!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="error-animation mb-3">
                    <svg class="error-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="error-icon__circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="error-icon__line" fill="none" d="M16 16 36 36 M36 16 16 36"/>
                    </svg>
                </div>
                @if(session('error'))
                    <p class="mb-0 fs-5 fw-semibold text-danger">{{ session('error') }}</p>
                @elseif($errors->any())
                    <strong class="text-danger d-block mb-2 fs-5">Validation Errors:</strong>
                    <ul class="list-unstyled text-start mx-auto" style="max-width: 400px;">
                        @foreach($errors->all() as $error)
                            <li class="mb-2"><i class="bi bi-x-circle text-danger me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="modal-footer justify-content-center border-0">
                <button type="button" class="btn btn-danger btn-lg px-5" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Modal Styles - Autumn Café Brown Theme */
    .modal-backdrop {
        background-color: rgba(53, 45, 29, 0.65);
    }
    
    .modal-content {
        border-radius: 24px;
        border: none;
        box-shadow: 0 20px 60px rgba(107, 86, 53, 0.5);
        overflow: hidden;
        animation: modalSlideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    @keyframes modalSlideIn {
        from {
            transform: translateY(-100px) scale(0.8);
            opacity: 0;
        }
        to {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
    }

    /* Success Modal Specific Styles */
    .success-modal-content {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    }

    .success-icon-pulse {
        animation: pulse 1.5s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Animated Checkmark */
    .success-animation {
        width: 80px;
        height: 80px;
        margin: 0 auto;
    }

    .checkmark {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: block;
        stroke-width: 3;
        stroke: #22c55e;
        stroke-miterlimit: 10;
        box-shadow: inset 0px 0px 0px #22c55e;
        animation: fill-success 0.4s ease-in-out 0.4s forwards, scale-success 0.3s ease-in-out 0.9s both;
    }

    .checkmark__circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 3;
        stroke-miterlimit: 10;
        stroke: #22c55e;
        fill: none;
        animation: stroke-success 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    .checkmark__check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        stroke: #22c55e;
        stroke-width: 3;
        animation: stroke-success 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }

    @keyframes stroke-success {
        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes scale-success {
        0%, 100% {
            transform: none;
        }
        50% {
            transform: scale3d(1.1, 1.1, 1);
        }
    }

    @keyframes fill-success {
        100% {
            box-shadow: inset 0px 0px 0px 30px #22c55e;
        }
    }

    /* Error Modal Specific Styles */
    .error-modal-content {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
    }

    .error-icon-shake {
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
        20%, 40%, 60%, 80% { transform: translateX(10px); }
    }

    /* Animated Error Icon */
    .error-animation {
        width: 80px;
        height: 80px;
        margin: 0 auto;
    }

    .error-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: block;
        stroke-width: 3;
        stroke: #ef4444;
        stroke-miterlimit: 10;
        box-shadow: inset 0px 0px 0px #ef4444;
        animation: fill-error 0.4s ease-in-out 0.4s forwards, scale-error 0.3s ease-in-out 0.9s both;
    }

    .error-icon__circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 3;
        stroke-miterlimit: 10;
        stroke: #ef4444;
        fill: none;
        animation: stroke-error 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    .error-icon__line {
        transform-origin: 50% 50%;
        stroke-dasharray: 57;
        stroke-dashoffset: 57;
        stroke: #ef4444;
        stroke-width: 3;
        animation: stroke-error 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }

    @keyframes stroke-error {
        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes scale-error {
        0%, 100% {
            transform: none;
        }
        50% {
            transform: scale3d(1.1, 1.1, 1);
        }
    }

    @keyframes fill-error {
        100% {
            box-shadow: inset 0px 0px 0px 30px #ef4444;
        }
    }

    .modal-header {
        border-bottom: none;
        padding: 2rem 2rem 1.5rem 2rem;
        border-radius: 24px 24px 0 0;
        position: relative;
    }

    .modal-header.bg-success {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%) !important;
    }

    .modal-header.bg-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
    }

    .modal-title {
        font-weight: 800;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        letter-spacing: -0.3px;
    }

    .modal-title i {
        font-size: 1.8rem;
    }

    .modal-body {
        padding: 2.5rem 2rem;
        color: #352b1d;
        font-size: 1.05rem;
        line-height: 1.7;
    }

    .modal-footer {
        border-top: none;
        padding: 1.5rem 2rem 2rem 2rem;
        background: transparent;
        border-radius: 0 0 24px 24px;
    }

    .modal-footer .btn {
        border-radius: 14px;
        padding: 0.75rem 2.5rem;
        font-weight: 700;
        font-size: 1.05rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .modal-footer .btn-success {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    }

    .modal-footer .btn-success:hover {
        background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4);
        transform: translateY(-2px);
    }

    .modal-footer .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    .modal-footer .btn-danger:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
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

        .modal-title i {
            font-size: 1.4rem;
        }

        .modal-footer .btn {
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
        }
    }
</style>
