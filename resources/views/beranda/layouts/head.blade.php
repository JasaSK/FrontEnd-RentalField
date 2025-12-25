<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EZFutsal</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Banner Dot Active */
        .dot-active {
            background-color: #13810A !important;
            transform: scale(1.2);
            opacity: 1;
        }

        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Scope animate.css hanya untuk SweetAlert */
        .swal2-container .animate__animated,
        .swal2-container .animate__fadeInDown,
        .swal2-container .animate__fadeOutUp,
        .swal2-container .animate__faster {
            /* Biarkan animasi hanya di dalam SweetAlert */
        }

        /* Nonaktifkan animasi untuk elemen lain */
        img:not(.swal2-container img),
        .card:not(.swal2-container .card),
        .btn:not(.swal2-container .btn) {
            animation: none !important;
        }

        @keyframes ballMove {
            0% {
                left: 0;
                transform: translateY(-50%) scale(1);
            }

            25% {
                transform: translateY(-50%) scale(1.1);
            }

            50% {
                left: 50%;
                transform: translateY(-50%) translateX(-50%) scale(1);
            }

            75% {
                transform: translateY(-50%) translateX(-50%) scale(1.1);
            }

            100% {
                left: 100%;
                transform: translateY(-50%) translateX(-100%) scale(1);
            }
        }

        #loader {
            opacity: 1;
            visibility: visible;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        #loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        @keyframes slowZoom {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }

        /* Custom select styling */
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 1rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        /* Custom date input */
        input[type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: none !important;
            padding-right: 3rem;
            /* Space untuk ikon custom */
        }

        /* Untuk browser yang support -moz- */
        select::-ms-expand {
            display: none;
        }

        /* Untuk Firefox */
        @-moz-document url-prefix() {
            select {
                text-indent: 0.01px;
                text-overflow: '';
            }
        }
    </style>

</head>
