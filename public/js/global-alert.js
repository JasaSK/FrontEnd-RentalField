// global-alert.js - Simple & Clean Hijau Theme

export class GlobalAlertHijau {
    constructor() {
        this.loader = null;
        this.initializeLoader();
        this.setupGlobalEvents();
        this.injectCustomStyles();
    }

    initializeLoader() {
        const loaderId = "globalLoader";
        this.loader = document.getElementById(loaderId);
        if (!this.loader) {
            console.warn(`Loader dengan id "${loaderId}" tidak ditemukan.`);
        }
    }

    setupGlobalEvents() {
        window.addEventListener("load", () => this.hideLoader());
    }

    showLoader() {
        if (this.loader) {
            this.loader.style.display = "flex";
        }
    }

    hideLoader() {
        if (this.loader) {
            this.loader.style.display = "none";
        }
    }

    // Simple Configuration
    getSwalConfig() {
        return {
            customClass: {
                popup: "swal-hijau-popup",
                title: "swal-hijau-title",
                htmlContainer: "swal-hijau-content",
                confirmButton: "swal-hijau-confirm",
                cancelButton: "swal-hijau-cancel",
                icon: "swal-hijau-icon",
            },
            buttonsStyling: false,
            backdrop: "rgba(0, 0, 0, 0.2)",
            background: "#ffffff",
            allowOutsideClick: false,
            allowEscapeKey: true,
            allowEnterKey: true,
            focusConfirm: true,
            heightAuto: true,
        };
    }

    // Initialize Messages
    initializeFlashMessages() {
        const swalConfig = this.getSwalConfig();

        if (window.successMessage) {
            this.showSuccessAlert(window.successMessage, swalConfig);
        }

        if (window.errorMessage) {
            this.showErrorAlert(window.errorMessage, swalConfig);
        }

        if (window.swalData) {
            this.showCustomAlert(window.swalData, swalConfig);
        }

        if (window.validationErrors && window.validationErrors.length > 0) {
            this.showValidationErrors(window.validationErrors, swalConfig);
        }

        if (window.verifiedSuccessMessage) {
            this.showVerificationSuccess(window.verifiedSuccessMessage);
        }

        this.initializeLogoutConfirmation();
    }

    // Success Alert
    showSuccessAlert(message, swalConfig) {
        Swal.fire({
            ...swalConfig,
            icon: "success",
            title: "Berhasil",
            text: message,
            iconColor: "#10b981",
            confirmButtonText: "OK",
            timer: 2000,
            timerProgressBar: true,
            customClass: {
                ...swalConfig.customClass,
                popup: "swal-hijau-popup success-popup",
                confirmButton: "swal-hijau-confirm success-btn",
            },
        });
    }

    // Error Alert
    showErrorAlert(message, swalConfig) {
        Swal.fire({
            ...swalConfig,
            icon: "error",
            title: "Terjadi Kesalahan",
            text: message,
            iconColor: "#ef4444",
            confirmButtonText: "Mengerti",
            customClass: {
                ...swalConfig.customClass,
                popup: "swal-hijau-popup error-popup",
                confirmButton: "swal-hijau-confirm error-btn",
            },
        });
    }

    // Custom Alert
    showCustomAlert(data, swalConfig) {
        const iconType = data.icon || "info";
        const iconColor =
            iconType === "success"
                ? "#10b981"
                : iconType === "error"
                ? "#ef4444"
                : iconType === "warning"
                ? "#f59e0b"
                : "#3b82f6";

        Swal.fire({
            ...swalConfig,
            icon: iconType,
            title: data.title || "",
            text: data.text || "",
            iconColor: iconColor,
            confirmButtonText: data.confirmButtonText || "OK",
            cancelButtonText: data.cancelButtonText,
            showCancelButton: !!data.cancelButtonText,
            showConfirmButton: data.showConfirmButton !== false,
            timer: data.timer,
            timerProgressBar: !!data.timer,
            customClass: {
                ...swalConfig.customClass,
                popup: `swal-hijau-popup ${iconType}-popup`,
                confirmButton: `swal-hijau-confirm ${iconType}-btn`,
            },
        });
    }

    // Validation Errors
    showValidationErrors(errors, swalConfig) {
        const errorsHtml = `
            <div class="validation-container">
                <div class="validation-header">
                    <svg class="validation-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <span class="validation-count">${
                        errors.length
                    } kesalahan ditemukan</span>
                </div>
                <div class="validation-list">
                    ${errors
                        .map(
                            (error, index) => `
                        <div class="validation-item">
                            <span class="item-number">${index + 1}.</span>
                            <span class="item-text">${error}</span>
                        </div>
                    `
                        )
                        .join("")}
                </div>
            </div>
        `;

        Swal.fire({
            ...swalConfig,
            icon: "warning",
            title: "Validasi Gagal",
            html: errorsHtml,
            iconColor: "#f59e0b",
            confirmButtonText: "Perbaiki",
            showCancelButton: true,
            cancelButtonText: "Nanti",
            width: "420px",
            customClass: {
                ...swalConfig.customClass,
                popup: "swal-hijau-popup warning-popup",
                confirmButton: "swal-hijau-confirm warning-btn",
                cancelButton: "swal-hijau-cancel",
            },
        });
    }

    // Logout Confirmation
    showLogoutConfirmation() {
        const swalConfig = this.getSwalConfig();

        Swal.fire({
            ...swalConfig,
            title: "Konfirmasi Logout",
            html: `
                <div class="logout-container">
                    <svg class="logout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <div class="logout-message">Anda akan keluar dari sistem.</div>
                </div>
            `,
            icon: "warning",
            iconColor: "#f59e0b",
            showCancelButton: true,
            confirmButtonText: "Ya, Logout",
            cancelButtonText: "Batal",
            reverseButtons: true,
            customClass: {
                ...swalConfig.customClass,
                popup: "swal-hijau-popup logout-popup",
                confirmButton: "swal-hijau-confirm logout-btn",
                cancelButton: "swal-hijau-cancel",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                this.showLoadingAlert("Sedang logout...");
                setTimeout(() => {
                    const logoutForm = document.getElementById("logoutForm");
                    if (logoutForm) logoutForm.submit();
                }, 800);
            }
        });
    }

    // Verification Success
    showVerificationSuccess(message) {
        const swalConfig = this.getSwalConfig();

        Swal.fire({
            ...swalConfig,
            title: "Verifikasi Berhasil",
            text: message,
            icon: "success",
            iconColor: "#10b981",
            confirmButtonText: "Login Sekarang",
            showCancelButton: true,
            cancelButtonText: "Nanti",
            customClass: {
                ...swalConfig.customClass,
                popup: "swal-hijau-popup verification-popup",
                confirmButton: "swal-hijau-confirm success-btn",
                cancelButton: "swal-hijau-cancel",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = window.loginUrl || "/login";
            }
        });
    }

    // Loading Alert
    showLoadingAlert(message) {
        Swal.fire({
            title: "",
            html: `
                <div class="loading-container">
                    <div class="loading-spinner"></div>
                    <div class="loading-text">${message}</div>
                </div>
            `,
            allowOutsideClick: false,
            showConfirmButton: false,
            backdrop: "rgba(255, 255, 255, 0.95)",
            background: "transparent",
            customClass: {
                popup: "swal-hijau-popup loading-popup",
            },
        });
    }

    // Initialize Logout Button
    initializeLogoutConfirmation() {
        const logoutButton = document.getElementById("logoutButton");
        if (!logoutButton) return;

        logoutButton.addEventListener("click", (e) => {
            e.preventDefault();
            this.showLogoutConfirmation();
        });
    }

    // Inject Custom Styles
    injectCustomStyles() {
        if (document.getElementById("swal-hijau-styles")) return;

        const style = document.createElement("style");
        style.id = "swal-hijau-styles";
        style.textContent = this.getCleanStyles();
        document.head.appendChild(style);
    }

    getCleanStyles() {
        return `
        /* ===== SIMPLE GREEN SWEETALERT ===== */
        
        /* Popup - Normal size seperti SweetAlert default */
        .swal-hijau-popup {
            border-radius: 8px !important;
            border: 1px solid #e5e7eb !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
            padding: 20px !important;
            width: auto !important;
            max-width: 380px !important;
            background: #ffffff !important;
        }
        
        /* Title */
        .swal-hijau-title {
            font-size: 20px !important;
            font-weight: 600 !important;
            color: #1f2937 !important;
            margin-bottom: 8px !important;
            padding: 0 !important;
            text-align: center !important;
        }
        
        /* Content */
        .swal-hijau-content {
            font-size: 16px !important;
            line-height: 1.5 !important;
            color: #6b7280 !important;
            margin: 8px 0 20px 0 !important;
            padding: 0 !important;
            text-align: center !important;
        }
        
        /* Buttons */
        .swal-hijau-confirm,
        .swal-hijau-cancel {
            padding: 8px 16px !important;
            border-radius: 6px !important;
            font-weight: 500 !important;
            font-size: 14px !important;
            transition: all 0.2s !important;
            border: 1px solid transparent !important;
            cursor: pointer !important;
        }
        
        .swal-hijau-confirm {
            background: #10b981 !important;
            color: white !important;
        }
        
        .swal-hijau-confirm:hover {
            background: #059669 !important;
        }
        
        .swal-hijau-cancel {
            background: white !important;
            color: #6b7280 !important;
            border-color: #d1d5db !important;
        }
        
        .swal-hijau-cancel:hover {
            background: #f9fafb !important;
        }
        
        /* Icon - Normal size */
        .swal-hijau-icon {
            transform: none !important;
        }
        
        .swal-hijau-icon.swal2-success {
            border-color: #10b981 !important;
            color: #10b981 !important;
        }
        
        .swal-hijau-icon.swal2-error {
            border-color: #ef4444 !important;
            color: #ef4444 !important;
        }
        
        .swal-hijau-icon.swal2-warning {
            border-color: #f59e0b !important;
            color: #f59e0b !important;
        }
        
        .swal-hijau-icon.swal2-info {
            border-color: #3b82f6 !important;
            color: #3b82f6 !important;
        }
        
        /* Special Buttons */
        .error-btn {
            background: #ef4444 !important;
        }
        
        .error-btn:hover {
            background: #dc2626 !important;
        }
        
        .warning-btn {
            background: #f59e0b !important;
        }
        
        .warning-btn:hover {
            background: #d97706 !important;
        }
        
        .logout-btn {
            background: #ef4444 !important;
        }
        
        .logout-btn:hover {
            background: #dc2626 !important;
        }
        
        /* Popup Borders */
        .success-popup {
            border-top: 4px solid #10b981 !important;
        }
        
        .error-popup {
            border-top: 4px solid #ef4444 !important;
        }
        
        .warning-popup {
            border-top: 4px solid #f59e0b !important;
        }
        
        .logout-popup {
            border-top: 4px solid #f59e0b !important;
        }
        
        .verification-popup {
            border-top: 4px solid #10b981 !important;
        }
        
        /* Validation Container */
        .validation-container {
            background: #fffbeb;
            border-radius: 6px;
            border: 1px solid #fde68a;
            overflow: hidden;
            margin: 8px 0;
        }
        
        .validation-header {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px;
            background: #fef3c7;
            border-bottom: 1px solid #fde68a;
        }
        
        .validation-icon {
            width: 20px;
            height: 20px;
            color: #92400e;
        }
        
        .validation-count {
            font-size: 14px;
            font-weight: 600;
            color: #92400e;
        }
        
        .validation-list {
            max-height: 200px;
            overflow-y: auto;
            padding: 12px;
        }
        
        .validation-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 8px;
            padding: 8px;
            background: white;
            border-radius: 4px;
        }
        
        .validation-item:last-child {
            margin-bottom: 0;
        }
        
        .item-number {
            color: #f59e0b;
            font-weight: 600;
            margin-right: 8px;
            min-width: 20px;
        }
        
        .item-text {
            color: #92400e;
            font-size: 14px;
            line-height: 1.4;
        }
        
        /* Logout Container */
        .logout-container {
            text-align: center;
        }
        
        .logout-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            color: #f59e0b;
        }
        
        .logout-message {
            color: #6b7280;
            font-size: 15px;
        }
        
        /* Loading */
        .loading-popup {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
        }
        
        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            padding: 32px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #10b981;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        .loading-text {
            color: #4b5563;
            font-size: 16px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Progress Bar */
        .swal2-timer-progress-bar {
            background: linear-gradient(90deg, #10b981, #34d399) !important;
        }
        
        /* Scrollbar */
        .validation-list::-webkit-scrollbar {
            width: 4px;
        }
        
        .validation-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .validation-list::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 2px;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .swal-hijau-popup {
                width: 90% !important;
                padding: 16px !important;
                margin: 0 auto !important;
            }
            
            .swal-hijau-title {
                font-size: 18px !important;
            }
            
            .swal-hijau-content {
                font-size: 14px !important;
            }
            
            .swal-hijau-confirm,
            .swal-hijau-cancel {
                padding: 6px 12px !important;
                font-size: 13px !important;
            }
        }
        `;
    }
}

// Initialize
document.addEventListener("DOMContentLoaded", () => {
    window.globalAlert = new GlobalAlertHijau();
    window.globalAlert.initializeFlashMessages();
});

// Export
export default GlobalAlertHijau;
