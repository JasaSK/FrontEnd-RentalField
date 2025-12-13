@extends('beranda.layouts.master')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-b from-[#13810A] to-[#0F5E07] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

        <div class="w-full max-w-5xl text-white">

            <!-- Header -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-bold tracking-wide mb-2">Tiket Booking</h1>
                @if ($ticket)
                    <span
                        class="px-4 py-2 rounded-full text-lg font-semibold
            {{ ($ticket['status_ticket'] ?? '') === 'unused' ? 'bg-yellow-200 text-yellow-900' : '' }}
            {{ ($ticket['status_ticket'] ?? '') === 'used' ? 'bg-red-200 text-red-900' : '' }}">
                        {{ ucfirst($ticket['status_ticket'] ?? '-') }}
                    </span>
                @else
                    <span class="px-4 py-2 rounded-full bg-gray-200 text-gray-700">
                        Status tidak tersedia
                    </span>
                @endif

            </div>

            <!-- Main Content -->
            <div class="md:flex md:items-center md:justify-between gap-12">

                <!-- Info Tiket -->
                <div class="md:w-1/2 space-y-6">
                    <div class="space-y-3 text-white text-lg">
                        <p>
                            <span class="font-semibold">Kode Booking:</span>
                            {{ $booking['code_booking'] ?? '-' }}
                        </p>

                        <p>
                            <span class="font-semibold">Tanggal:</span>
                            {{ isset($booking['date']) ? \Carbon\Carbon::parse($booking['date'])->format('d M Y') : '-' }}
                        </p>

                        <p>
                            <span class="font-semibold">Jam:</span>
                            {{ $booking['start_time'] ?? '-' }} - {{ $booking['end_time'] ?? '-' }}
                        </p>

                        <p>
                            <span class="font-semibold">Total Harga:</span>
                            Rp
                            {{ isset($booking['total_price']) ? number_format($booking['total_price'], 0, ',', '.') : '0' }}
                        </p>
                    </div>



                    <!-- Tombol Aksi -->
                    <div class="flex gap-4 mt-6">
                        <a href=""
                            class="flex-1 bg-white text-[#13810A] font-semibold px-6 py-3 rounded-full shadow-lg hover:bg-gray-100 text-center transition-all duration-300">
                            Download PDF
                        </a>
                        <a href="{{ route('beranda.index') }}"
                            class="flex-1 bg-gray-200 text-gray-800 font-semibold px-6 py-3 rounded-full shadow hover:bg-gray-300 text-center transition-all duration-300">
                            Kembali
                        </a>
                    </div>

                    <!-- Catatan -->
                    <div class="mt-6 text-gray-200 text-sm">
                        Tiket ini hanya berlaku untuk pemegang yang tercatat.<br>
                        Harap tunjukkan QR code saat masuk.
                    </div>
                </div>

                <!-- QR Code -->
                <div class="md:w-1/2 flex items-center justify-center mt-8 md:mt-0">
                    <img src="data:image/png;base64,{{ $qrBase64 }}" alt="QR Ticket"
                        class="w-64 h-64 md:w-72 md:h-72 rounded-lg shadow-2xl border-4 border-white">
                </div>

            </div>
        </div>
    </div>
@endsection
