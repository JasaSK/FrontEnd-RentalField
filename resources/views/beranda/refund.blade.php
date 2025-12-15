@extends('beranda.layouts.master')
@section('title', 'Refund')
@section('content')

    <section class="pt-32 pb-20 px-4 md:px-12 min-h-screen bg-gray-50">
        <div class="max-w-[800px] mx-auto bg-white shadow-md rounded-2xl p-8 border border-gray-200">

            <h2 class="text-3xl md:text-4xl font-bold text-center mb-10 text-red-600">Pengajuan Refund</h2>
            <form action="{{ route('beranda.refund.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Booking ID (hidden) -->
                <input type="hidden" name="booking_id" value="{{ $code_booking['id'] ?? '' }}">
                <!-- ID Pemesanan -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Kode Pemesanan</label>
                    <input type="text" name="" value="{{ $code_booking['code_booking'] ?? '' }}" required
                        placeholder="Masukkan Kode Pemesanan"
                        class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500">
                </div>
                <!-- price -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Harga Pemesanan</label>
                    <input type="text" name="amount_paid" value="{{ $code_booking['total_price'] }}" required
                        placeholder="Harga Pemesanan" class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500">
                </div>

                <!-- Bank -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Pilih Bank</label>
                    <select name="refund_method" required
                        class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500">
                        <option value="BCA">BCA</option>
                        <option value="BRI">BRI</option>
                        <option value="BNI">BNI</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="CIMB Niaga">CIMB Niaga</option>
                    </select>
                </div>

                <!-- Nomor Rekening -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Nomor Rekening</label>
                    <input type="text" name="account_number" required placeholder="Masukkan nomor rekening"
                        class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500">
                </div>

                <!-- Alasan Refund -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Alasan Refund</label>
                    <textarea name="reason" rows="4" required placeholder="Isi alasan pengajuan refund"
                        class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500"></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-red-600 text-white py-3 rounded-xl font-semibold text-lg hover:bg-red-700 transition-all duration-300 shadow-md">
                    Ajukan Refund
                </button>
            </form>

        </div>
    </section>

@endsection
