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
                        $ticketUsed = $booking['ticket']['status_ticket'] === 'used';

                        $canViewTicket = $isApproved && $refundStatus !== 'pending';
                        $canRefund = $isApproved && !in_array($refundStatus, ['pending', 'approved']) && !$ticketUsed;
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
                            @if ($canRefund)
                                <a href="{{ route('beranda.refund', $booking['id']) }}"
                                    class="inline-flex items-center px-5 py-2.5 bg-red-50 text-red-700 rounded-lg font-medium hover:bg-red-100 hover:text-red-800 transition-all duration-200 group/btn">
                                    <svg class="w-5 h-5 mr-2 group-hover/btn:rotate-12 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    Ajukan Refund
                                </a>
                            @endif

                        </div>
                    </div>
                @endforeach
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
                    <a href="{{ route('beranda.fields') }}"
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

@endsection

