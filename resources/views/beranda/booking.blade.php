@extends('beranda.layouts.master')

@section('content')
    <section class="min-h-screen bg-gradient-to-b from-white to-emerald-50 py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-12 md:mb-16">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 tracking-tight">
                    <span class="bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                        Booking Lapangan
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pilih waktu yang tepat untuk pengalaman bermain terbaik
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-green-400 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Field Card -->
                <div class="space-y-6">
                    <div
                        class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        @if (!empty($field))
                            <div class="relative">
                                <div class="relative h-64 md:h-80 overflow-hidden">
                                    <img src="{{ $field['image_url'] }}" alt="{{ $field['name'] }}"
                                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="px-4 py-2 rounded-full text-sm font-semibold text-white shadow-lg backdrop-blur-sm
                                        {{ $field['status'] == 'available'
                                            ? 'bg-gradient-to-r from-emerald-500 to-green-500'
                                            : ($field['status'] == 'booked'
                                                ? 'bg-gradient-to-r from-rose-500 to-pink-500'
                                                : 'bg-gradient-to-r from-amber-500 to-orange-500') }}">
                                        {{ ucfirst($field['status']) }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6 md:p-8">
                                <div class="flex items-start justify-between mb-6">
                                    <div>
                                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">{{ $field['name'] }}
                                        </h3>
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-5 h-5 text-emerald-500 mr-2" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>{{ $field['open_time'] }} - {{ $field['close_time'] }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg text-gray-500 mb-1">Harga per jam</div>
                                        <div
                                            class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                                            Rp {{ number_format($field['price_per_hour'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <div
                                        class="bg-gradient-to-br from-emerald-50 to-green-50 p-4 rounded-xl border border-emerald-100">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-emerald-100 rounded-lg mr-3">
                                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm text-gray-600">Status</div>
                                                <div class="font-semibold text-gray-900">{{ ucfirst($field['status']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-xl border border-blue-100">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm text-gray-600">Durasi</div>
                                                <div class="font-semibold text-gray-900">1 Jam</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="h-80 flex flex-col items-center justify-center p-8">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <p class="text-xl font-semibold text-gray-400 mb-2">Lapangan tidak tersedia</p>
                                <p class="text-gray-500">Silakan pilih lapangan terlebih dahulu</p>
                            </div>
                        @endif
                        @if (!empty($field) && !empty($schedules) && count($schedules) > 0)
                            <div class="p-6 md:p-8">
                                <!-- TITLE -->
                                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">
                                    Maintenance
                                </h3>

                                <!-- LIST -->
                                <div class="space-y-4">
                                    @foreach ($schedules as $schedule)
                                        <div
                                            class="flex items-start gap-4 bg-emerald-50 border border-emerald-100 p-4 rounded-xl shadow-sm">

                                            <!-- ICON -->
                                            <div
                                                class="flex-shrink-0 w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-emerald-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>

                                            <!-- CONTENT -->
                                            <div class="flex-1 text-gray-700">
                                                <div class="font-semibold text-gray-900">
                                                    {{ $schedule['date'] }}
                                                </div>

                                                <div class="text-sm text-gray-600 mt-1">
                                                    🕒 {{ $schedule['start_time'] }} - {{ $schedule['end_time'] }}
                                                </div>

                                                @if (!empty($schedule['reason']))
                                                    <div
                                                        class="text-xs text-gray-500 mt-2 italic border-l-2 border-emerald-300 pl-2">
                                                        {{ $schedule['reason'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <!-- EMPTY STATE -->
                            <div class="h-80 flex flex-col items-center justify-center p-8 text-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>

                                <p class="text-xl font-semibold text-gray-400 mb-2">
                                    Tidak ada jadwal maintenance
                                </p>
                                <p class="text-gray-500">
                                    Lapangan tersedia tanpa maintenance
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="space-y-8">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">
                        <div class="flex items-center mb-8">
                            <div class="relative">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-emerald-400 to-green-400 rounded-lg blur opacity-25">
                                </div>
                                <div class="relative bg-gradient-to-r from-emerald-500 to-green-500 p-3 rounded-lg">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-2xl font-bold text-gray-900">Form Booking</h2>
                                <p class="text-gray-600">Lengkapi informasi di bawah ini</p>
                            </div>
                        </div>

                        <!-- Date Selection Form -->
                        <form id="dateForm" action="{{ route('beranda.booking.show', $field['id']) }}" method="GET"
                            class="mb-10">
                            @csrf
                            <div class="relative">
                                <label for="date" class="block text-sm font-semibold text-gray-700 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 text-emerald-500 mr-2" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Pilih Tanggal
                                    </span>
                                </label>
                                <div class="relative group">
                                    <div
                                        class="absolute -inset-0.5 bg-gradient-to-r from-emerald-400 to-green-400 rounded-xl blur opacity-0 group-hover:opacity-30 transition duration-300">
                                    </div>
                                    <input type="date" id="date" name="date"
                                        value="{{ $date ?? now()->toDateString() }}"
                                        class="relative w-full pl-12 pr-4 py-4 bg-white rounded-xl border-2 border-gray-200 
                                                  focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 
                                                  outline-none transition-all duration-200 text-gray-900 font-medium
                                                  hover:border-emerald-300 cursor-pointer shadow-sm"
                                        onchange="this.form.submit()">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-emerald-500">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('date')
                                    <p class="mt-2 text-sm text-rose-600 font-medium flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </form>

                        <!-- Time Selection Form -->
                        <form id="bookingForm" action="{{ route('beranda.booking.store') }}" method="POST"
                            class="space-y-8">
                            @csrf
                            @if (session('user'))
                                <input type="hidden" name="user_id" value="{{ session('user')['id'] }}">
                            @endif
                            <input type="hidden" name="field_id" value="{{ $field['id'] }}">
                            <input type="hidden" name="date" value="{{ $date ?? now()->toDateString() }}">

                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <label class="block text-lg font-bold text-gray-900">
                                        <span class="flex items-center">
                                            <svg class="w-6 h-6 text-emerald-500 mr-2" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Pilih Waktu
                                        </span>
                                    </label>

                                    <!-- Legend -->
                                    <div class="flex items-center gap-4 text-sm">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-emerald-500 rounded-full mr-2"></div>
                                            <span class="text-gray-600">Tersedia</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-rose-500 rounded-full mr-2"></div>
                                            <span class="text-gray-600">Terbooking</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-emerald-600 rounded-full mr-2"></div>
                                            <span class="text-gray-600">Dipilih</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Time Slots Grid -->
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3"
                                    id="hourSlots">

                                    @php
                                        $bookedHours = $bookedHours ?? [];
                                        $maintenanceHours = $maintenanceHours ?? [];

                                        $open = \Carbon\Carbon::parse($field['open_time']);
                                        $close = \Carbon\Carbon::parse($field['close_time']);
                                    @endphp

                                    @for ($time = $open->copy(), $i = 0; $time < $close; $time->addHour(), $i++)
                                        @php
                                            $start = $time->format('H:i');
                                            $end = $time->copy()->addHour()->format('H:i');

                                            $isBooked = in_array($start, $bookedHours);
                                            $isMaintenance = in_array($start, $maintenanceHours);
                                        @endphp

                                        <button type="button"
                                            class="hour-slot relative px-4 py-4 rounded-xl text-sm font-semibold 
                   border-2 transition-all duration-200 group
                   {{ $isMaintenance
                       ? 'bg-gradient-to-br from-gray-100 to-gray-200 border-gray-300 text-gray-500 cursor-not-allowed'
                       : ($isBooked
                           ? 'bg-gradient-to-br from-rose-50 to-pink-50 border-rose-200 text-rose-700 cursor-not-allowed'
                           : 'bg-gradient-to-br from-emerald-50 to-green-50 border-emerald-200 text-emerald-700 hover:border-emerald-300 hover:shadow-md') }}
                   active:scale-95"
                                            data-index="{{ $i }}" data-start="{{ $start }}"
                                            data-end="{{ $end }}"
                                            {{ $isBooked || $isMaintenance ? 'disabled' : '' }}>

                                            {{-- BADGE --}}
                                            @if ($isMaintenance)
                                                <div class="absolute -top-2 -right-2">
                                                    <div
                                                        class="bg-gradient-to-r from-gray-600 to-gray-700 text-white text-xs px-2 py-1 rounded-full shadow">
                                                        Maintenance
                                                    </div>
                                                </div>
                                            @elseif ($isBooked)
                                                <div class="absolute -top-2 -right-2">
                                                    <div
                                                        class="bg-gradient-to-r from-rose-500 to-pink-500 text-white text-xs px-2 py-1 rounded-full shadow">
                                                        Booked
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- CONTENT --}}
                                            <div class="flex flex-col items-center">
                                                <div class="text-lg font-bold mb-1">{{ $start }}</div>
                                                <div class="text-xs text-gray-500 opacity-75">sampai</div>
                                                <div class="text-lg font-bold mt-1">{{ $end }}</div>
                                            </div>

                                            {{-- HOVER OVERLAY --}}
                                            @if (!$isBooked && !$isMaintenance)
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-green-500 opacity-0 group-hover:opacity-5 rounded-xl transition-opacity duration-300">
                                                </div>
                                            @endif
                                        </button>
                                    @endfor
                                </div>


                                <input type="hidden" name="start_time" id="start_time">
                                <input type="hidden" name="end_time" id="end_time">

                                <!-- Selected Time Display -->
                                <div class="mt-6 p-5 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl border border-emerald-200 hidden"
                                    id="selectedTimeDisplay">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-emerald-100 rounded-lg mr-3">
                                                <svg class="w-5 h-5 text-emerald-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm text-emerald-600 font-medium">Waktu yang dipilih</div>
                                                <div id="selectedTimeText" class="font-bold text-emerald-700 text-lg">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" onclick="clearSelection()"
                                            class="text-sm text-rose-600 hover:text-rose-700 font-medium px-3 py-1 hover:bg-rose-50 rounded-lg transition-colors">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-6">
                                <button type="submit" id="submitButton"
                                    class="w-full py-4 rounded-xl font-bold text-lg tracking-wide text-white
                                               bg-gradient-to-r from-emerald-600 via-emerald-500 to-green-600 
                                               hover:from-emerald-700 hover:via-emerald-600 hover:to-green-700 
                                               active:scale-[0.98] transition-all duration-200
                                               shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed
                                               flex items-center justify-center group relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-emerald-700 to-green-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <span class="relative flex items-center">
                                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Booking Sekarang
                                    </span>
                                </button>

                                <p class="text-center text-sm text-gray-500 mt-4">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Data Anda aman dan terjamin
                                </p>
                            </div>
                        </form>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-100 p-6">
                        <div class="flex items-start mb-4">
                            <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">Informasi Penting</h3>
                                <ul class="space-y-2 text-sm text-gray-600">
                                    <li class="flex items-start">
                                        <span class="text-blue-500 mr-2">•</span>
                                        Booking dapat dibatalkan maksimal 2 jam sebelum waktu main
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-blue-500 mr-2">•</span>
                                        Konfirmasi booking akan dikirim via WhatsApp
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-blue-500 mr-2">•</span>
                                        Pembayaran dilakukan di tempat sebelum mulai bermain
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-blue-500 mr-2">•</span>
                                        Durasi bermain minimal 1 jam
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const selectedDate = "{{ $date ?? now()->toDateString() }}";
        document.addEventListener('DOMContentLoaded', function() {
            const slots = Array.from(document.querySelectorAll('.hour-slot'));
            const selectedSlots = new Set();
            const submitButton = document.getElementById('submitButton');
            const selectedTimeDisplay = document.getElementById('selectedTimeDisplay');
            const selectedTimeText = document.getElementById('selectedTimeText');

            const today = new Date().toISOString().slice(0, 10);
            const now = new Date();

            // 🔥 DISABLE JAM YANG SUDAH LEWAT (HARI INI)
            if (selectedDate === today) {
                slots.forEach(slot => {
                    const startTime = slot.dataset.start; // "14:00"
                    const [hour, minute] = startTime.split(':');

                    const slotTime = new Date();
                    slotTime.setHours(hour, minute, 0, 0);

                    if (slotTime <= now) {
                        slot.disabled = true;
                        slot.classList.remove('bg-gradient-to-br', 'from-emerald-50', 'to-green-50',
                            'text-emerald-700', 'border-emerald-200');
                        slot.classList.add(
                            'bg-gradient-to-br',
                            'from-gray-100',
                            'to-gray-200',
                            'border-gray-300',
                            'text-gray-400',
                            'cursor-not-allowed'
                        );
                    }
                });
            }

            function updateHiddenInputs() {
                const startInput = document.getElementById('start_time');
                const endInput = document.getElementById('end_time');

                if (selectedSlots.size === 0) {
                    startInput.value = '';
                    endInput.value = '';
                    submitButton.disabled = true;
                    selectedTimeDisplay.classList.add('hidden');
                    return;
                }

                const indexes = Array.from(selectedSlots).sort((a, b) => a - b);
                const startTime = slots[indexes[0]].dataset.start;
                const endTime = slots[indexes[indexes.length - 1]].dataset.end;

                startInput.value = startTime;
                endInput.value = endTime;

                submitButton.disabled = false;

                selectedTimeText.textContent = `${startTime} - ${endTime} (${selectedSlots.size} jam)`;
                selectedTimeDisplay.classList.remove('hidden');
            }

            function toggleSlot(slot, index) {
                if (slot.disabled) return;

                if (selectedSlots.has(index)) {
                    selectedSlots.delete(index);
                    slot.classList.remove('bg-gradient-to-r', 'from-emerald-500', 'to-green-500', 'text-white',
                        'border-emerald-600', 'scale-105');
                    slot.classList.add('bg-gradient-to-br', 'from-emerald-50', 'to-green-50', 'text-emerald-700',
                        'border-emerald-200');
                } else {
                    selectedSlots.add(index);
                    slot.classList.remove('bg-gradient-to-br', 'from-emerald-50', 'to-green-50', 'text-emerald-700',
                        'border-emerald-200');
                    slot.classList.add('bg-gradient-to-r', 'from-emerald-500', 'to-green-500', 'text-white',
                        'border-emerald-600', 'scale-105');
                }

                updateHiddenInputs();
            }

            slots.forEach((slot, index) => {
                slot.addEventListener('click', function() {
                    toggleSlot(slot, index);
                });
            });

            window.clearSelection = function() {
                selectedSlots.forEach(index => {
                    const slot = slots[index];
                    slot.classList.remove('bg-gradient-to-r', 'from-emerald-500', 'to-green-500',
                        'text-white', 'border-emerald-600', 'scale-105');
                    slot.classList.add('bg-gradient-to-br', 'from-emerald-50', 'to-green-50',
                        'text-emerald-700', 'border-emerald-200');
                });
                selectedSlots.clear();
                updateHiddenInputs();
            };

            // Form submission loader
            const bookingForm = document.getElementById('bookingForm');
            bookingForm.addEventListener('submit', function() {
                submitButton.innerHTML = `
                    <div class="flex items-center justify-center">
                        <div class="spinner border-2 border-white border-t-transparent rounded-full w-6 h-6 animate-spin mr-3"></div>
                        Memproses booking...
                    </div>
                `;
                submitButton.disabled = true;
            });
        });
    </script>
@endsection
