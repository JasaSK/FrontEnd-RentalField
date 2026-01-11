@extends('beranda.layouts.master')
@section('title', 'Riwayat Pemesanan')
@section('content')

    <section class="pt-28 pb-16 px-4 md:px-8 min-h-screen bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-6xl mx-auto">

            <!-- Header Section -->
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl shadow-lg mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">Riwayat Pemesanan</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Lacak dan kelola semua pesanan lapangan futsal Anda di satu
                    tempat</p>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Total Pesanan</p>
                            <p class="text-2xl font-bold text-gray-800">{{ count($bookings) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Sukses</p>
                            <p class="text-2xl font-bold text-emerald-600">
                                {{ $approvedCount }}</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Pending</p>
                            <p class="text-2xl font-bold text-amber-600">
                                {{ $pendingCount }}</p>
                        </div>
                        <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Cards -->
            <div class="space-y-4">
                @foreach ($bookings as $booking)
                    @php
                        $refund = $booking['refunds'][0] ?? null;
                        $refundStatus = $refund['refund_status'] ?? null;

                        $isApproved = $booking['status'] === 'approved';
                        $refundApproved = $refundStatus === 'approved';

                        $ticket = $booking['ticket'] ?? null;
                        $ticketUsed = $ticket ? $ticket['status_ticket'] === 'used' : false;

                        $canViewTicket = $isApproved && $ticket && $refundStatus !== 'pending';

                        // ===== REFUND TIME LOGIC =====
                        $bookingDateTime = Carbon\Carbon::parse($booking['date'] . ' ' . $booking['start_time']);
                        $refundDeadline = $bookingDateTime->copy()->subHour();
                        $now = now();

                        $refundTimeExpired = $now->greaterThanOrEqualTo($refundDeadline);

                        $canRefund =
                            $isApproved &&
                            !in_array($refundStatus, ['pending', 'approved']) &&
                            !$ticketUsed &&
                            !$refundTimeExpired;
                    @endphp



                    <div
                        class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl hover:border-emerald-100 transition-all duration-300">

                        <!-- Header with status -->
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-6">
                            <div class="flex items-start space-x-4">
                                <!-- Field Image/Icon -->
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-md">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Booking Info -->
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $booking['field']['name'] }}</h3>
                                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($booking['date'])->format('d M Y') }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $booking['start_time'] }} - {{ $booking['end_time'] }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                            Rp {{ number_format($booking['total_price'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="mt-4 md:mt-0">
                                @if ($refundStatus === 'pending')
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Refund Pending
                                    </span>
                                @elseif ($refundStatus === 'approved')
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Refunded
                                    </span>
                                @elseif ($booking['status'] === 'approved')
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Sukses
                                    </span>
                                @elseif ($booking['status'] === 'cancelled')
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-800 border border-red-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Ditolak
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap items-center gap-3 pt-5 border-t border-gray-100">
                            @if ($refundApproved)
                                <button type="button" onclick="openRefundModal({{ $booking['id'] }})"
                                    class="inline-flex items-center px-5 py-2.5 bg-blue-50 text-blue-700 rounded-lg font-medium hover:bg-blue-100 transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat Detail Refund
                                </button>
                            @else
                                <!-- Lihat Tiket -->
                                @if ($canViewTicket)
                                    <a href="{{ route('ticket.show', $booking['id']) }}"
                                        class="inline-flex items-center px-5 py-2.5 bg-emerald-50 text-emerald-700 rounded-lg font-medium hover:bg-emerald-100 hover:text-emerald-800 transition-all duration-200 group/btn">
                                        <svg class="w-5 h-5 mr-2 group-hover/btn:translate-x-1 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Lihat Tiket
                                    </a>
                                @endif

                                <!-- Bayar Sekarang -->
                                @if ($booking['status'] === 'pending')
                                    <form action="{{ route('beranda.payment.create', $booking['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-green-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                </path>
                                            </svg>
                                            Bayar Sekarang
                                        </button>
                                    </form>
                                @endif

                                <!-- Refund Button -->
                                @if ($isApproved && !in_array($refundStatus, ['pending', 'approved']) && !$ticketUsed)
                                    @if ($refundTimeExpired)
                                        <!-- DISABLED REFUND -->
                                        <button type="button" disabled
                                            class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-400 rounded-lg font-medium cursor-not-allowed">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Refund Ditutup
                                        </button>

                                        <span class="text-xs text-gray-400 ml-2">
                                            (Refund hanya bisa dilakukan &lt; 1 jam sebelum jadwal)
                                        </span>
                                    @else
                                        <!-- ACTIVE REFUND -->
                                        <a href="{{ route('beranda.refund', $booking['id']) }}"
                                            class="inline-flex items-center px-5 py-2.5 bg-red-50 text-red-700 rounded-lg font-medium hover:bg-red-100 hover:text-red-800 transition-all duration-200 group/btn">
                                            <svg class="w-5 h-5 mr-2 group-hover/btn:rotate-12 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Ajukan Refund
                                        </a>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                    <div id="refundModal-{{ $booking['id'] }}"
                        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

                        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 animate-fadeIn">
                            <!-- HEADER -->
                            <div class="flex items-center justify-between p-5 border-b">
                                <h3 class="text-lg font-bold text-gray-800">
                                    Detail Refund
                                </h3>
                                <button onclick="closeRefundModal({{ $booking['id'] }})"
                                    class="text-gray-400 hover:text-gray-600">
                                    ✕
                                </button>
                            </div>

                            <!-- BODY -->
                            <div class="p-6">
                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-4">

                                    <!-- ICON -->
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>

                                    <!-- CONTENT -->
                                    <div class="text-sm text-blue-800 space-y-2 w-full">
                                        <div class="font-semibold text-base">
                                            Refund Berhasil
                                        </div>

                                        {{-- Jumlah Dibayar --}}
                                        @if (!empty($refund['amount_paid']))
                                            <div>
                                                <span class="font-medium">Jumlah Dibayar:</span><br>
                                                Rp {{ number_format($refund['amount_paid'], 0, ',', '.') }}
                                            </div>
                                        @endif

                                        {{-- Jumlah Refund --}}
                                        @if (!empty($refund['refund_amount']))
                                            <div>
                                                <span class="font-medium">Jumlah Refund:</span><br>
                                                Rp {{ number_format($refund['refund_amount'], 0, ',', '.') }}
                                            </div>
                                        @endif

                                        {{-- Metode --}}
                                        @if (!empty($refund['refund_method']))
                                            <div>
                                                <span class="font-medium">Metode Refund:</span><br>
                                                {{ $refund['refund_method'] }}
                                            </div>
                                        @endif

                                        {{-- Rekening --}}
                                        @if (!empty($refund['account_number']))
                                            <div>
                                                <span class="font-medium">No. Rekening:</span><br>
                                                {{ $refund['account_number'] }}
                                            </div>
                                        @endif

                                        {{-- Alasan --}}
                                        @if (!empty($refund['reason']))
                                            <div>
                                                <span class="font-medium">Alasan:</span><br>
                                                {{ $refund['reason'] }}
                                            </div>
                                        @endif

                                        {{-- Bukti --}}
                                        @if (!empty($refund['proof_url']))
                                            <img src="{{ $refund['proof_url'] }}"
                                                onclick="openImagePreview('{{ $refund['proof_url'] }}')"
                                                class="w-32 h-32 object-cover rounded-lg cursor-zoom-in
                                                hover:opacity-90 transition"
                                                alt="Bukti Refund">
                                        @endif

                                        {{-- Waktu Disetujui --}}
                                        @if (!empty($refund['updated_at']))
                                            <div class="text-xs text-blue-600 pt-2 border-t border-blue-200">
                                                Disetujui pada
                                                {{ \Carbon\Carbon::parse($refund['updated_at'])->format('d M Y H:i') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- FOOTER -->
                            <div class="p-4 border-t text-right">
                                <button onclick="closeRefundModal({{ $booking['id'] }})"
                                    class="px-4 py-2 bg-gray-100 rounded-lg text-gray-700 hover:bg-gray-200">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>

                @endforeach
                <div id="imagePreviewModal"
                    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm">

                    <div class="relative max-w-4xl max-h-[90vh] p-4">
                        <button onclick="closeImagePreview()"
                            class="absolute -top-4 -right-4 bg-white rounded-full w-9 h-9
                   flex items-center justify-center shadow hover:bg-gray-100">
                            ✕
                        </button>

                        <img id="imagePreview" src=""
                            class="max-w-full max-h-[85vh] rounded-xl shadow-lg object-contain"
                            alt="Preview Bukti Refund">
                    </div>
                </div>

            </div>


            <!-- Empty State -->
            @if (count($bookings) === 0)
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Riwayat Pemesanan</h3>
                    <p class="text-gray-500 max-w-md mx-auto mb-8">Anda belum memiliki riwayat pemesanan lapangan futsal
                    </p>
                    <a href="{{ route('beranda.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-green-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Pesan Lapangan Sekarang
                    </a>
                </div>
            @endif

        </div>

    </section>
    <script>
        function openRefundModal(id) {
            document.getElementById("refundModal-" + id).classList.remove("hidden");
            document.getElementById("refundModal-" + id).classList.add("flex");
        }

        function closeRefundModal(id) {
            document.getElementById("refundModal-" + id).classList.add("hidden");
            document.getElementById("refundModal-" + id).classList.remove("flex");
        }

        function openImagePreview(src) {
            const modal = document.getElementById("imagePreviewModal");
            const img = document.getElementById("imagePreview");

            img.src = src;
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function closeImagePreview() {
            const modal = document.getElementById("imagePreviewModal");
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }
    </script>
@endsection
