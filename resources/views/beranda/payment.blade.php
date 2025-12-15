@extends('beranda.layouts.master')
@section('title', 'Payment')

@section('content')
    <!-- Progress Bar -->
    <div class="w-full max-w-4xl mx-auto mt-28 mb-16 px-4">
        <div class="relative mb-4">
            <!-- Progress Line -->
            <div class="absolute top-1/2 left-0 right-0 h-2 bg-gray-200 transform -translate-y-1/2 rounded-full"></div>
            <div class="absolute top-1/2 left-0 h-2 bg-gradient-to-r from-[#13810A] via-emerald-500 to-[#13810A] transform -translate-y-1/2 transition-all duration-700 rounded-full shadow-lg shadow-emerald-200"
                style="width: 100%;"></div>

            <!-- Progress Steps -->
            <div class="flex justify-between relative">
                <div class="relative">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-[#13810A] to-emerald-600 rounded-full flex items-center justify-center shadow-lg shadow-emerald-300 border-4 border-white">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span
                        class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap font-bold text-gray-500">
                        Validasi Item
                    </span>
                </div>

                <div class="relative">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-[#13810A] to-emerald-600 rounded-full flex items-center justify-center shadow-lg shadow-emerald-300 border-4 border-white">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span
                        class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap font-bold text-emerald-700">
                        Konfirmasi Pesanan
                    </span>
                </div>

                <div class="relative">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-[#13810A] to-emerald-600 rounded-full flex items-center justify-center shadow-lg shadow-emerald-300 border-4 border-white">
                        <span class="text-white font-bold">3</span>
                    </div>
                    <span
                        class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap font-bold text-emerald-700">
                        Pembayaran
                    </span>
                </div>

                <div class="relative">
                    <div
                        class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-lg border-4 border-white">
                        <span class="text-gray-600 font-bold">4</span>
                    </div>
                    <span
                        class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap font-bold text-gray-500">
                        Selesai
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="mx-auto space-y-8 w-[97%] max-w-[1200px] mb-12 px-4">
        <!-- Left Column - Order Details -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Card Detail Pesanan -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-2xl p-8 border border-gray-100">
                <!-- Header -->
                <div class="flex items-center mb-8 pb-6 border-b border-gray-200">
                    <div class="bg-gradient-to-r from-emerald-50 to-green-50 p-4 rounded-xl shadow-sm">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-800">Detail Pesanan</h2>
                        <p class="text-gray-500 mt-1">Informasi booking Anda</p>
                    </div>
                </div>

                <!-- Booking Details Grid -->
                <div class="space-y-6">
                    <!-- Row 1 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="bg-gradient-to-r from-emerald-50/50 to-transparent p-4 rounded-xl border border-emerald-100">
                            <h3 class="text-sm font-semibold text-gray-600 mb-2">Lapangan</h3>
                            <p class="text-lg font-bold text-gray-900">{{ $booking['field']['name'] ?? '-' }}</p>
                        </div>
                        <div
                            class="bg-gradient-to-r from-emerald-50/50 to-transparent p-4 rounded-xl border border-emerald-100">
                            <h3 class="text-sm font-semibold text-gray-600 mb-2">Tanggal</h3>
                            <p class="text-lg font-bold text-gray-900">{{ $booking['date'] ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="bg-gradient-to-r from-emerald-50/50 to-transparent p-4 rounded-xl border border-emerald-100">
                            <h3 class="text-sm font-semibold text-gray-600 mb-2">Waktu</h3>
                            <div class="flex items-center">
                                <span class="text-lg font-bold text-gray-900">
                                    @if (isset($booking['start_time'], $booking['end_time']))
                                        {{ substr($booking['start_time'], 0, 5) }} –
                                        {{ substr($booking['end_time'], 0, 5) }}
                                    @else
                                        -
                                    @endif
                                </span>
                                <span
                                    class="ml-2 px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-medium rounded-full">
                                    {{ isset($booking['duration']) ? $booking['duration'] . ' jam' : '-' }}
                                </span>
                            </div>
                        </div>
                        <div
                            class="bg-gradient-to-r from-emerald-50/50 to-transparent p-4 rounded-xl border border-emerald-100">
                            <h3 class="text-sm font-semibold text-gray-600 mb-2">Kode Booking</h3>
                            <p class="text-lg font-bold text-gray-900">{{ $booking['code_booking'] ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="bg-gradient-to-r from-blue-50/50 to-transparent p-5 rounded-xl border border-blue-100">
                        <h3 class="font-semibold text-gray-700 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Informasi Pemesan
                        </h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nama</span>
                                <span class="font-semibold text-gray-800">{{ $booking['user']['name'] ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Email</span>
                                <span class="font-semibold text-gray-800">{{ $booking['user']['email'] ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">No. Telp</span>
                                <span class="font-semibold text-gray-800">{{ $booking['user']['no_telp'] ?? '-' }}</span>
                            </div>
                            @if ($booking['notes'] ?? '')
                                <div class="flex justify-between items-start mt-2 pt-2 border-t border-blue-100">
                                    <span class="text-gray-600">Catatan</span>
                                    <span
                                        class="font-medium text-gray-700 text-right max-w-xs">{{ $booking['notes'] }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Pricing Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-600">Harga Lapangan</span>
                            </div>
                            <span class="font-bold text-gray-900">
                                Rp {{ number_format($booking['field']['price_per_hour'] ?? 0, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                            <div class="flex items-center">
                                <div class="bg-gradient-to-r from-emerald-500 to-green-500 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-xl font-semibold text-gray-800">Total Bayar</span>
                            </div>
                            <div class="text-right">
                                <div
                                    class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-green-500 bg-clip-text text-transparent">
                                    Rp {{ number_format($booking['total_price'] ?? 0, 0, ',', '.') }}
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Sudah termasuk semua biaya</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Payment -->
            <div class="space-y-8">
                <!-- QRIS Card -->
                <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-2xl p-8 border border-gray-100">
                    <div class="flex items-center mb-8 pb-6 border-b border-gray-200">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-xl shadow-sm">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div class="ml-6">
                            <h2 class="text-2xl font-bold text-gray-800">QRIS Pembayaran</h2>
                            <p class="text-gray-500 mt-1">Scan QR untuk pembayaran (sandbox)</p>
                        </div>
                    </div>

                    @if ($qrisUrl)
                        <div class="relative group">
                            <!-- QR Code Container -->
                            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-200 mb-6">
                                <img id="qris-img"
                                    class="mx-auto w-72 h-72 object-contain rounded-xl transform transition-transform duration-300 group-hover:scale-105"
                                    src="{{ $qrisUrl }}" alt="QRIS Payment">
                            </div>

                            <!-- Payment Instructions -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-5 border border-blue-100">
                                <h3 class="font-bold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Cara Pembayaran
                                </h3>
                                <ol class="space-y-2 text-sm text-gray-600">
                                    <li class="flex items-start">
                                        <span class="text-blue-500 font-bold mr-2">1.</span>
                                        Buka aplikasi e-wallet atau mobile banking Anda
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-blue-500 font-bold mr-2">2.</span>
                                        Pilih fitur scan QRIS
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-blue-500 font-bold mr-2">3.</span>
                                        Arahkan kamera ke kode QR di atas
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-blue-500 font-bold mr-2">4.</span>
                                        Konfirmasi pembayaran sesuai nominal
                                    </li>
                                </ol>
                            </div>
                        </div>
                    @else
                        <div
                            class="bg-gradient-to-r from-red-50 to-pink-50 rounded-2xl p-8 border border-red-100 text-center">
                            <div class="bg-red-100 p-4 rounded-full inline-flex mb-4">
                                <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.698-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-red-700 mb-2">QRIS Gagal Dimuat</h3>
                            <p class="text-red-600 mb-4">Silakan refresh halaman atau hubungi admin.</p>
                            <button onclick="window.location.reload()"
                                class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg">
                                Refresh Halaman
                            </button>
                        </div>
                    @endif

                    <!-- Timer -->
                    <div class="mt-6 bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl p-4 border border-amber-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-amber-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-semibold text-gray-700">Batas Waktu Pembayaran</span>
                            </div>
                            <div
                                class="text-2xl font-bold bg-gradient-to-r from-amber-600 to-orange-500 bg-clip-text text-transparent">
                                15:00
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Selesaikan pembayaran dalam 15 menit untuk menghindari
                            pembatalan otomatis</p>
                    </div>
                </div>

                <!-- Payment Status -->
                <div
                    class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl shadow-xl p-6 border border-emerald-100">
                    <div class="flex items-center mb-4">
                        <div class="bg-emerald-100 p-3 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-emerald-600 animate-pulse" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Status Pembayaran</h3>
                            <p class="text-gray-600 text-sm">Mengecek pembayaran otomatis...</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center py-4">
                        <div class="relative">
                            <div
                                class="w-12 h-12 border-4 border-emerald-200 border-t-emerald-600 rounded-full animate-spin">
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-gray-700">Menunggu pembayaran...</p>
                            <p class="text-sm text-gray-500">Halaman akan otomatis refresh setelah pembayaran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Penting -->
    <div class="mx-auto max-w-6xl px-4 mb-12">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100 shadow-sm">
                <div class="flex items-start">
                    <div class="bg-blue-100 p-3 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-2">Instruksi Penting</h3>
                        <ul class="text-gray-600 space-y-1 text-sm">
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                Pastikan pembayaran sesuai nominal
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                Jangan tutup halaman ini selama proses
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                Simpan bukti pembayaran Anda
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-emerald-50 to-green-50 rounded-2xl p-6 border border-emerald-100 shadow-sm">
                <div class="flex items-start">
                    <div class="bg-emerald-100 p-3 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-2">Pembayaran Aman</h3>
                        <ul class="text-gray-600 space-y-1 text-sm">
                            <li class="flex items-start">
                                <span class="text-emerald-500 mr-2">•</span>
                                Transaksi diproses dengan aman
                            </li>
                            <li class="flex items-start">
                                <span class="text-emerald-500 mr-2">•</span>
                                Data terenkripsi SSL
                            </li>
                            <li class="flex items-start">
                                <span class="text-emerald-500 mr-2">•</span>
                                Didukung teknologi QRIS
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-100 shadow-sm">
                <div class="flex items-start">
                    <div class="bg-amber-100 p-3 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-2">Bantuan Cepat</h3>
                        <ul class="text-gray-600 space-y-1 text-sm">
                            <li class="flex items-start">
                                <span class="text-amber-500 mr-2">•</span>
                                Hubungi admin untuk bantuan
                            </li>
                            <li class="flex items-start">
                                <span class="text-amber-500 mr-2">•</span>
                                Masalah teknis? Refresh halaman
                            </li>
                            <li class="flex items-start">
                                <span class="text-amber-500 mr-2">•</span>
                                Email: support@futsal.com
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const bookingId = "{{ $booking_id }}";
        let timerInterval;

        // Initialize countdown timer (1 hour)
        function startTimer() {
            let timeLeft = 3600; // 1 hour in seconds
            const timerDisplay = document.querySelector('.text-2xl.font-bold');

            if (!timerDisplay) return;

            timerInterval = setInterval(() => {
                const hours = Math.floor(timeLeft / 3600);
                const minutes = Math.floor((timeLeft % 3600) / 60);
                const seconds = timeLeft % 60;

                timerDisplay.textContent =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    showTimeUpAlert();
                }
                timeLeft--;
            }, 1000);
        }

        function showTimeUpAlert() {
            Swal.fire({
                icon: 'error',
                title: 'Waktu Habis',
                text: 'Batas waktu pembayaran telah habis. Silakan buat pesanan baru.',
                confirmButtonText: 'OK',
                allowOutsideClick: false
            }).then(() => {
                window.location.href = '/';
            });
        }

        const checkStatus = () => {
            fetch(`/ajax/booking-status/${bookingId}`)
                .then(res => res.json())
                .then(data => {
                    console.log("STATUS:", data);

                    if (data.status === 'approved') {
                        clearInterval(timerInterval);

                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil!',
                            text: 'Pembayaran Anda telah dikonfirmasi. Anda akan diarahkan ke halaman tiket.',
                            timer: 2000,
                            showConfirmButton: false,
                            background: '#f0fdf4',
                            color: '#065f46'
                        });

                        setTimeout(() => {
                            window.location.href = `/ticket/${bookingId}`;
                        }, 2000);
                    }
                })
                .catch(err => console.error("FETCH ERROR:", err));
        };

        // Start timer and status check
        document.addEventListener('DOMContentLoaded', function() {
            startTimer();
            setInterval(checkStatus, 5000);
        });
    </script>
@endsection
