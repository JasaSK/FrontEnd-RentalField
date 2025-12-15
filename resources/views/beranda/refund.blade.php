@extends('beranda.layouts.master')
@section('title', 'Ajukan Refund')
@section('content')

    <section class="pt-28 pb-16 px-4 md:px-8 min-h-screen bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-2xl mx-auto">

            <!-- Header Section -->
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-red-500 to-rose-600 rounded-2xl shadow-lg mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">Ajukan Refund</h1>
                <p class="text-gray-600 max-w-md mx-auto">Isi form di bawah untuk mengajukan pengembalian dana</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-red-500 to-rose-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-white">Form Pengajuan Refund</h2>
                        <div class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium text-white">
                            ID: {{ $code_booking['code_booking'] ?? 'N/A' }}
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('beranda.refund.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
                    @csrf

                    <!-- Hidden Fields -->
                    <input type="hidden" name="booking_id" value="{{ $code_booking['id'] ?? '' }}">

                    <!-- Booking Info Section -->
                    <div class="bg-red-50 border border-red-100 rounded-xl p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Informasi Booking</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Kode Pemesanan</label>
                                <div
                                    class="p-3 bg-white border border-gray-200 rounded-lg font-mono font-bold text-gray-800">
                                    {{ $code_booking['code_booking'] ?? '' }}
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Total Harga</label>
                                <div class="p-3 bg-white border border-gray-200 rounded-lg font-bold text-red-600">
                                    Rp {{ number_format($code_booking['total_price'] ?? 0, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Refund Details Section -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-gray-800 border-b border-gray-100 pb-3">Detail Refund</h3>

                        <!-- Bank Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                        </path>
                                    </svg>
                                    Pilih Bank Tujuan
                                </span>
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                                @php
                                    $banks = [
                                        'BCA' => 'bg-blue-50 border-blue-200 text-blue-700',
                                        'BRI' => 'bg-green-50 border-green-200 text-green-700',
                                        'BNI' => 'bg-red-50 border-red-200 text-red-700',
                                        'Mandiri' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
                                        'CIMB Niaga' => 'bg-purple-50 border-purple-200 text-purple-700',
                                    ];
                                @endphp

                                @foreach ($banks as $bank => $classes)
                                    <label class="bank-option cursor-pointer">
                                        <input type="radio" name="refund_method" value="{{ $bank }}"
                                            class="hidden peer" {{ $loop->first ? 'checked' : '' }}>
                                        <div
                                            class="p-3 border rounded-xl text-center transition-all duration-200 
                                                    {{ $classes }} 
                                                    peer-checked:ring-2 peer-checked:ring-red-500 peer-checked:border-transparent">
                                            <div class="font-semibold text-sm">{{ $bank }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Account Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                    Nomor Rekening
                                </span>
                            </label>
                            <div class="relative">
                                <input type="text" name="account_number" required
                                    placeholder="Masukkan nomor rekening penerima"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200">
                                <div class="absolute left-4 top-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Refund Reason -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                        </path>
                                    </svg>
                                    Alasan Refund
                                </span>
                                <span class="text-xs text-gray-500 font-normal">Jelaskan alasan Anda mengajukan
                                    refund</span>
                            </label>
                            <textarea name="reason" rows="4" required
                                placeholder="Contoh: Ada perubahan jadwal mendadak / Lapangan tidak tersedia / Alasan lainnya..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 resize-none"></textarea>
                        </div>

                        <!-- Price Input (Hidden but still in form) -->
                        <input type="hidden" name="amount_paid" value="{{ $code_booking['total_price'] }}">
                    </div>

                    <!-- Info Note -->
                    <div class="bg-amber-50 border border-amber-100 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm text-amber-800">
                                <p class="font-medium mb-1">Perlu diperhatikan:</p>
                                <ul class="space-y-1">
                                    <li>• Pastikan nomor rekening sudah benar</li>
                                    <li>• Refund akan diproses dalam 1-3 hari kerja</li>
                                    <li>• Admin akan menghubungi Anda untuk konfirmasi</li>
                                    <li>• Biaya admin mungkin berlaku</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl font-semibold hover:from-red-600 hover:to-rose-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            Ajukan Refund
                        </button>

                        <p class="text-center text-sm text-gray-500 mt-4">
                            Dengan menekan tombol di atas, Anda menyetujui
                            <a href="#" class="text-red-600 hover:text-red-800 hover:underline">syarat dan
                                ketentuan</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .rounded-2xl {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Bank option hover effects */
        .bank-option:hover div {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Input focus effects */
        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Gradient text for header */
        .text-gradient {
            background: linear-gradient(135deg, #ef4444 0%, #e11d48 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }
    </style>

    <script>
        // Bank selection animation
        document.querySelectorAll('.bank-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove all checked styles
                document.querySelectorAll('.bank-option div').forEach(div => {
                    div.classList.remove('ring-2', 'ring-red-500', 'border-transparent');
                });

                // Add checked style to clicked option
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
                this.querySelector('div').classList.add('ring-2', 'ring-red-500', 'border-transparent');
            });
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const accountNumber = document.querySelector('input[name="account_number"]').value;
            const reason = document.querySelector('textarea[name="reason"]').value;

            if (!accountNumber.trim() || !reason.trim()) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang diperlukan!');
            }
        });
    </script>

@endsection
