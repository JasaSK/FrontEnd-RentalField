@extends('beranda.layouts.master')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-b from-emerald-50 to-white flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8 relative overflow-hidden">

        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-100 rounded-full opacity-20"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-emerald-100 rounded-full opacity-20"></div>
            <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-emerald-50 rounded-full opacity-10"></div>
        </div>

        <div class="relative w-full max-w-6xl">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl shadow-xl mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Tiket Booking Lapangan Futsal</h1>

                <!-- Status Badge -->
                <div class="inline-block mb-8">
                    @if ($ticket)
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-600 font-medium">Status Tiket:</span>
                            <span
                                class="px-5 py-2 rounded-full text-base font-semibold shadow-sm
                                {{ ($ticket['status_ticket'] ?? '') === 'unused' ? 'bg-amber-100 text-amber-800 border border-amber-200' : '' }}
                                {{ ($ticket['status_ticket'] ?? '') === 'used' ? 'bg-red-100 text-red-800 border border-red-200' : '' }}">
                                <span class="inline-flex items-center">
                                    @if (($ticket['status_ticket'] ?? '') === 'unused')
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @elseif(($ticket['status_ticket'] ?? '') === 'used')
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                    {{ ucfirst($ticket['status_ticket'] ?? '-') }}
                                </span>
                            </span>
                        </div>
                    @else
                        <span class="px-4 py-2 rounded-full bg-gray-100 text-gray-700 border border-gray-200">
                            Status tidak tersedia
                        </span>
                    @endif
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                <div class="md:flex">

                    <!-- Left Panel - Ticket Info -->
                    <div class="md:w-1/2 p-8 md:p-10">
                        <div class="space-y-6">
                            <!-- Header -->
                            <div class="border-b border-gray-100 pb-6">
                                <h2 class="text-xl font-bold text-gray-800 mb-2">Detail Booking</h2>
                                <p class="text-gray-600">Informasi lengkap tentang pemesanan Anda</p>
                            </div>

                            <!-- Info Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Booking Code -->
                                <div class="bg-emerald-50 rounded-xl p-5">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 font-medium">Kode Booking</p>
                                            <p class="text-lg font-bold text-gray-800 font-mono">
                                                {{ $booking['code_booking'] ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date -->
                                <div class="bg-emerald-50 rounded-xl p-5">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 font-medium">Tanggal</p>
                                            <p class="text-lg font-bold text-gray-800">
                                                {{ isset($booking['date']) ? \Carbon\Carbon::parse($booking['date'])->format('d M Y') : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Time -->
                                <div class="bg-emerald-50 rounded-xl p-5">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 font-medium">Waktu</p>
                                            <p class="text-lg font-bold text-gray-800">
                                                {{ $booking['start_time'] ?? 'N/A' }} - {{ $booking['end_time'] ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="bg-emerald-50 rounded-xl p-5">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 font-medium">Total Harga</p>
                                            <p class="text-lg font-bold text-emerald-600">
                                                Rp
                                                {{ isset($booking['total_price']) ? number_format($booking['total_price'], 0, ',', '.') : '0' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                                <form action="{{ route('ticket.download', $booking['id']) }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex-1 inline-flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-emerald-500 to-green-600 text-white rounded-xl font-semibold hover:from-emerald-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Download PDF
                                    </button>
                                </form>

                                <a href="{{ route('beranda.index') }}"
                                    class="flex-1 inline-flex items-center justify-center px-6 py-3.5 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200 shadow-sm hover:shadow">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Kembali ke Beranda
                                </a>
                            </div>

                            <!-- Info Note -->
                            <div class="mt-8 p-4 bg-amber-50 border border-amber-100 rounded-xl">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="text-sm text-amber-800">
                                        <p class="font-medium mb-1">Catatan Penting:</p>
                                        <ul class="space-y-1">
                                            <li>• Tiket ini hanya berlaku untuk pemegang yang tercatat</li>
                                            <li>• Harap tunjukkan QR code saat masuk ke lokasi</li>
                                            <li>• Pastikan tiket dalam kondisi baik dan terlihat jelas</li>
                                            <li>• Datang 15 menit sebelum waktu booking</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Panel - QR Code -->
                    <div
                        class="md:w-1/2 bg-gradient-to-br from-emerald-500 to-green-600 p-8 md:p-10 flex flex-col items-center justify-center">
                        <div class="text-center text-white mb-8">
                            <h3 class="text-2xl font-bold mb-2">Scan QR Code</h3>
                            <p class="opacity-90">Tunjukkan QR code untuk verifikasi</p>
                        </div>

                        <!-- QR Code Container -->
                        <div class="relative">
                            <div class="bg-white p-6 rounded-2xl shadow-2xl">
                                <img src="data:image/png;base64,{{ $qrBase64 }}" alt="QR Ticket"
                                    class="w-64 h-64 md:w-72 md:h-72">
                            </div>

                            <!-- Decorative corner elements -->
                            <div class="absolute -top-3 -left-3 w-6 h-6 border-t-2 border-l-2 border-white rounded-tl-lg">
                            </div>
                            <div class="absolute -top-3 -right-3 w-6 h-6 border-t-2 border-r-2 border-white rounded-tr-lg">
                            </div>
                            <div
                                class="absolute -bottom-3 -left-3 w-6 h-6 border-b-2 border-l-2 border-white rounded-bl-lg">
                            </div>
                            <div
                                class="absolute -bottom-3 -right-3 w-6 h-6 border-b-2 border-r-2 border-white rounded-br-lg">
                            </div>
                        </div>

                        <!-- QR Code Info -->
                        <div class="mt-8 text-center text-white opacity-90">
                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium">Valid for:
                                    {{ $booking['code_booking'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
