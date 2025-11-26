@extends('beranda.layouts.master')
@section('title', 'Payment')

@section('content')
    <!-- Progress Bar -->
    <div class="relative w-3/4 mx-auto mt-32 mb-12">
        <div class="relative h-6">
            <div class="absolute top-1/2 left-0 right-0 h-4 bg-gray-300 rounded-full -translate-y-1/2"></div>
            <div class="absolute top-1/2 left-0 h-4 bg-[#13810A] rounded-full -translate-y-1/2" style="width: 66%;"></div>

            <div
                class="absolute top-1/2 left-0 w-8 h-8 bg-[#13810A] rounded-full border-2 border-white -translate-y-1/2 -translate-x-1/2">
            </div>
            <div
                class="absolute top-1/2 left-1/3 w-8 h-8 bg-[#13810A] rounded-full border-2 border-white -translate-y-1/2 -translate-x-1/2">
            </div>
            <div
                class="absolute top-1/2 left-2/3 w-8 h-8 bg-[#13810A] rounded-full border-2 border-white -translate-y-1/2 -translate-x-1/2">
            </div>
            <div
                class="absolute top-1/2 right-0 w-8 h-8 bg-gray-300 rounded-full border-2 border-white -translate-y-1/2 translate-x-1/2">
            </div>
        </div>

        <div class="flex justify-between mt-10 text-black text-lg font-bold">
            <p class="text-center leading-tight -left-4 relative">Order<br>Validation</p>
            <p class="text-center leading-tight">Payment</p>
            <p class="text-center leading-tight">Pending</p>
            <p class="text-center leading-tight left-4 relative">Sukses</p>
        </div>
    </div>

    <!-- Detail Pesanan -->
    <div class="mx-auto space-y-6 w-[97%] max-w-[1000px] mt-2 mb-10">
        <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
            <h3 class="text-xl font-bold mb-4 text-black">Detail Pesanan</h3>
            <div class="space-y-1 text-gray-700 text-sm">
                <p>Lapangan: <span class="font-semibold">{{ $booking['field']['name'] ?? '-' }}</span></p>
                <p>Tanggal: <span class="font-semibold">{{ $booking['date'] ?? '-' }}</span></p>
                <p>Jam:
                    <span class="font-semibold">
                        @if (isset($booking['start_time'], $booking['end_time']))
                            {{ substr($booking['start_time'], 0, 5) }} – {{ substr($booking['end_time'], 0, 5) }}
                        @else
                            -
                        @endif
                    </span>
                </p>
                <p>Nama: <span class="font-semibold">{{ $booking['user']['name'] ?? '-' }}</span></p>
                <p>Email: <span class="font-semibold">{{ $booking['user']['email'] ?? '-' }}</span></p>
                <p>Kode Booking: <span class="font-semibold">{{ $booking['code_booking'] ?? '-' }}</span></p>
                <p>No. Telp: <span class="font-semibold">{{ $booking['user']['phone'] ?? '-' }}</span></p>
                <p>Notes: <span class="font-semibold">{{ $booking['notes'] ?? '-' }}</span></p>
            </div>

            <div class="mt-5 border-t pt-4 text-sm text-gray-800">
                <div class="flex justify-between">
                    <span>Harga Lapangan</span>
                    <span class="font-semibold">Rp
                        {{ number_format($booking['field']['price_per_hour'] ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between mt-2">
                    <span>Total Bayar</span>
                    <span class="font-bold text-lg text-[#13810A]">Rp
                        {{ number_format($booking['total_price'] ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- QRIS Section -->
    <div class="max-w-xl mx-auto bg-white shadow-md p-6 rounded-xl text-center border border-gray-200">
        <h2 class="text-xl font-bold mb-3">QRIS Pembayaran</h2>
        <p class="text-gray-600 mb-4">Scan QR berikut untuk menyelesaikan pembayaran (sandbox).</p>

        <img id="qris-img" class="mx-auto w-64 h-64 object-contain rounded-lg shadow" src="{{ $qrisUrl ?? '' }}"
            alt="QRIS">

        @if (!$qrisUrl)
            <p class="mt-3 text-[#8B0C17]">QRIS gagal dimuat. Silakan refresh halaman.</p>
        @endif
    </div>

    <script>
        // Auto check booking status every 5 seconds
        const bookingId = "{{ $booking_id }}";

        const checkStatus = () => {
            fetch(`/booking/status/${bookingId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'approved') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil',
                            text: 'Transaksi Anda telah diverifikasi.',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        setTimeout(() => {
                            window.location.href = "{{ route('beranda.hystory') }}";
                        }, 2000);
                    }
                })
                .catch(err => console.error(err));
        }

        setInterval(checkStatus, 5000); // cek setiap 5 detik
    </script>
@endsection
