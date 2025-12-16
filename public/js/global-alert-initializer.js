// global-alert-initializer.js - Simple version

class GlobalAlertHijau {
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
        if (this.loader) this.loader.style.display = "flex";
    }

    hideLoader() {
        if (this.loader) this.loader.style.display = "none";
    }

    // Simple Configuration
    getSwalConfig() {
        return {
            customClass: {
                container: "swal2-container-hijau",
                popup: "swal2-popup-hijau",
                title: "swal2-title-hijau",
                htmlContainer: "swal2-html-container-hijau",
                confirmButton: "swal2-confirm-button-hijau",
                cancelButton: "swal2-cancel-button-hijau",
                icon: "swal2-icon-hijau",
            },
            buttonsStyling: false,
            backdrop: "rgba(0, 0, 0, 0.3)",
            background: "#ffffff",
            showClass: {
                popup: "swal2-show-minimal",
            },
            hideClass: {
                popup: "swal2-hide-minimal",
            },
            allowOutsideClick: true,
            heightAuto: true,
        };
    }

    // Initialize Messages
    initializeFlashMessages() {
        const swalConfig = this.getSwalConfig();

        // Success
        if (window.successMessage) {
            this.showSuccessAlert(window.successMessage, swalConfig);
        }

        // Error
        if (window.errorMessage) {
            this.showErrorAlert(window.errorMessage, swalConfig);
        }

        // Custom
        if (window.swalData) {
            this.showCustomAlert(window.swalData, swalConfig);
        }

        // Validation errors
        if (window.validationErrors && window.validationErrors.length > 0) {
            this.showValidationErrors(window.validationErrors, swalConfig);
        }

        // Verification
        if (window.verifiedSuccessMessage) {
            this.showVerificationSuccess(
                window.verifiedSuccessMessage,
                swalConfig
            );
        }

        // Logout button
        this.initializeLogoutConfirmation();
    }

    showSuccessAlert(message, swalConfig) {
        Swal.fire({
            ...swalConfig,
            icon: "success",
            title: "Berhasil!",
            text: message,
            iconColor: "#10b981",
            confirmButtonText: "OK",
            timer: 2000,
            timerProgressBar: true,
            customClass: {
                ...swalConfig.customClass,
                popup: "swal2-popup-hijau success-popup-hijau",
                confirmButton: "swal2-confirm-button-hijau success-btn",
            },
        });
    }

    showErrorAlert(message, swalConfig) {
        Swal.fire({
            ...swalConfig,
            icon: "error",
            title: "Gagal!",
            text: message,
            iconColor: "#ef4444",
            confirmButtonText: "Mengerti",
            customClass: {
                ...swalConfig.customClass,
                popup: "swal2-popup-hijau error-popup-hijau",
                confirmButton: "swal2-confirm-button-hijau error-btn",
            },
        });
    }

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
                popup: `swal2-popup-hijau ${iconType}-popup-hijau`,
                confirmButton: `swal2-confirm-button-hijau ${iconType}-btn`,
            },
        });
    }

    showValidationErrors(errors, swalConfig) {
        const errorsHtml = `
            <div style="text-align: left; max-height: 200px; overflow-y: auto; padding-right: 8px;">
                <ul style="list-style: none; padding: 0; margin: 0;">
                    ${errors
                        .map(
                            (error) => `
                        <li style="display: flex; align-items: flex-start; margin-bottom: 8px; padding: 8px; background: #fffbeb; border-radius: 6px; border-left: 3px solid #f59e0b;">
                            <span style="color: #f59e0b; font-weight: bold; margin-right: 8px;">•</span>
                            <span style="color: #92400e; font-size: 14px;">${error}</span>
                        </li>
                    `
                        )
                        .join("")}
                </ul>
            </div>
        `;

        Swal.fire({
            ...swalConfig,
            icon: "warning",
            title: "Validasi Gagal",
            html: errorsHtml,
            confirmButtonText: "Perbaiki",
            showCancelButton: true,
            cancelButtonText: "Nanti",
            width: "420px",
            iconColor: "#f59e0b",
            customClass: {
                ...swalConfig.customClass,
                popup: "swal2-popup-hijau validation-popup-hijau",
                confirmButton: "swal2-confirm-button-hijau warning-btn",
            },
        });
    }

    showLogoutConfirmation() {
        const swalConfig = this.getSwalConfig();

        Swal.fire({
            ...swalConfig,
            title: "Logout dari Sistem?",
            html: `
                <div style="text-align: center;">
                    <div style="margin-bottom: 16px;">
                        <svg style="width: 48px; height: 48px; color: #f59e0b;" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <p style="color: #4b5563; margin-bottom: 12px;">Anda akan keluar dari dashboard admin.</p>
                    <div style="background: #fffbeb; padding: 8px 12px; border-radius: 6px; color: #92400e; font-size: 13px; font-weight: 500;">
                        Pastikan semua pekerjaan sudah disimpan.
                    </div>
                </div>
            `,
            icon: "warning",
            iconColor: "#f59e0b",
            showCancelButton: true,
            confirmButtonText: "Ya, Logout",
            cancelButtonText: "Batal",
            focusCancel: true,
            customClass: {
                ...swalConfig.customClass,
                popup: "swal2-popup-hijau logout-popup-hijau",
                confirmButton: "swal2-confirm-button-hijau logout-btn",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Sedang logout...",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
                document.getElementById("logoutForm").submit();
            }
        });
    }

    showVerificationSuccess(message, swalConfig) {
        Swal.fire({
            ...swalConfig,
            title: "Verifikasi Berhasil!",
            text: message,
            icon: "success",
            iconColor: "#10b981",
            confirmButtonText: "Login Sekarang",
            showCancelButton: true,
            cancelButtonText: "Nanti",
            customClass: {
                ...swalConfig.customClass,
                popup: "swal2-popup-hijau verification-popup-hijau",
                confirmButton: "swal2-confirm-button-hijau success-btn",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = window.loginUrl || "/login";
            }
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
        if (document.getElementById("global-alert-styles-hijau")) return;

        const style = document.createElement("style");
        style.id = "global-alert-styles-hijau";
        style.textContent = `
            /* Minimal animations */
            @keyframes swal2-show-minimal {
                0% { transform: scale(0.95); opacity: 0; }
                100% { transform: scale(1); opacity: 1; }
            }
            @keyframes swal2-hide-minimal {
                0% { transform: scale(1); opacity: 1; }
                100% { transform: scale(0.95); opacity: 0; }
            }
            
            .swal2-popup-hijau {
                border-radius: 12px !important;
                padding: 24px !important;
                max-width: 420px !important;
                background: #ffffff !important;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
            }
            
            .swal2-title-hijau {
                font-size: 20px !important;
                color: #1f2937 !important;
                margin-bottom: 12px !important;
            }
            
            .swal2-html-container-hijau {
                font-size: 15px !important;
                color: #4b5563 !important;
                margin: 16px 0 24px 0 !important;
            }
            
            .swal2-confirm-button-hijau,
            .swal2-cancel-button-hijau {
                padding: 10px 24px !important;
                border-radius: 8px !important;
                font-size: 14px !important;
                min-width: 100px !important;
                height: 40px !important;
                border: none !important;
            }
            
            .swal2-confirm-button-hijau {
                background: #10b981 !important;
                color: white !important;
            }
            
            .swal2-confirm-button-hijau:hover {
                background: #059669 !important;
            }
            
            .swal2-cancel-button-hijau {
                background: white !important;
                color: #6b7280 !important;
                border: 1px solid #d1d5db !important;
            }
            
            .logout-btn {
                background: #ef4444 !important;
            }
            
            .logout-btn:hover {
                background: #dc2626 !important;
            }
            
            .success-popup-hijau {
                border-top: 3px solid #10b981 !important;
            }
            
            .error-popup-hijau {
                border-top: 3px solid #ef4444 !important;
            }
            
            .logout-popup-hijau {
                border-top: 3px solid #f59e0b !important;
            }
            
            .validation-popup-hijau {
                border-top: 3px solid #f59e0b !important;
            }
            
            .verification-popup-hijau {
                border-top: 3px solid #10b981 !important;
            }
            
            @media (max-width: 480px) {
                .swal2-popup-hijau {
                    width: 90% !important;
                    padding: 20px !important;
                }
                
                .swal2-title-hijau {
                    font-size: 18px !important;
                }
                
                .swal2-confirm-button-hijau,
                .swal2-cancel-button-hijau {
                    padding: 8px 16px !important;
                    font-size: 13px !important;
                }
            }
        `;
        document.head.appendChild(style);
    }
}

// Initialize
document.addEventListener("DOMContentLoaded", function () {
    window.globalAlert = new GlobalAlertHijau();
    globalAlert.initializeFlashMessages();
});
