@extends('beranda.layouts.master')

@section('content')
    <section class="py-20 px-6 md:px-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto">

            <h2 class="text-4xl font-extrabold text-[#13810A] mb-12 text-center tracking-wide">
                Booking Lapangan
            </h2>

            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Gambar Lapangan -->
                <div class="lg:w-1/2 bg-white rounded-3xl shadow-lg overflow-hidden">
                    @if (!empty($field))
                        <img src="{{ $field['image_url'] }}" alt="{{ $field['name'] }}" class="w-full h-96 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-[#13810A] mb-3">{{ $field['name'] }}</h3>
                            <p class="text-gray-700 text-lg mb-2">
                                Harga per jam: <span class="font-semibold text-[#13810A]">Rp
                                    {{ number_format($field['price_per_hour'], 0, ',', '.') }}</span>
                            </p>
                            <span
                                class="px-3 py-1 rounded-full text-white font-semibold
                            {{ $field['status'] == 'available' ? 'bg-[#13810A]' : ($field['status'] == 'booked' ? 'bg-[#8B0C17]' : 'bg-[#D37B00]') }}">
                                {{ ucfirst($field['status']) }}
                            </span>
                        </div>
                    @else
                        <div class="flex items-center justify-center h-96 text-gray-400 font-semibold">
                            Pilih lapangan terlebih dahulu
                        </div>
                    @endif
                </div>

                <!-- Form Booking -->
                <div class="lg:w-1/2 bg-white rounded-3xl shadow-xl p-6 sm:p-8 flex flex-col gap-6">

                    <h3 class="text-2xl font-semibold text-[#13810A] mb-6 text-center">Form Booking</h3>

                    <form id="myForm" action="{{ route('beranda.booking.show', $field['id']) }}" method="GET"
                        class="space-y-6">
                        @csrf
                        <div>
                            <label for="date" class="block font-semibold mb-2">Tanggal Main</label>
                            <input type="date" id="date" name="date" value="{{ $date ?? now()->toDateString() }}"
                                class="w-full px-5 py-3 rounded-xl border border-gray-300 outline-none focus:ring-2 focus:ring-[#13810A] transition duration-200"
                                onchange="this.form.submit()">
                            @error('date')
                                <p class="text-[#8B0C17] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div id="formLoader"
                            class="absolute inset-0 bg-white/70 flex items-center justify-center hidden z-10">
                            <div class="spinner"></div>
                        </div>
                    </form>
                    {{-- <pre>{{ print_r($bookedHours) }}</pre> --}}

                    <form id="myForm" action="{{ route('beranda.booking.store') }}" method="POST" class="space-y-6">
                        @csrf
                        @if (session('user'))
                            <input type="hidden" name="user_id" value="{{ session('user')['id'] }}">
                        @endif
                        <input type="hidden" name="field_id" value="{{ $field['id'] }}">
                        <input type="hidden" name="date" value="{{ $date ?? now()->toDateString() }}">

                        @php
                            use Carbon\Carbon;
                            $open = Carbon::parse($field['open_time']);
                            $close = Carbon::parse($field['close_time']);
                            $bookedHours = $bookedHours ?? [];
                        @endphp

                        <div>
                            <label class="block font-semibold mb-2">Pilih Jam</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3" id="hourSlots">
                                @php
                                    $bookedHours = $bookedHours ?? [];
                                @endphp

                                @for ($time = $open->copy(); $time < $close; $time->addHour())
                                    @php
                                        $start = $time->format('H:i');
                                        $end = $time->copy()->addHour()->format('H:i');

                                        $range = $start . '-' . $end;
                                        $isBooked = in_array($start, $bookedHours);
                                    @endphp

                                    <button type="button"
                                        class="hour-slot
                                        px-3 py-2 rounded-xl text-sm font-semibold border transition-all duration-200
                                        focus:outline-none focus:ring-2 focus:ring-[#13810A]

                                        {{ $isBooked
                                            ? 'bg-red-100 border-red-400 text-red-700 cursor-not-allowed'
                                            : 'bg-green-50 border-green-400 text-[#13810A] hover:bg-[#13810A] hover:text-white hover:scale-[1.02]' }}"
                                        data-start="{{ $start }}" data-end="{{ $end }}"
                                        {{ $isBooked ? 'disabled' : '' }}>
                                        {{ $start }} - {{ $end }}
                                    </button>
                                @endfor

                            </div>

                            <input type="hidden" name="start_time" id="start_time">
                            <input type="hidden" name="end_time" id="end_time">
                        </div>

                        <button type="submit"
                            class="w-full py-3 rounded-xl font-bold tracking-wide text-white
                            bg-gradient-to-r from-[#13810A] to-[#0f6e09]
                            hover:from-[#0f6e09] hover:to-[#13810A]
                            active:scale-95 transition-all duration-200">
                            Booking Sekarang
                        </button>

                        <div id="formLoader"
                            class="absolute inset-0 bg-white/70 flex items-center justify-center hidden z-10">
                            <div class="spinner"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slots = document.querySelectorAll('.hour-slot');

            const selectedDate = new Date(document.getElementById('date').value);

            slots.forEach(slot => {
                const start = slot.dataset.start;
                const end = slot.dataset.end;

                const [hourStr, minuteStr] = start.split(':');
                const slotDate = new Date(selectedDate);
                slotDate.setHours(parseInt(hourStr), parseInt(minuteStr), 0, 0);

                // Disable jam yang sudah lewat
                if (slotDate < new Date()) {
                    slot.classList.add(
                        'bg-gray-100',
                        'border-gray-300',
                        'text-gray-400',
                        'cursor-not-allowed',
                        'opacity-70'
                    );

                    slot.disabled = true;
                    return;
                }

                slot.addEventListener('click', function() {
                    // reset semua slot
                    slots.forEach(s => {
                        s.classList.remove('bg-[#13810A]', 'text-white', 'scale-105');
                        s.classList.add('bg-green-50', 'text-[#13810A]');
                    });
                    slot.classList.remove('bg-green-50', 'text-[#13810A]');
                    slot.classList.add('bg-[#13810A]', 'text-white', 'scale-105');


                    document.getElementById('start_time').value = start;
                    document.getElementById('end_time').value = end;
                });
            });
        });
    </script>
@endsection
