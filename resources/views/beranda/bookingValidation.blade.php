@extends('beranda.layouts.master')
@section('title', 'Konfirmasi Booking')

@section('content')
    <!-- Progress Bar -->
    <div class="relative w-3/4 mx-auto mt-32 mb-12">
        <div class="relative h-6">
            <div class="absolute top-1/2 left-0 right-0 h-4 bg-gray-500 transform -translate-y-1/2 rounded-full"></div>
            <div class="absolute top-1/2 left-0 h-4 bg-[#13810A] transform -translate-y-1/2 transition-all duration-700 rounded-full"
                style="width: 66%;"></div>
            <div
                class="absolute top-1/2 left-0 w-8 h-8 bg-[#13810A] rounded-full transform -translate-y-1/2 -translate-x-1/2 border-2 border-white">
            </div>
            <div
                class="absolute top-1/2 left-1/2 w-8 h-8 bg-[#13810A] rounded-full transform -translate-y-1/2 -translate-x-1/2 border-2 border-white">
            </div>
            <div
                class="absolute top-1/2 right-0 w-8 h-8 bg-gray-500 rounded-full transform -translate-y-1/2 translate-x-1/2 border-2 border-white">
            </div>
        </div>
        <div class="flex justify-between mt-10 text-black text-xl font-bold">
            <p class="mt-1 text-center font-bold text-lg leading-tight relative -left-8">Validasi<br>Item</p>
            <p class="mt-1 text-center font-bold text-lg leading-tight">Order<br>Validation</p>
            <p class="mt-1 text-center font-bold text-lg leading-tight relative left-8">Payment</p>
        </div>
    </div>

    <!-- Konten -->
    <div class="mx-auto space-y-6 w-[97%] max-w-[1000px] mt-2 mb-10">

        <!-- Notes -->
        <div class="bg-[#8B0C17] rounded-lg shadow-[0_4px_10px_rgba(0,0,0,0.15)] p-6">
            <h3 class="text-white text-xl font-semibold mb-4">Notes</h3>
            <div class="bg-white rounded-lg p-4 shadow-inner">
                <textarea placeholder="Keterangan"
                    class="w-full h-20 p-3 rounded-lg bg-white text-gray-800 border-none outline-none resize-none placeholder:text-gray-500 placeholder:opacity-100"
                    name="notes">{{ $booking['notes'] ?? '' }}</textarea>
            </div>
        </div>

        <!-- Detail Pesanan -->
        <div class="bg-white rounded-md shadow-[0_4px_8px_rgba(0,0,0,0.12),inset_0_2px_4px_rgba(0,0,0,0.05)] p-5">
            <h3 class="text-lg font-bold mb-3 text-black">Detail Pesanan</h3>

            <div class="space-y-1 text-gray-700 text-sm">
                <p>Lapangan: <span class="font-medium">{{ $booking['field']['name'] ?? '-' }}</span></p>
                <p>Tanggal: <span class="font-medium">{{ $booking['date'] ?? '-' }}</span></p>
                <p>Jam: <span class="font-medium">
                        @if (isset($booking['start_time'], $booking['end_time']))
                            {{ substr($booking['start_time'], 0, 5) }} – {{ substr($booking['end_time'], 0, 5) }}
                        @else
                            -
                        @endif
                    </span></p>
                <p>Kode Booking: <span class="font-medium">{{ $booking['code_booking'] ?? '-' }}</span></p>
            </div>

            <div class="mt-4 pt-6 flex justify-between text-sm text-gray-800 pr-8">
                <span>Harga Lapangan</span>
                <span class="font-semibold">
                    Rp {{ number_format($booking['field']['price_per_hour'] ?? 0, 0, ',', '.') }}
                </span>
            </div>

            <div class="border-t border-gray-300 pt-6 flex justify-between text-sm text-gray-800 pr-8">
                <span>Total Bayar</span>
                <span class="font-semibold">
                    Rp {{ number_format($booking['total_price'] ?? 0, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Button Konfirmasi -->
    <div class="flex justify-center mt-10 mb-10">

        <!-- Form Konfirmasi -->
        <form action="{{ route('beranda.payment.create', $booking['id']) }}" method="POST" class="mr-4">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking['id'] ?? '' }}">

            <button type="submit"
                class="bg-[#13810A] hover:bg-[#0f6e09] text-white px-8 py-3 rounded-md font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
                Konfirmasi Data & Lanjut ke Pembayaran
            </button>
        </form>

        <!-- Cancel Booking -->
        <form action="{{ route('beranda.bookingValidation.cancel', $booking['id'] ?? '') }}" method="POST"
            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?');">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="bg-[#8B0C17] hover:bg-[#7a0a14] text-white px-8 py-3 rounded-md font-semibold shadow-md transition-all duration-200">
                Batalkan Booking
            </button>
        </form>

    </div>
@endsection
