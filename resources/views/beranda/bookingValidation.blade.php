@extends('beranda.layouts.master')
@section('title', 'Konfirmasi Booking')

@section('content')
    <!-- Progress Bar -->
    <div class="w-full max-w-4xl mx-auto mt-28 mb-16 px-4">
        <div class="relative mb-4">

            <!-- Progress Line -->
            <div class="absolute top-1/2 left-0 right-0 h-2 bg-gray-200 transform -translate-y-1/2 rounded-full"></div>
            <div class="absolute top-1/2 left-0 h-2 bg-gradient-to-r from-[#13810A] to-emerald-500 transform -translate-y-1/2 transition-all duration-700 rounded-full shadow-lg shadow-emerald-200"
                style="width: 66%;"></div>

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
                        class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap font-bold text-emerald-700">
                        Validasi Item
                    </span>
                </div>

                <div class="relative">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-[#13810A] to-emerald-600 rounded-full flex items-center justify-center shadow-lg shadow-emerald-300 border-4 border-white">
                        <span class="text-white font-bold">2</span>
                    </div>
                    <span
                        class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap font-bold text-emerald-700">
                        Konfirmasi Pesanan
                    </span>
                </div>

                <div class="relative">
                    <div
                        class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-lg border-4 border-white">
                        <span class="text-gray-600 font-bold">3</span>
                    </div>
                    <span
                        class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap font-bold text-gray-500">
                        Pembayaran
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Konten -->
    <div class="mx-auto space-y-8 w-[97%] max-w-[1000px] mb-12 px-4">
        <!-- Card Detail Pesanan -->
        <div
            class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-2xl p-8 border border-gray-100 transform transition-all duration-300 hover:shadow-xl">
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
                    <p class="text-gray-500 mt-1">Review dan konfirmasi pesanan Anda</p>
                </div>
            </div>

            <!-- Booking Info Grid -->
            <div class="grid md:grid-cols-2 gap-6 mb-10">
                <!-- Left Column -->
                <div class="space-y-5">
                    <div
                        class="bg-gradient-to-r from-emerald-50/50 to-transparent p-5 rounded-xl border border-emerald-100">
                        <div class="flex items-center mb-3">
                            <div class="bg-emerald-100 p-2 rounded-lg mr-4">
                                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-700">Lapangan</h3>
                        </div>
                        <p class="text-2xl font-bold text-gray-900 pl-12">{{ $booking['field']['name'] ?? '-' }}</p>
                    </div>

                    <div
                        class="bg-gradient-to-r from-emerald-50/50 to-transparent p-5 rounded-xl border border-emerald-100">
                        <div class="flex items-center mb-3">
                            <div class="bg-emerald-100 p-2 rounded-lg mr-4">
                                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-700">Tanggal</h3>
                        </div>
                        <p class="text-xl font-bold text-gray-900 pl-12">{{ $booking['date'] ?? '-' }}</p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-5">
                    <div
                        class="bg-gradient-to-r from-emerald-50/50 to-transparent p-5 rounded-xl border border-emerald-100">
                        <div class="flex items-center mb-3">
                            <div class="bg-emerald-100 p-2 rounded-lg mr-4">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-700">Waktu</h3>
                        </div>
                        <div class="flex items-center pl-12">
                            <span
                                class="text-2xl font-bold text-gray-900 bg-gradient-to-r from-emerald-600 to-green-500 bg-clip-text text-transparent">
                                @if (isset($booking['start_time'], $booking['end_time']))
                                    {{ substr($booking['start_time'], 0, 5) }} – {{ substr($booking['end_time'], 0, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                            <span class="ml-3 px-3 py-1 bg-emerald-100 text-emerald-700 text-sm font-medium rounded-full">
                                {{ isset($booking['duration']) ? $booking['duration'] . ' jam' : '-' }}
                            </span>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-r from-emerald-50/50 to-transparent p-5 rounded-xl border border-emerald-100">
                        <div class="flex items-center mb-3">
                            <div class="bg-emerald-100 p-2 rounded-lg mr-4">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-700">Kode Booking</h3>
                        </div>
                        <p class="text-2xl font-bold text-gray-900 pl-12">{{ $booking['code_booking'] ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Pricing Section -->
            <div class="bg-gradient-to-r from-gray-50 to-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <div class="space-y-4">
                    <!-- Harga per Jam -->
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-emerald-100 p-2 rounded-lg mr-4">
                                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-600">Harga Lapangan per Jam</span>
                        </div>
                        <span class="text-lg font-bold text-gray-900">
                            Rp {{ number_format($booking['field']['price_per_hour'] ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Total Bayar -->
                    <div class="flex justify-between items-center pt-4">
                        <div class="flex items-center">
                            <div class="bg-gradient-to-r from-emerald-500 to-green-500 p-2 rounded-lg mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-6 mt-12 mb-16 px-4">
        <!-- Konfirmasi Button -->
        <form action="{{ route('beranda.payment.create', $booking['id']) }}" method="POST" class="w-full sm:w-auto">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking['id'] ?? '' }}">

            <button type="submit"
                class="group relative w-full sm:w-auto bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 text-white px-10 py-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 flex items-center justify-center">
                <!-- Animated Ring -->
                <div
                    class="absolute -inset-1 rounded-xl bg-gradient-to-r from-emerald-400 to-green-300 opacity-0 group-hover:opacity-30 blur transition duration-300">
                </div>

                <span class="relative flex items-center">
                    Konfirmasi & Lanjut Pembayaran
                    <svg class="ml-3 w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
            </button>
        </form>

        <!-- Cancel Button -->
        <form action="{{ route('beranda.bookingValidation.cancel', $booking['id'] ?? '') }}" method="POST"
            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?');" class="w-full sm:w-auto">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="group w-full sm:w-auto bg-gradient-to-r from-red-50 to-white hover:from-red-100 text-red-600 px-10 py-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-md hover:shadow-xl border-2 border-red-200 hover:border-red-300 flex items-center justify-center">
                <span class="relative flex items-center">
                    <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batalkan Booking
                </span>
            </button>
        </form>
    </div>

    <!-- Informasi Tambahan -->
    <div class="mx-auto max-w-3xl px-4 mb-12">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100 shadow-sm">
            <div class="flex items-start">
                <div class="bg-blue-100 p-3 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 mb-2">Informasi Penting</h3>
                    <ul class="text-gray-600 space-y-1 text-sm">
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            Pesanan akan diproses setelah pembayaran dikonfirmasi
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            Batas waktu pembayaran: 1x24 jam setelah pemesanan
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            Hubungi admin jika ada perubahan jadwal
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        const bookingId = "{{ $booking_id }}";
        const apiUrl = "{{ rtrim($apiUrl, '/') }}";
        const expiresAt = "{{ $expiresAt }}".replace(' ', 'T');
        let timerInterval;
        let expiredHandled = false; // ⬅️ PENTING

        function startTimer() {
            const timerDisplay = document.querySelector('.text-2xl.font-bold');
            if (!timerDisplay) return;

            function updateTimer() {
                const now = Date.now();
                const expireTime = new Date(expiresAt).getTime();
                let timeLeft = Math.floor((expireTime - now) / 1000);

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerDisplay.textContent = "00:00:00";

                    if (!expiredHandled) {
                        expiredHandled = true;
                        handleExpiredPayment();
                    }
                    return;
                }

                const hours = Math.floor(timeLeft / 3600);
                const minutes = Math.floor((timeLeft % 3600) / 60);
                const seconds = timeLeft % 60;

                timerDisplay.textContent =
                    `${hours.toString().padStart(2,'0')}:${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;
            }

            updateTimer();
            timerInterval = setInterval(updateTimer, 1000);
        }

        function handleExpiredPayment() {
            console.group('🔥 EXPIRE PAYMENT DEBUG');
            console.log('API URL:', apiUrl);
            console.log('Booking ID:', bookingId);
            console.log('Token:', "{{ session('token') ? 'ADA' : 'KOSONG' }}");

            fetch(`${apiUrl}/payment/${bookingId}/expire`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer {{ session('token') }}'
                    },
                    body: JSON.stringify({
                        reason: 'timeout'
                    })
                })
                .then(async res => {
                    console.log('STATUS CODE:', res.status);
                    console.log('RESPONSE HEADERS:', [...res.headers.entries()]);

                    const text = await res.text();
                    console.log('RAW RESPONSE:', text);

                    if (!res.ok) {
                        throw new Error(`HTTP ${res.status} - ${text}`);
                    }

                    return text ? JSON.parse(text) : {};
                })
                .then(data => {
                    console.log('PARSED RESPONSE:', data);

                    Swal.fire({
                        icon: 'error',
                        title: 'Waktu Habis',
                        text: data.message ?? 'Pembayaran expired',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.href = '/';
                    });
                })
                .catch(err => {
                    console.error('❌ EXPIRE ERROR:', err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Expire Gagal',
                        text: err.message
                    });
                })
                .finally(() => {
                    console.groupEnd();
                });
        }


        const checkStatus = () => {
            fetch(`/ajax/booking-status/${bookingId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'approved') {
                        clearInterval(timerInterval);

                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil!',
                            text: 'Anda akan diarahkan ke halaman tiket.',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        setTimeout(() => {
                            window.location.href = `/ticket/${bookingId}`;
                        }, 2000);
                    }
                })
                .catch(err => console.error(err));
        };

        document.addEventListener('DOMContentLoaded', () => {
            startTimer();
            setInterval(checkStatus, 5000);
        });
    </script>
@endsection
