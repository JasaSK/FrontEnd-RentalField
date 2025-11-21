@extends('beranda.layouts.master')

@section('content')
    <section class="py-20 px-6 md:px-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto">

            <!-- Header -->
            <h2 class="text-4xl font-extrabold text-[#13810A] mb-12 text-center tracking-wide">
                Booking Lapangan1
            </h2>

            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Gambar Lapangan -->
                <div class="lg:w-1/2 bg-white rounded-3xl shadow-lg overflow-hidden">
                    @if (!empty($field))
                        <img src="{{ $field['image_url'] }}" alt="{{ $field['name'] }}" class="w-full h-96 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-[#13810A] mb-3">{{ $field['name'] }}</h3>
                            <p class="text-gray-700 text-lg mb-2">
                                Harga per jam: <span class="font-semibold text-green-700">Rp
                                    {{ number_format($field['price_per_hour'], 0, ',', '.') }}</span>
                            </p>
                            <span
                                class="px-3 py-1 rounded-full text-white font-semibold
                            {{ $field['status'] == 'available' ? 'bg-green-600' : ($field['status'] == 'booked' ? 'bg-red-600' : 'bg-yellow-500') }}">
                                {{ ucfirst($field['status']) }}
                            </span>
                        </div>
                    @else
                        <div class="flex items-center justify-center h-96 text-gray-400 font-semibold">
                            Pilih lapangan terlebih dahulu
                        </div>
                    @endif
                </div>

                <!-- Form Booking / Detail Pesanan -->
                <div class="lg:w-1/2 bg-white rounded-3xl shadow-lg p-8 flex flex-col justify-between">
                    <h3 class="text-2xl font-semibold text-[#13810A] mb-6 text-center">Form Booking</h3>

                    <form action="{{ route('beranda.booking.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div>
                            @if (!empty($field))
                                <p class="font-semibold mb-1">Lapangan: {{ $field['name'] }} - Rp
                                    {{ number_format($field['price_per_hour'], 0, ',', '.') }}/jam</p>
                                <input type="hidden" name="field_id" value="{{ $field['id'] }}">
                            @else
                                <label for="field_id" class="block font-semibold mb-2">Pilih Lapangan</label>
                                <select id="field_id" name="field_id"
                                    class="w-full px-5 py-3 rounded-xl border border-gray-300 outline-none focus:ring-2 focus:ring-[#13810A] transition duration-200">
                                    <option value="">-- Pilih Lapangan --</option>
                                    @foreach ($fields as $f)
                                        <option value="{{ $f['id'] }}">{{ $f['name'] }} - Rp
                                            {{ number_format($f['price_per_hour'], 0, ',', '.') }}/jam</option>
                                    @endforeach
                                </select>
                            @endif
                            @error('field_id')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="date" class="block font-semibold mb-2">Tanggal Main</label>
                            <input type="date" id="date" name="date"
                                class="w-full px-5 py-3 rounded-xl border border-gray-300 outline-none focus:ring-2 focus:ring-[#13810A] transition duration-200">
                            @error('date')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="start_time" class="block font-semibold mb-2">Jam Mulai</label>
                                <input type="time" id="start_time" name="start_time"
                                    class="w-full px-5 py-3 rounded-xl border border-gray-300 outline-none focus:ring-2 focus:ring-[#13810A] transition duration-200">
                                @error('start_time')
                                    <p class="text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="end_time" class="block font-semibold mb-2">Jam Selesai</label>
                                <input type="time" id="end_time" name="end_time"
                                    class="w-full px-5 py-3 rounded-xl border border-gray-300 outline-none focus:ring-2 focus:ring-[#13810A] transition duration-200">
                                @error('end_time')
                                    <p class="text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-[#13810A] to-green-700 hover:from-green-700 hover:to-[#13810A] transition duration-300">
                            Booking Sekarang
                        </button>
                    </form>

                    <!-- Booking Result -->
                    @if (!empty($booking))
                        <div class="mt-8 p-4 border-t border-gray-200">
                            <h4 class="text-xl font-semibold text-[#13810A] mb-4 text-center">Detail Booking</h4>
                            <div class="space-y-2 text-gray-700">
                                <p>Kode Booking: <span class="font-medium">{{ $booking['code_booking'] }}</span></p>
                                <p>Tanggal: <span class="font-medium">{{ $booking['date'] }}</span></p>
                                <p>Jam: <span class="font-medium">{{ substr($booking['start_time'], 0, 5) }} -
                                        {{ substr($booking['end_time'], 0, 5) }}</span></p>
                                <p>Nama User: <span class="font-medium">{{ $booking['user']['name'] }}</span></p>
                                <p>Email: <span class="font-medium">{{ $booking['user']['email'] }}</span></p>
                                <p>No Telp: <span class="font-medium">{{ $booking['user']['no_telp'] }}</span></p>
                                <p>Total Harga: <span class="font-semibold text-green-700">Rp
                                        {{ number_format($booking['total_price'], 0, ',', '.') }}</span></p>
                                <p>Status:
                                    <span
                                        class="px-3 py-1 rounded-full text-white font-semibold
                                {{ $booking['status'] == 'pending' ? 'bg-yellow-500' : ($booking['status'] == 'confirmed' ? 'bg-green-600' : 'bg-red-600') }}">
                                        {{ ucfirst($booking['status']) }}
                                    </span>
                                </p>
                            </div>
                            <div class="mt-4 flex gap-3">
                                @if ($booking['status'] == 'pending')
                                    <form action="{{ route('beranda.booking.cancel', $booking['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                                            Batalkan Booking
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('beranda.index') }}"
                                    class="px-4 py-2 bg-[#13810A] text-white rounded-xl hover:bg-green-800 transition">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </section>
@endsection
