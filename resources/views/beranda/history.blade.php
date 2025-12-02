@extends('beranda.layouts.master')
@section('title', 'Riwayat Pemesanan')
@section('content')

    <section class="pt-32 pb-20 px-4 md:px-12 min-h-screen bg-gray-50">
        <div class="max-w-[1500px] mx-auto">

            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-[#13810A]">Riwayat Pemesanan</h2>

            <div class="space-y-6">

                @foreach ($bookings as $booking)
                    <div
                        class="bg-white shadow-md rounded-2xl p-6 md:p-8 border border-gray-200 hover:shadow-xl transition-all duration-300 hover:scale-[1.02]">

                        <!-- Header Pesanan -->
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
                            <div class="space-y-1">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $booking['field']['name'] }}</h3>
                                <p class="text-gray-600"><span class="font-semibold">Tanggal:</span>
                                    {{ \Carbon\Carbon::parse($booking['date'])->format('d M Y') }}</p>
                            </div>

                            <div class="mt-3 md:mt-0">
                                @if ($booking['status'] === 'approved')
                                    <span
                                        class="inline-block bg-green-600 text-white px-4 py-1 rounded-full font-semibold text-sm md:text-base">Sukses</span>
                                @elseif($booking['status'] === 'cancelled')
                                    <span
                                        class="inline-block bg-red-600 text-white px-4 py-1 rounded-full font-semibold text-sm md:text-base">Ditolak</span>
                                @else
                                    <span
                                        class="inline-block bg-yellow-500 text-white px-4 py-1 rounded-full font-semibold text-sm md:text-base">Pending</span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap items-center gap-4 mt-4">

                            <!-- Lihat Tiket -->
                            <a href="{{ route('history.show', $booking['id']) }}"
                                class="inline-block text-sm md:text-base text-blue-600 hover:text-blue-800 hover:underline font-medium transition-all duration-300">
                                Lihat Tiket
                            </a>

                            <!-- Bayar Sekarang -->
                            @if ($booking['status'] === 'pending')
                                <form action="{{ route('beranda.payment.create', $booking['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-block bg-[#13810A] text-white px-5 py-2 rounded-full font-semibold hover:bg-[#0F5E07] transition-all duration-300 text-sm md:text-base shadow-md hover:shadow-lg">
                                        Bayar Sekarang
                                    </button>
                                </form>
                            @endif

                            <!-- 🔥 Tombol Refund (tambahannya) -->
                            @if (
                                $booking['status'] === 'approved' &&
                                    $booking['status'] !== 'refunded' &&
                                    $booking['status'] !== 'cancelled' &&
                                    (!isset($booking['refund']) ||
                                        $booking['refund']['refund_status'] !== 'rejected' &&
                                        $booking['refund']['refund_status'] !== 'pending'))
                                <form action="{{ route('beranda.refund', ['id' => $booking['id']]) }}">
                                    <button type="submit"
                                        class="inline-block bg-red-600 text-white px-5 py-2 rounded-full font-semibold transition-all duration-300 text-sm md:text-base shadow-md hover:shadow-lg hover:bg-red-700">
                                        Ajukan Refund
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
