/**
 * Global Alert System - Hijau Theme (FIXED TEXT VISIBILITY)
 * Versi final dengan perbaikan text yang tidak terlihat
 */

export class GlobalAlertSystem {
    constructor() {
        this.namespace = "global-alert-v2";
        this.isMobile = window.innerWidth < 768;
        this.initializeLoader();
        this.setupGlobalEvents();
        this.injectCustomStyles();
        this.fixIconIssues();
    }

    initializeLoader() {
        this.loader = document.getElementById("globalLoader");
        if (!this.loader) {
            console.warn('Loader dengan id "globalLoader" tidak ditemukan.');
        }
    }

    setupGlobalEvents() {
        window.addEventListener("load", () => this.hideLoader());
        window.addEventListener("resize", () => {
            this.isMobile = window.innerWidth < 768;
        });
    }

    showLoader() {
        if (this.loader) {
            this.loader.style.display = "flex";
            this.loader.style.opacity = "1";
        }
    }

    hideLoader() {
        if (this.loader) {
            this.loader.style.opacity = "0";
            setTimeout(() => {
                this.loader.style.display = "none";
            }, 500);
        }
    }

    fixIconIssues() {
        // Fix hanya untuk namespace kita
        const style = document.createElement("style");
        style.textContent = `
            /* Fix untuk namespace ${this.namespace} */
            .${this.namespace}-icon-fix {
                position: relative !important;
                box-sizing: content-box !important;
                justify-content: center !important;
                margin: 0 auto !important;
            }
            
            .${this.namespace}-success-fix {
                background-color: transparent !important;
            }
            
            /* Fix untuk icon success - centang utuh */
       
            
            /* Fix text visibility in SweetAlert2 icons */
            .${this.namespace}-icon .swal2-icon-text {
                font-weight: 900 !important;
                font-size: 3.75em !important;
            }
        `;
        document.head.appendChild(style);
    }

    getSwalConfig() {
        return {
            customClass: {
                container: `${this.namespace}-container`,
                popup: `${this.namespace}-popup`,
                title: `${this.namespace}-title`,
                htmlContainer: `${this.namespace}-content`,
                confirmButton: `${this.namespace}-confirm`,
                cancelButton: `${this.namespace}-cancel`,
                actions: `${this.namespace}-actions`,
                footer: `${this.namespace}-footer`,
            },
            buttonsStyling: false,
            backdrop: "rgba(0, 0, 0, 0.25)",
            background: "#ffffff",
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true,
            focusConfirm: true,
            heightAuto: true,
            color: "#1F2937", // Default text color untuk konten
            showClass: {
                popup: `${this.namespace}-show`,
            },
            hideClass: {
                popup: `${this.namespace}-hide`,
            },
        };
    }

    initializeFlashMessages() {
        const config = this.getSwalConfig();

        // Clear previous alerts to prevent stacking
        if (typeof Swal !== "undefined" && Swal.close) {
            Swal.close();
        }

        // Success message
        if (window.successMessage) {
            setTimeout(() => {
                this.showSuccessAlert(window.successMessage, config);
            }, 300);
        }

        // Error message
        if (window.errorMessage) {
            setTimeout(() => {
                this.showErrorAlert(window.errorMessage, config);
            }, 300);
        }

        // Custom alert
        if (window.swalData) {
            setTimeout(() => {
                this.showCustomAlert(window.swalData, config);
            }, 300);
        }

        // Validation errors
        if (window.validationErrors && window.validationErrors.length > 0) {
            setTimeout(() => {
                this.showValidationErrors(window.validationErrors, config);
            }, 300);
        }

        // Verification success
        if (window.verifiedSuccessMessage) {
            setTimeout(() => {
                this.showVerificationSuccess(
                    window.verifiedSuccessMessage,
                    config
                );
            }, 300);
        }

        // Logout confirmation
        this.initializeLogoutConfirmation();
    }

    showSuccessAlert(message, config) {
        Swal.fire({
            ...config,
            // icon: "success",
            title: "Berhasil!",
            html: `
            <div class="${this.namespace}-success-svg">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M20 6L9 17l-5-5" />
                </svg>
            </div>
            <p class="${this.namespace}-success-text">${message}</p>
        `,
            confirmButtonText: "OK",
            timer: 2500,
            timerProgressBar: true,
            color: "#1F2937", // Explicit color for text
            customClass: {
                ...config.customClass,
                popup: `${this.namespace}-popup ${this.namespace}-success`,
                confirmButton: `${this.namespace}-confirm ${this.namespace}-success-btn`,
                title: `${this.namespace}-title ${this.namespace}-success-title`,
                content: `${this.namespace}-content ${this.namespace}-success-content`,
            },
        }).then(() => {
            window.successMessage = null;
        });
    }

    showErrorAlert(message, config) {
        Swal.fire({
            ...config,
            icon: "error",
            title: "Terjadi Kesalahan",
            text: message,
            iconColor: "#EF4444",
            confirmButtonText: "Mengerti",
            color: "#1F2937", // Explicit color for text
            customClass: {
                ...config.customClass,
                popup: `${this.namespace}-popup ${this.namespace}-error`,
                confirmButton: `${this.namespace}-confirm ${this.namespace}-error-btn`,
                title: `${this.namespace}-title ${this.namespace}-error-title`,
                content: `${this.namespace}-content ${this.namespace}-error-content`,
            },
        }).then(() => {
            window.errorMessage = null;
        });
    }

    showCustomAlert(data, config) {
        const iconType = data.icon || "info";
        const iconColors = {
            success: "#10B981",
            error: "#EF4444",
            warning: "#F59E0B",
            info: "#3B82F6",
        };

        Swal.fire({
            ...config,
            icon: iconType,
            title: data.title || "",
            text: data.text || "",
            iconColor: iconColors[iconType] || "#3B82F6",
            confirmButtonText: data.confirmButtonText || "OK",
            cancelButtonText: data.cancelButtonText,
            showCancelButton: !!data.cancelButtonText,
            showConfirmButton: data.showConfirmButton !== false,
            timer: data.timer,
            timerProgressBar: !!data.timer,
            color: "#1F2937", // Explicit color for text
            customClass: {
                ...config.customClass,
                popup: `${this.namespace}-popup ${this.namespace}-${iconType}`,
                confirmButton: `${this.namespace}-confirm ${this.namespace}-${iconType}-btn`,
                title: `${this.namespace}-title ${this.namespace}-${iconType}-title`,
                content: `${this.namespace}-content ${this.namespace}-${iconType}-content`,
            },
        }).then(() => {
            window.swalData = null;
        });
    }

    showValidationErrors(errors, config) {
        const errorList = errors
            .map(
                (error, index) => `
            <li class="${this.namespace}-validation-item">
                <span class="${this.namespace}-validation-number">${
                    index + 1
                }.</span>
                <span class="${this.namespace}-validation-text">${error}</span>
            </li>
        `
            )
            .join("");

        Swal.fire({
            ...config,
            icon: "warning",
            title: "Validasi Gagal",
            html: `
                <div class="${this.namespace}-validation-header">
                    <svg class="${this.namespace}-validation-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <span class="${this.namespace}-validation-count">${errors.length} kesalahan ditemukan</span>
                </div>
                <ul class="${this.namespace}-validation-list">
                    ${errorList}
                </ul>
            `,
            iconColor: "#F59E0B",
            confirmButtonText: "Perbaiki",
            showCancelButton: true,
            cancelButtonText: "Nanti",
            reverseButtons: true,
            color: "#1F2937", // Explicit color for text
            customClass: {
                ...config.customClass,
                popup: `${this.namespace}-popup ${this.namespace}-validation`,
                confirmButton: `${this.namespace}-confirm ${this.namespace}-warning-btn`,
                cancelButton: `${this.namespace}-cancel`,
                title: `${this.namespace}-title ${this.namespace}-validation-title`,
                content: `${this.namespace}-content ${this.namespace}-validation-content`,
            },
        }).then(() => {
            window.validationErrors = null;
        });
    }

    showLogoutConfirmation() {
        const config = this.getSwalConfig();

        Swal.fire({
            ...config,
            title: "Konfirmasi Logout",
            html: `
                <div class="${this.namespace}-logout-content">
                    <svg class="${this.namespace}-logout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <p class="${this.namespace}-logout-message">Anda akan keluar dari sistem. Pastikan semua pekerjaan sudah disimpan.</p>
                    <div class="${this.namespace}-logout-warning">
                        <svg class="${this.namespace}-warning-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span>Tindakan ini tidak dapat dibatalkan</span>
                    </div>
                </div>
            `,
            icon: "warning",
            iconColor: "#F59E0B",
            showCancelButton: true,
            confirmButtonText: "Ya, Logout",
            cancelButtonText: "Batal",
            reverseButtons: true,
            focusCancel: true,
            color: "#000000ff", // Explicit color for text
            customClass: {
                ...config.customClass,
                popup: `${this.namespace}-popup ${this.namespace}-logout`,
                confirmButton: `${this.namespace}-confirm ${this.namespace}-logout-btn`,
                cancelButton: `${this.namespace}-cancel`,
                title: `${this.namespace}-title ${this.namespace}-logout-title`,
                content: `${this.namespace}-content ${this.namespace}-logout-content`,
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

    showCancelBookingConfirmation(form) {
        const config = this.getSwalConfig();

        Swal.fire({
            ...config,
            title: "Batalkan Booking?",
            html: `
            <div class="${this.namespace}-cancel-booking-content">
                <svg class="${this.namespace}-cancel-booking-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                <p class="${this.namespace}-cancel-booking-message">
                    Apakah Anda yakin ingin membatalkan booking ini?
                </p>
                <div class="${this.namespace}-cancel-booking-warning">
                    <svg class="${this.namespace}-warning-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Tindakan ini tidak dapat dibatalkan</span>
                </div>
            </div>
        `,
            icon: "warning",
            iconColor: "#F59E0B",
            showCancelButton: true,
            confirmButtonText: "Ya, Batalkan",
            cancelButtonText: "Kembali",
            reverseButtons: true,
            focusCancel: true,
            customClass: {
                ...config.customClass,
                popup: `${this.namespace}-popup ${this.namespace}-cancel-booking`,
                confirmButton: `${this.namespace}-confirm ${this.namespace}-cancel-booking-btn`,
                cancelButton: `${this.namespace}-cancel`,
                title: `${this.namespace}-title ${this.namespace}-cancel-booking-title`,
                content: `${this.namespace}-content ${this.namespace}-cancel-booking-content`,
            },
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan loading
                this.showLoadingAlert("Membatalkan booking...");

                // Submit form setelah delay singkat
                setTimeout(() => {
                    form.submit();
                }, 800);
            }
        });
    }

    // Static method untuk penggunaan dari luar
    static showCancelBooking(formElement) {
        const instance = GlobalAlertSystem.getInstance();
        instance.showCancelBookingConfirmation(formElement);
    }
    showVerificationSuccess(message, config) {
        Swal.fire({
            ...config,
            title: "Verifikasi Berhasil!",
            text: message,
            // icon: "success",
            html: `
            <div class="${this.namespace}-success-svg">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M20 6L9 17l-5-5" />
                </svg>
            </div>
            <p class="${this.namespace}-success-text">${message}</p>
        `,
            confirmButtonText: "Login Sekarang",
            showCancelButton: true,
            cancelButtonText: "Nanti",
            reverseButtons: true,
            color: "#1F2937", // Explicit color for text
            customClass: {
                ...config.customClass,
                popup: `${this.namespace}-popup ${this.namespace}-verification`,
                confirmButton: `${this.namespace}-confirm ${this.namespace}-success-btn`,
                cancelButton: `${this.namespace}-cancel`,
                title: `${this.namespace}-title ${this.namespace}-verification-title`,
                content: `${this.namespace}-content ${this.namespace}-verification-content`,
            },
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = window.loginUrl || "/login";
            }
        });
    }

    showLoadingAlert(message) {
        Swal.fire({
            title: "",
            html: `
                <div class="${this.namespace}-loading-container">
                    <div class="${this.namespace}-loading-spinner"></div>
                    <div class="${this.namespace}-loading-text">${message}</div>
                </div>
            `,
            allowOutsideClick: false,
            showConfirmButton: false,
            backdrop: "rgba(255, 255, 255, 0.95)",
            background: "transparent",
            color: "#1F2937", // Explicit color for text
            customClass: {
                popup: `${this.namespace}-popup ${this.namespace}-loading`,
                container: `${this.namespace}-container ${this.namespace}-loading-wrapper`,
            },
        });
    }

    initializeLogoutConfirmation() {
        const logoutButton = document.getElementById("logoutButton");
        if (!logoutButton) return;

        logoutButton.addEventListener("click", (e) => {
            e.preventDefault();
            this.showLogoutConfirmation();
        });
    }

    injectCustomStyles() {
        if (document.getElementById(`${this.namespace}-styles`)) return;

        const style = document.createElement("style");
        style.id = `${this.namespace}-styles`;
        style.textContent = this.getStyles();
        document.head.appendChild(style);
    }

    getStyles() {
        return `
            /* ===== GLOBAL ALERT SYSTEM - VERSION 2 ===== */
            /* Namespace: ${this.namespace} - FIXED TEXT VISIBILITY */
            
            :root {
                --${this.namespace}-primary: #10B981;
                --${this.namespace}-primary-dark: #059669;
                --${this.namespace}-error: #EF4444;
                --${this.namespace}-error-dark: #DC2626;
                --${this.namespace}-warning: #F59E0B;
                --${this.namespace}-warning-dark: #D97706;
                --${this.namespace}-info: #3B82F6;
                --${this.namespace}-gray-50: #F9FAFB;
                --${this.namespace}-gray-100: #F3F4F6;
                --${this.namespace}-gray-200: #E5E7EB;
                --${this.namespace}-gray-300: #D1D5DB;
                --${this.namespace}-gray-600: #4B5563;
                --${this.namespace}-gray-700: #374151;
                --${this.namespace}-gray-800: #1F2937;
                --${this.namespace}-gray-900: #111827;
                --${this.namespace}-text-primary: #1F2937;
                --${this.namespace}-text-secondary: #4B5563;
                --${this.namespace}-text-light: #6B7280;
                --${this.namespace}-white: #FFFFFF;
                --${this.namespace}-black: #000000;
            }

            /* Loader - Ensure text is visible */
            #globalLoader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: var(--${this.namespace}-white);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                transition: opacity 0.5s ease;
            }

            #globalLoader .loader-text {
                color: var(--${this.namespace}-gray-700);
                font-size: 16px;
                font-weight: 500;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            }

            /* Popup Base - FIXED TEXT COLORS */
            .${this.namespace}-container {
                padding: 16px;
            }

            .${this.namespace}-popup {
                border-radius: 16px;
                padding: 32px 24px 24px 24px;
                width: auto;
                max-width: 420px;
                background: var(--${this.namespace}-white);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                border: 1px solid var(--${this.namespace}-gray-200);
                color: var(--${this.namespace}-text-primary) !important; /* Force text color */
            }

            /* Title - HIGH CONTRAST */
            .${this.namespace}-title {
                font-size: 20px;
                font-weight: 600;
                color: var(--${this.namespace}-gray-900) !important;
                margin-bottom: 12px;
                text-align: center;
                padding: 0;
                margin-top: 0;
                line-height: 1.4;
                text-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
            }

            /* Content - MEDIUM CONTRAST */
            .${this.namespace}-content {
                font-size: 15px;
                color: var(--${this.namespace}-gray-700) !important;
                line-height: 1.5;
                margin: 0 0 24px 0;
                padding: 0;
                text-align: center;
                font-weight: 400;
            }

            /* Special content classes for different alert types */
            .${this.namespace}-success-content {
                color: var(--${this.namespace}-gray-700) !important;
            }

            .${this.namespace}-error-content {
                color: var(--${this.namespace}-gray-700) !important;
            }

            .${this.namespace}-warning-content {
                color: var(--${this.namespace}-gray-700) !important;
            }

            .${this.namespace}-info-content {
                color: var(--${this.namespace}-gray-700) !important;
            }

            .${this.namespace}-validation-content {
                color: var(--${this.namespace}-gray-700) !important;
            }

            .${this.namespace}-logout-content {
                color: var(--${this.namespace}-gray-700) !important;
            }

            .${this.namespace}-verification-content {
                color: var(--${this.namespace}-gray-700) !important;
            }

            /* Buttons Container */
            .${this.namespace}-actions {
                margin: 0;
                gap: 12px;
                padding: 0;
            }

            /* Button Base */
            .${this.namespace}-confirm,
            .${this.namespace}-cancel {
                min-width: 100px;
                padding: 10px 24px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 500;
                transition: all 0.2s ease;
                border: none;
                cursor: pointer;
                margin: 0;
                color: var(--${this.namespace}-white) !important;
                text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            }

            .${this.namespace}-confirm {
                background: var(--${this.namespace}-primary);
                color: var(--${this.namespace}-white) !important;
            }

            .${this.namespace}-confirm:hover {
                background: var(--${this.namespace}-primary-dark);
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
            }

            .${this.namespace}-cancel {
                background: var(--${this.namespace}-white);
                color: var(--${this.namespace}-gray-700) !important;
                border: 1px solid var(--${this.namespace}-gray-300);
            }

            .${this.namespace}-cancel:hover {
                background: var(--${this.namespace}-gray-50);
                border-color: var(--${this.namespace}-gray-300);
                color: var(--${this.namespace}-gray-800) !important;
            }

            /* Icon - FIXED VISIBILITY - ICON CENTANG UTUH */
            .${this.namespace}-icon {
                transform: scale(1);
                margin: 0 auto 20px;
                border-width: 4px !important;
            }
            
            .${this.namespace}-success-icon {
                border-color: #10B981 !important;
            }
            
            .${this.namespace}-success-icon .swal2-success-line-tip,
            .${this.namespace}-success-icon .swal2-success-line-long {
                background-color: #10B981 !important;
                height: 4px !important;
                border-radius: 2px !important;
            }
            
            .${this.namespace}-success-icon .swal2-success-line-tip {
                width: 12px !important;
                left: 8px !important;
                top: 18px !important;
            }
            
            .${this.namespace}-success-icon .swal2-success-line-long {
                width: 22px !important;
                right: 8px !important;
                top: 16px !important;
            }

            /* Ensure icon internal elements are visible */
            .${this.namespace}-icon .swal2-success-line-tip,
            .${this.namespace}-icon .swal2-success-line-long,
            .${this.namespace}-icon .swal2-x-mark-line-left,
            .${this.namespace}-icon .swal2-x-mark-line-right,
            .${this.namespace}-icon .swal2-warning [class^='swal2-warning-circular-line'],
            .${this.namespace}-icon .swal2-info [class^='swal2-info-circular-line'] {
                background-color: currentColor !important;
            }

            /* Special Button Types */
            .${this.namespace}-success-btn {
                background: var(--${this.namespace}-primary) !important;
                color: var(--${this.namespace}-white) !important;
            }

            .${this.namespace}-success-btn:hover {
                background: var(--${this.namespace}-primary-dark) !important;
            }

            .${this.namespace}-error-btn {
                background: var(--${this.namespace}-error) !important;
                color: var(--${this.namespace}-white) !important;
            }

            .${this.namespace}-error-btn:hover {
                background: var(--${this.namespace}-error-dark) !important;
            }

            .${this.namespace}-warning-btn {
                background: var(--${this.namespace}-warning) !important;
                color: var(--${this.namespace}-white) !important;
            }

            .${this.namespace}-warning-btn:hover {
                background: var(--${this.namespace}-warning-dark) !important;
            }

            .${this.namespace}-logout-btn {
                background: var(--${this.namespace}-error) !important;
                color: var(--${this.namespace}-white) !important;
            }

            .${this.namespace}-logout-btn:hover {
                background: var(--${this.namespace}-error-dark) !important;
            }

            /* Popup Variations */
            .${this.namespace}-success {
                border-top: 4px solid var(--${this.namespace}-primary);
            }

            .${this.namespace}-error {
                border-top: 4px solid var(--${this.namespace}-error);
            }

            .${this.namespace}-warning {
                border-top: 4px solid var(--${this.namespace}-warning);
            }

            .${this.namespace}-logout {
                border-top: 4px solid var(--${this.namespace}-warning);
            }

            .${this.namespace}-validation {
                border-top: 4px solid var(--${this.namespace}-warning);
            }

            .${this.namespace}-verification {
                border-top: 4px solid var(--${this.namespace}-primary);
            }

            /* Validation Errors - HIGH CONTRAST */
            .${this.namespace}-validation-header {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 12px 16px;
                background: #FFFBEB;
                border-radius: 8px;
                margin-bottom: 16px;
                border-left: 4px solid var(--${this.namespace}-warning);
            }

            .${this.namespace}-validation-icon {
                width: 20px;
                height: 20px;
                color: #92400E;
                flex-shrink: 0;
            }

            .${this.namespace}-validation-count {
                font-size: 14px;
                font-weight: 600;
                color: #92400E !important;
            }

            .${this.namespace}-validation-list {
                max-height: 200px;
                overflow-y: auto;
                padding: 0;
                margin: 0;
            }

            .${this.namespace}-validation-item {
                display: flex;
                align-items: flex-start;
                padding: 10px 12px;
                margin-bottom: 8px;
                background: var(--${this.namespace}-white);
                border-radius: 6px;
                border: 1px solid #FDE68A;
                transition: background 0.2s;
            }

            .${this.namespace}-validation-item:hover {
                background: #FFFBEB;
            }

            .${this.namespace}-validation-number {
                color: var(--${this.namespace}-warning) !important;
                font-weight: 600;
                margin-right: 10px;
                min-width: 20px;
            }

            .${this.namespace}-validation-text {
                color: #92400E !important;
                font-size: 14px;
                line-height: 1.4;
                font-weight: 500;
            }

            /* Logout Content - HIGH CONTRAST */
            .${this.namespace}-logout-content {
                text-align: center;
            }

            .${this.namespace}-logout-icon {
                width: 64px;
                height: 64px;
                margin: 0 auto 16px;
                color: var(--${this.namespace}-warning);
            }

            .${this.namespace}-logout-message {
                color: var(--${this.namespace}-gray-700) !important;
                font-size: 15px;
                margin-bottom: 16px;
                line-height: 1.5;
                font-weight: 400;
            }

            .${this.namespace}-logout-warning {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 10px 16px;
                background: #FEF3C7;
                border-radius: 8px;
                color: #92400E !important;
                font-size: 13px;
                font-weight: 500;
            }

            .${this.namespace}-warning-icon {
                width: 16px;
                height: 16px;
                color: #F59E0B;
            }

            /* Loading Alert - VISIBLE TEXT */
            .${this.namespace}-loading {
                background: transparent;
                box-shadow: none;
                border: none;
                padding: 0;
            }

            .${this.namespace}-loading-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 16px;
                padding: 32px;
                background: var(--${this.namespace}-white);
                border-radius: 16px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }

            .${this.namespace}-loading-spinner {
                width: 48px;
                height: 48px;
                border: 3px solid var(--${this.namespace}-gray-200);
                border-top: 3px solid var(--${this.namespace}-primary);
                border-radius: 50%;
                animation: ${this.namespace}-spin 1s linear infinite;
            }

            .${this.namespace}-loading-text {
                color: var(--${this.namespace}-gray-700) !important;
                font-size: 16px;
                font-weight: 500;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            }

            @keyframes ${this.namespace}-spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            /* Progress Bar */
            .${this.namespace}-popup .swal2-timer-progress-bar {
                background: linear-gradient(90deg, var(--${this.namespace}-primary), var(--${this.namespace}-primary-dark));
                height: 3px;
                border-radius: 3px;
            }

            /* Force SweetAlert2 default text to be visible */
            .${this.namespace}-popup .swal2-title,
            .${this.namespace}-popup .swal2-html-container,
            .${this.namespace}-popup .swal2-content {
                color: var(--${this.namespace}-gray-800) !important;
                opacity: 1 !important;
                visibility: visible !important;
            }

            /* Animations */
            @keyframes ${this.namespace}-show {
                0% {
                    transform: scale(0.9);
                    opacity: 0;
                }
                100% {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            @keyframes ${this.namespace}-hide {
                0% {
                    transform: scale(1);
                    opacity: 1;
                }
                100% {
                    transform: scale(0.9);
                    opacity: 0;
                }
            }

            /* ===== CRITICAL FIXES FOR TEXT VISIBILITY ===== */
            
            /* Ensure all text inside our popup is visible */
            .${this.namespace}-popup,
            .${this.namespace}-popup * {
                color: inherit !important;
                opacity: 1 !important;
                visibility: visible !important;
            }

            /* Override any potential hidden text styles */
            .${this.namespace}-popup [style*="color: transparent"],
            .${this.namespace}-popup [style*="opacity: 0"],
            .${this.namespace}-popup [style*="visibility: hidden"] {
                color: var(--${this.namespace}-gray-700) !important;
                opacity: 1 !important;
                visibility: visible !important;
            }

            /* Fix for potential z-index issues */
            .${this.namespace}-popup {
                z-index: 1060 !important;
            }

            .${this.namespace}-popup .swal2-title {
                z-index: 2 !important;
                position: relative !important;
            }

            .${this.namespace}-popup .swal2-html-container {
                z-index: 2 !important;
                position: relative !important;
            }

            /* ===== RESPONSIVE ===== */
            
            /* Tablet */
            @media (max-width: 768px) {
                .${this.namespace}-popup {
                    padding: 28px 20px 20px 20px;
                    max-width: 90%;
                    margin: 0 auto;
                }

                .${this.namespace}-title {
                    font-size: 18px;
                }

                .${this.namespace}-content {
                    font-size: 14px;
                }

                .${this.namespace}-confirm,
                .${this.namespace}-cancel {
                    padding: 9px 20px;
                    min-width: 90px;
                    font-size: 13px;
                }

                .${this.namespace}-icon {
                    width: 72px;
                    height: 72px;
                    margin-bottom: 16px;
                }

                .${this.namespace}-validation-text,
                .${this.namespace}-logout-message,
                .${this.namespace}-loading-text {
                    font-size: 13px;
                }
            }

            /* Mobile */
            @media (max-width: 480px) {
                .${this.namespace}-popup {
                    padding: 24px 16px 16px 16px;
                    border-radius: 12px;
                    width: calc(100% - 32px);
                }

                .${this.namespace}-title {
                    font-size: 16px;
                    margin-bottom: 8px;
                }

                .${this.namespace}-content {
                    font-size: 13px;
                    margin-bottom: 20px;
                }

                .${this.namespace}-actions {
                    flex-direction: column;
                    gap: 8px;
                }

                .${this.namespace}-confirm,
                .${this.namespace}-cancel {
                    width: 100%;
                    padding: 10px;
                    font-size: 14px;
                }

                .${this.namespace}-icon {
                    width: 64px;
                    height: 64px;
                    border-width: 3px;
                }

                .${this.namespace}-validation-header {
                    flex-direction: column;
                    text-align: center;
                    gap: 8px;
                }

                .${this.namespace}-validation-list {
                    max-height: 150px;
                }

                .${this.namespace}-logout-icon {
                    width: 48px;
                    height: 48px;
                }

                .${this.namespace}-logout-message {
                    font-size: 14px;
                }

                .${this.namespace}-logout-warning {
                    flex-direction: column;
                    text-align: center;
                    gap: 6px;
                    padding: 8px 12px;
                    font-size: 12px;
                }

                .${this.namespace}-loading-container {
                    padding: 24px;
                }

                .${this.namespace}-loading-spinner {
                    width: 40px;
                    height: 40px;
                }

                .${this.namespace}-loading-text {
                    font-size: 14px;
                }
            }

            /* Small Mobile */
            @media (max-width: 360px) {
                .${this.namespace}-popup {
                    padding: 20px 12px 12px 12px;
                    width: calc(100% - 24px);
                }

                .${this.namespace}-title {
                    font-size: 15px;
                }

                .${this.namespace}-content {
                    font-size: 12px;
                }

                .${this.namespace}-icon {
                    width: 56px;
                    height: 56px;
                }

                .${this.namespace}-validation-text {
                    font-size: 12px;
                }
            }

            /* ===== DARK MODE SUPPORT ===== */
            
            @media (prefers-color-scheme: dark) {
                .${this.namespace}-popup {
                    background: #1F2937;
                    border-color: #374151;
                }

                .${this.namespace}-title {
                    color: #F9FAFB !important;
                }

                .${this.namespace}-content {
                    color: #D1D5DB !important;
                }

                .${this.namespace}-validation-item {
                    background: #374151;
                    border-color: #6B7280;
                }

                .${this.namespace}-validation-item:hover {
                    background: #4B5563;
                }

                .${this.namespace}-validation-text {
                    color: #FBBF24 !important;
                }

                .${this.namespace}-logout-message {
                    color: #6a6a6aff !important;
                }

                .${this.namespace}-cancel {
                    background: #374151;
                    color: #D1D5DB !important;
                    border-color: #4B5563;
                }

                .${this.namespace}-cancel:hover {
                    background: #4B5563;
                    color: #FFFFFF !important;
                }

                .${this.namespace}-loading-container {
                    background: #1F2937;
                }

                .${this.namespace}-loading-text {
                    color: #D1D5DB !important;
                }

                /* Dark mode specific text fixes */
                .${this.namespace}-success-content,
                .${this.namespace}-error-content,
                .${this.namespace}-warning-content,
                .${this.namespace}-info-content,
                .${this.namespace}-validation-content,
                .${this.namespace}-logout-content,
                .${this.namespace}-verification-content {
                    color: #100c0cff !important;
                }
            }

            /* Force light mode if dark mode causes issues */
            .${this.namespace}-force-light {
                background: #FFFFFF !important;
                color: #1F2937 !important;
            }

            .${this.namespace}-force-light .${this.namespace}-title {
                color: #111827 !important;
            }

            .${this.namespace}-force-light .${this.namespace}-content {
                color: #374151 !important;
            }

            /* === SUCCESS ICON UTUH (SVG) === */
.global-alert-v2-success-svg {
    width: 72px;
    height: 72px;
    margin: 0 auto 16px;
    border-radius: 50%;
    background: #ECFDF5;
    display: flex;
    align-items: center;
    justify-content: center;
}

.global-alert-v2-success-svg svg {
    width: 36px;
    height: 36px;
    stroke: #10B981;
    stroke-width: 3;
    fill: none;
    stroke-linecap: round;
    stroke-linejoin: round;
}

/* Responsive */
@media (max-width: 480px) {
    .global-alert-v2-success-svg {
        width: 60px;
        height: 60px;
    }

    .global-alert-v2-success-svg svg {
        width: 30px;
        height: 30px;
    }
}

          /* Cancel Booking Confirmation */
.${this.namespace}-cancel-booking-content {
    text-align: center;
}

.${this.namespace}-cancel-booking-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 16px;
    color: var(--${this.namespace}-warning);
}

.${this.namespace}-cancel-booking-message {
    color: var(--${this.namespace}-gray-700) !important;
    font-size: 16px;
    margin-bottom: 16px;
    line-height: 1.5;
    font-weight: 500;
}

.${this.namespace}-cancel-booking-warning {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 16px;
    background: #FEF3C7;
    border-radius: 8px;
    color: #92400E !important;
    font-size: 14px;
    font-weight: 500;
    margin-top: 8px;
}

.${this.namespace}-cancel-booking-btn {
    background: var(--${this.namespace}-error) !important;
    color: var(--${this.namespace}-white) !important;
}

.${this.namespace}-cancel-booking-btn:hover {
    background: var(--${this.namespace}-error-dark) !important;
}

.${this.namespace}-cancel-booking {
    border-top: 4px solid var(--${this.namespace}-warning);
}

/* Responsive */
@media (max-width: 768px) {
    .${this.namespace}-cancel-booking-icon {
        width: 56px;
        height: 56px;
    }
    
    .${this.namespace}-cancel-booking-message {
        font-size: 15px;
    }
    
    .${this.namespace}-cancel-booking-warning {
        font-size: 13px;
        padding: 10px 12px;
    }
}

@media (max-width: 480px) {
    .${this.namespace}-cancel-booking-icon {
        width: 48px;
        height: 48px;
    }
    
    .${this.namespace}-cancel-booking-message {
        font-size: 14px;
    }
    
    .${this.namespace}-cancel-booking-warning {
        flex-direction: column;
        text-align: center;
        gap: 6px;
        font-size: 12px;
    }
}      
        `;
    }

    // Public API untuk digunakan dari luar
    static getInstance() {
        if (!window._globalAlertInstance) {
            window._globalAlertInstance = new GlobalAlertSystem();
        }
        return window._globalAlertInstance;
    }

    static showSuccess(message) {
        const instance = GlobalAlertSystem.getInstance();
        const config = instance.getSwalConfig();
        instance.showSuccessAlert(message, config);
    }

    static showError(message) {
        const instance = GlobalAlertSystem.getInstance();
        const config = instance.getSwalConfig();
        instance.showErrorAlert(message, config);
    }

    static showCustom(data) {
        const instance = GlobalAlertSystem.getInstance();
        const config = instance.getSwalConfig();
        instance.showCustomAlert(data, config);
    }
}

// Initialize dengan cara yang aman
(function () {
    const initGlobalAlert = () => {
        if (typeof Swal === "undefined") {
            console.warn("SweetAlert2 belum dimuat. Menunda inisialisasi...");
            setTimeout(initGlobalAlert, 100);
            return;
        }

        // Hanya inisialisasi jika belum ada
        if (!window.GlobalAlert) {
            window.GlobalAlert = GlobalAlertSystem;
            const instance = GlobalAlertSystem.getInstance();

            // Tunggu DOM siap sebelum inisialisasi flash messages
            if (document.readyState === "loading") {
                document.addEventListener("DOMContentLoaded", () => {
                    setTimeout(() => {
                        instance.initializeFlashMessages();
                    }, 300);
                });
            } else {
                setTimeout(() => {
                    instance.initializeFlashMessages();
                }, 300);
            }
        }
    };

    // Mulai inisialisasi
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initGlobalAlert);
    } else {
        initGlobalAlert();
    }
})();

export default GlobalAlertSystem;
