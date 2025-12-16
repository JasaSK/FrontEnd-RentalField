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
    </style>

</head>
