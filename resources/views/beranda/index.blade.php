@extends('beranda.layouts.master')

@section('content')
    <!-- Enhanced Background with Gradient Overlay - Responsive -->
    <div class="absolute inset-0 top-[70px] md:top-[80px] -z-50">
        <div class="relative h-[40vh] sm:h-[50vh] md:h-[60vh]">
            <img src="{{ asset('aset/lapangan-bg.jpg') }}"
                class="absolute inset-0 h-full w-full object-cover transform scale-105 animate-[slowZoom_30s_ease-in-out_infinite]">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-transparent"></div>
            <div
                class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-transparent via-black/10 to-transparent">
            </div>
        </div>
    </div>

    <!-- Enhanced Navbar SectionNav - Responsive -->
    <div id="sectionNav"
        class="sticky top-14 sm:top-16 z-40 bg-black/80 backdrop-blur-xl border-b border-white/10 shadow-xl transition-all duration-300">
        <div class="max-w-7xl mx-auto px-2 sm:px-4">
            <div
                class="flex justify-center items-center gap-2 sm:gap-4 md:gap-6 lg:gap-10 text-sm sm:text-base md:text-lg lg:text-xl py-2 sm:py-3 md:py-4 overflow-x-auto">
                <a href="#banner"
                    class="relative px-1 sm:px-2 py-1 text-white/90 hover:text-white transition-all duration-300 group whitespace-nowrap">
                    <span class="relative z-10 text-xs sm:text-sm md:text-base">Banner</span>
                    <div
                        class="absolute inset-0 bg-[#13810A] rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 opacity-0 group-hover:opacity-20">
                    </div>
                    <div
                        class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-[#13810A] -translate-x-1/2 group-hover:w-3/4 transition-all duration-300">
                    </div>
                </a>
                <a href="#galeri"
                    class="relative px-1 sm:px-2 py-1 text-white/90 hover:text-white transition-all duration-300 group whitespace-nowrap">
                    <span class="relative z-10 text-xs sm:text-sm md:text-base">Galeri</span>
                    <div
                        class="absolute inset-0 bg-[#13810A] rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 opacity-0 group-hover:opacity-20">
                    </div>
                    <div
                        class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-[#13810A] -translate-x-1/2 group-hover:w-3/4 transition-all duration-300">
                    </div>
                </a>
                <a href="#kontak"
                    class="relative px-1 sm:px-2 py-1 text-white/90 hover:text-white transition-all duration-300 group whitespace-nowrap">
                    <span class="relative z-10 text-xs sm:text-sm md:text-base">Kontak</span>
                    <div
                        class="absolute inset-0 bg-[#13810A] rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 opacity-0 group-hover:opacity-20">
                    </div>
                    <div
                        class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-[#13810A] -translate-x-1/2 group-hover:w-3/4 transition-all duration-300">
                    </div>
                </a>
                <a href="#maps"
                    class="relative px-1 sm:px-2 py-1 text-white/90 hover:text-white transition-all duration-300 group whitespace-nowrap">
                    <span class="relative z-10 text-xs sm:text-sm md:text-base">Maps</span>
                    <div
                        class="absolute inset-0 bg-[#13810A] rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 opacity-0 group-hover:opacity-20">
                    </div>
                    <div
                        class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-[#13810A] -translate-x-1/2 group-hover:w-3/4 transition-all duration-300">
                    </div>
                </a>
                <a href="{{ route('history.index') }}"
                    class="relative px-1 sm:px-2 py-1 text-white/90 hover:text-white transition-all duration-300 group whitespace-nowrap">
                    <span class="relative z-10 text-xs sm:text-sm md:text-base">Riwayat</span>
                    <div
                        class="absolute inset-0 bg-[#13810A] rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 opacity-0 group-hover:opacity-20">
                    </div>
                    <div
                        class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-[#13810A] -translate-x-1/2 group-hover:w-3/4 transition-all duration-300">
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Enhanced Card Search - Responsive -->
    <section id="home"
        class="flex justify-center items-start mt-[250px] sm:mt-[280px] md:mt-[300px] px-4 sm:px-6 relative z-10">
        <div
            class="bg-gradient-to-br from-[#7A0010] to-[#5A000C] p-4 sm:p-6 md:p-8 rounded-2xl sm:rounded-3xl shadow-2xl w-full max-w-[1500px] border border-white/10">
            <div class="mb-4 sm:mb-6 text-center">
                <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-white mb-1 sm:mb-2">Cari Lapangan Futsal</h2>
                <p class="text-white/80 text-xs sm:text-sm">Temukan lapangan yang sesuai dengan kebutuhan Anda</p>
            </div>

            <form id="myForm" action="{{ route('beranda.search') }}" method="post"
                class="flex flex-col md:flex-row items-center justify-between gap-4 sm:gap-6">
                @csrf

                <!-- Tanggal & Jam -->
                <div class="flex flex-col gap-3 sm:gap-5 w-full md:w-[45%]">
                    <div class="group">
                        <label for="tanggal_main"
                            class="text-white font-semibold mb-1 sm:mb-2 block text-sm sm:text-base md:text-lg text-center">Tanggal
                            Main</label>
                        <div class="relative">
                            <input type="date" id="tanggal_main" name="tanggal_main"
                                value="{{ old('tanggal_main', $request['tanggal_main'] ?? '') }}"
                                class="w-full px-3 sm:px-4 md:px-5 py-2 sm:py-3 md:py-4 rounded-lg sm:rounded-xl md:rounded-xl bg-white text-gray-800 text-xs sm:text-sm md:text-base text-center outline-none 
                                   focus:ring-2 sm:focus:ring-3 focus:ring-[#FF4C4C]/50 focus:border-[#FF4C4C] 
                                   transition-all duration-300 cursor-pointer shadow-lg
                                   group-hover:shadow-xl group-hover:-translate-y-0.5" />
                            <div class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-calendar-day text-sm sm:text-base"></i>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <label for="jam_mulai"
                            class="text-white font-semibold mb-1 sm:mb-2 block text-sm sm:text-base md:text-lg text-center">Jam
                            Mulai</label>
                        <div class="relative">
                            <select id="jam_mulai" name="open_time"
                                class="w-full px-3 sm:px-4 md:px-5 py-2 sm:py-3 md:py-4 rounded-lg sm:rounded-xl md:rounded-xl bg-white text-gray-800 text-xs sm:text-sm md:text-base text-center outline-none 
                                   focus:ring-2 sm:focus:ring-3 focus:ring-[#FF4C4C]/50 focus:border-[#FF4C4C] 
                                   transition-all duration-300 cursor-pointer shadow-lg pr-10 sm:pr-12
                                   group-hover:shadow-xl group-hover:-translate-y-0.5">
                                <option value="">Pilih Jam</option>
                                @for ($i = 8; $i <= 21; $i++)
                                    <option value="{{ sprintf('%02d:00', $i) }}"
                                        {{ ($request['open_time'] ?? '') == sprintf('%02d:00', $i) ? 'selected' : '' }}>
                                        {{ sprintf('%02d:00', $i) }}
                                    </option>
                                @endfor
                            </select>
                            <div
                                class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tipe & Jam Selesai -->
                <div class="flex flex-col gap-3 sm:gap-5 w-full md:w-[45%]">
                    <div class="group">
                        <label for="category_field_id"
                            class="text-white font-semibold mb-1 sm:mb-2 block text-sm sm:text-base md:text-lg text-center">
                            Tipe Lapangan
                        </label>
                        <div class="relative">
                            <select id="category_field_id" name="category_field_id"
                                class="w-full px-3 sm:px-4 md:px-5 py-2 sm:py-3 md:py-4 rounded-lg sm:rounded-xl md:rounded-xl bg-white text-gray-800 text-xs sm:text-sm md:text-base text-center outline-none 
                                   focus:ring-2 sm:focus:ring-3 focus:ring-[#FF4C4C]/50 focus:border-[#FF4C4C] 
                                   transition-all duration-300 cursor-pointer shadow-lg pr-10 sm:pr-12
                                   group-hover:shadow-xl group-hover:-translate-y-0.5">
                                <option value="">Pilih Tipe Lapangan</option>
                                @foreach ($categoriesFields ?? [] as $cat)
                                    <option value="{{ $cat['id'] }}"
                                        {{ old('category_field_id', $request['category_field_id'] ?? '') == $cat['id'] ? 'selected' : '' }}>
                                        {{ $cat['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <label for="close_time"
                            class="text-white font-semibold mb-1 sm:mb-2 block text-sm sm:text-base md:text-lg text-center">Jam
                            Selesai</label>
                        <div class="relative">
                            <select id="close_time" name="close_time"
                                class="w-full px-3 sm:px-4 md:px-5 py-2 sm:py-3 md:py-4 rounded-lg sm:rounded-xl md:rounded-xl bg-white text-gray-800 text-xs sm:text-sm md:text-base text-center outline-none 
                                   focus:ring-2 sm:focus:ring-3 focus:ring-[#FF4C4C]/50 focus:border-[#FF4C4C] 
                                   transition-all duration-300 cursor-pointer shadow-lg pr-10 sm:pr-12
                                   group-hover:shadow-xl group-hover:-translate-y-0.5">
                                <option value="">Pilih Jam</option>
                                @for ($i = 8; $i <= 21; $i++)
                                    <option value="{{ sprintf('%02d:00', $i) }}"
                                        {{ ($request['close_time'] ?? '') == sprintf('%02d:00', $i) ? 'selected' : '' }}>
                                        {{ sprintf('%02d:00', $i) }}
                                    </option>
                                @endfor
                            </select>
                            <div
                                class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-center items-center w-full md:w-[20%] mt-2 sm:mt-4 md:mt-0">
                    <button type="submit"
                        class="group relative w-full bg-gradient-to-r from-[#13810A] via-[#0f6e09] to-[#0d5c07] 
                           text-white font-bold px-4 sm:px-6 md:px-9 py-3 sm:py-4 md:py-5 rounded-lg sm:rounded-xl md:rounded-xl text-sm sm:text-base md:text-xl shadow-xl 
                           hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center gap-1 sm:gap-2">
                            <i class="fas fa-search text-sm sm:text-base"></i>
                            <span class="text-xs sm:text-sm md:text-base">Search</span>
                        </span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-[#0d5c07] via-[#0f6e09] to-[#13810A] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-[#13810A]/30 to-transparent blur opacity-0 group-hover:opacity-100 transition-all duration-500">
                        </div>
                    </button>
                </div>

                <div id="formLoader"
                    class="absolute inset-0 bg-white/90 backdrop-blur-sm flex items-center justify-center hidden z-10 rounded-2xl sm:rounded-3xl">
                    <div class="text-center">
                        <div
                            class="w-12 h-12 sm:w-16 sm:h-16 border-4 border-[#13810A] border-t-transparent rounded-full animate-spin mx-auto mb-3 sm:mb-4">
                        </div>
                        <p class="text-gray-700 font-semibold text-sm sm:text-base">Memproses...</p>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Enhanced Card Lapangan - Responsive -->
    <div
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-4 sm:gap-6 md:gap-8 max-w-[1500px] mx-auto mt-12 sm:mt-16 md:mt-20 w-[95%] sm:w-[97%] px-2 sm:px-0">
        @forelse ($fields as $field)
            @php
                $status = $field['status_now'] ?? 'available';
                $statusConfig = [
                    'available' => [
                        'bg' => 'bg-gradient-to-r from-[#13810A] to-emerald-600',
                        'text' => 'Tersedia',
                        'icon' => 'fas fa-check-circle',
                    ],
                    'booked' => [
                        'bg' => 'bg-gradient-to-r from-[#8B0C17] to-red-600',
                        'text' => 'Tidak Tersedia',
                        'icon' => 'fas fa-times-circle',
                    ],
                    'maintenance' => [
                        'bg' => 'bg-gradient-to-r from-[#D37B00] to-amber-600',
                        'text' => 'Maintenance',
                        'icon' => 'fas fa-tools',
                    ],
                    'closed' => [
                        'bg' => 'bg-gradient-to-r from-gray-600 to-gray-700',
                        'text' => 'Tutup',
                        'icon' => 'fas fa-lock',
                    ],
                ];
                $statusInfo = $statusConfig[$status] ?? $statusConfig['available'];
            @endphp

            <div onclick="window.location='{{ route('beranda.booking.show', $field['id']) }}'"
                class="relative rounded-xl sm:rounded-2xl md:rounded-3xl overflow-hidden shadow-lg sm:shadow-xl group hover:shadow-2xl hover:scale-[1.02] 
                       transition-all duration-500 cursor-pointer bg-white border border-gray-200">

                <!-- Image Container -->
                <div class="relative h-48 sm:h-56 md:h-64 overflow-hidden">
                    <img src="{{ $field['image'] ?? asset('aset/no-image.png') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                    <!-- Status Badge -->
                    @if ($isSearch)
                        <div class="absolute top-2 sm:top-3 md:top-4 right-2 sm:right-3 md:right-4">
                            <span
                                class="{{ $statusInfo['bg'] }} text-white px-2 sm:px-3 md:px-4 py-1 sm:py-1.5 md:py-2 rounded-full text-xs sm:text-sm font-semibold 
                                       shadow-lg flex items-center gap-1 sm:gap-2">
                                <i class="{{ $statusInfo['icon'] }} text-xs sm:text-sm"></i>
                                <span class="hidden xs:inline">{{ $statusInfo['text'] }}</span>
                                <span class="xs:hidden">●</span>
                            </span>
                        </div>
                    @endif

                    <!-- Title Overlay -->
                    <div
                        class="absolute bottom-2 sm:bottom-3 md:bottom-4 left-1/2 transform -translate-x-1/2 text-center w-full px-2 sm:px-3 md:px-4">
                        <h2
                            class="text-white text-base sm:text-lg md:text-xl lg:text-2xl font-bold mb-1 sm:mb-2 drop-shadow-lg truncate">
                            {{ $field['name'] }}</h2>
                        <div
                            class="flex flex-col xs:flex-row items-center justify-center gap-1 xs:gap-2 sm:gap-3 md:gap-4 text-white/90 text-xs sm:text-sm">
                            <span class="flex items-center gap-1">
                                <i class="fas fa-clock text-xs sm:text-sm"></i>
                                {{ $field['open_time'] }} - {{ $field['close_time'] }}
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="fas fa-tag text-xs sm:text-sm"></i>
                                Rp {{ number_format($field['price_per_hour'] ?? 0, 0, ',', '.') }}/jam
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Content Footer -->
                <div class="p-3 sm:p-4 md:p-6 bg-gradient-to-b from-white to-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-gray-600">
                            <div class="flex items-center gap-1 sm:gap-2 mb-1">
                                <i class="fas fa-ruler-combined text-[#13810A] text-sm sm:text-base"></i>
                                <span class="font-medium text-sm sm:text-base">{{ $field['size'] ?? 'Standar' }}</span>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-500 line-clamp-1">
                                {{ $field['description'] ?? 'Lapangan futsal berkualitas' }}</p>
                        </div>
                        <div
                            class="text-[#13810A] font-bold text-sm sm:text-base group-hover:translate-x-2 transition-transform duration-300">
                            Pesan <i class="fas fa-arrow-right ml-1 text-xs sm:text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div
                class="col-span-1 sm:col-span-2 text-center py-8 sm:py-10 md:py-12 bg-white rounded-xl sm:rounded-2xl md:rounded-3xl shadow-lg border border-gray-200">
                <div
                    class="w-12 h-12 sm:w-16 sm:h-16 md:w-20 md:h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <i class="fas fa-search text-xl sm:text-2xl md:text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-700 mb-2">Lapangan Tidak Ditemukan</h3>
                <p class="text-gray-500 text-sm sm:text-base mb-4 sm:mb-6">Coba dengan kriteria pencarian yang berbeda</p>
                <a href="{{ route('beranda.index') }}"
                    class="inline-flex items-center gap-1 sm:gap-2 bg-[#13810A] text-white px-4 sm:px-5 md:px-6 py-2 sm:py-2.5 md:py-3 rounded-lg sm:rounded-xl font-medium hover:bg-[#0f6e09] transition-colors duration-300 text-sm sm:text-base">
                    <i class="fas fa-arrow-left text-xs sm:text-sm"></i> Kembali ke Beranda
                </a>
            </div>
        @endforelse
    </div>

    {{-- Enhanced Tombol Lihat Semua / Tutup - Responsive --}}
    @if (!$showAll && $totalFields > 4)
        <div class="flex justify-center mt-8 sm:mt-10 md:mt-12 mb-12 sm:mb-14 md:mb-16 px-2">
            <a href="{{ url()->current() . '?' . http_build_query(array_merge($request, ['show' => 'all'])) }}"
                class="group relative px-4 sm:px-6 md:px-8 py-2 sm:py-3 md:py-4 bg-gradient-to-r from-[#13810A] to-[#0f6e09] 
                      text-white font-bold rounded-lg sm:rounded-xl text-sm sm:text-base md:text-lg shadow-lg
                      hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden">
                <span class="relative z-10 flex items-center gap-1 sm:gap-2 md:gap-3">
                    Lihat Semua Lapangan
                    <i
                        class="fas fa-chevron-down group-hover:translate-y-1 transition-transform duration-300 text-xs sm:text-sm"></i>
                </span>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-[#0f6e09] to-[#0d5c07] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </a>
        </div>
    @endif

    @if ($showAll)
        <div class="flex justify-center mt-8 sm:mt-10 md:mt-12 mb-12 sm:mb-14 md:mb-16 px-2">
            <a href="{{ url()->current() }}"
                class="group relative px-4 sm:px-6 md:px-8 py-2 sm:py-3 md:py-4 bg-gradient-to-r from-red-600 to-[#BF0E26] 
                      text-white font-bold rounded-lg sm:rounded-xl text-sm sm:text-base md:text-lg shadow-lg
                      hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden">
                <span class="relative z-10 flex items-center gap-1 sm:gap-2 md:gap-3">
                    <i class="fas fa-times text-xs sm:text-sm"></i> Tutup
                </span>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-[#BF0E26] to-red-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </a>
        </div>
    @endif

    <!-- Enhanced Banner Section - Responsive -->
    @if (!$isSearch)
        <section id="banner"
            class="py-8 sm:py-12 md:py-16 px-4 sm:px-6 md:px-12 bg-gradient-to-b from-white to-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-6 sm:mb-8 md:mb-12">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-2 sm:mb-3 md:mb-4 text-gray-800">
                        Promo & Event</h2>
                    <p class="text-gray-600 text-sm sm:text-base md:text-lg">Dapatkan penawaran spesial dari EZFutsal</p>
                </div>

                <div
                    class="relative max-w-6xl mx-auto overflow-hidden rounded-xl sm:rounded-2xl md:rounded-3xl shadow-2xl">
                    <div id="banner-carousel" class="flex transition-transform duration-700 ease-in-out">
                        @foreach ($banners as $banner)
                            <div class="min-w-full relative">
                                <img src="{{ $banner['image'] }}" alt="Banner {{ $loop->iteration }}"
                                    class="w-full h-[250px] sm:h-[300px] md:h-[350px] lg:h-[400px] object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Buttons -->
                    <button id="prevBtn"
                        class="absolute left-2 sm:left-3 md:left-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-white/20 backdrop-blur-sm 
                                   rounded-full flex items-center justify-center text-white hover:bg-white/30 
                                   transition-all duration-300 shadow-lg">
                        <i class="fas fa-chevron-left text-xs sm:text-sm"></i>
                    </button>
                    <button id="nextBtn"
                        class="absolute right-2 sm:right-3 md:right-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-white/20 backdrop-blur-sm 
                                   rounded-full flex items-center justify-center text-white hover:bg-white/30 
                                   transition-all duration-300 shadow-lg">
                        <i class="fas fa-chevron-right text-xs sm:text-sm"></i>
                    </button>

                    <!-- Dots -->
                    <div
                        class="absolute bottom-2 sm:bottom-3 md:bottom-4 lg:bottom-6 left-1/2 -translate-x-1/2 flex gap-2 sm:gap-3">
                        @foreach ($banners as $banner)
                            <button
                                class="banner-dot w-2 h-2 sm:w-2.5 sm:h-2.5 md:w-3 md:h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 
                                          {{ $loop->first ? '!bg-white w-4 sm:w-5 md:w-6 lg:w-8' : '' }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Galeri Section - Responsive -->
        <section id="galeri"
            class="py-12 sm:py-16 md:py-20 px-4 sm:px-6 md:px-12 bg-gradient-to-b from-gray-50 to-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-6 sm:mb-8 md:mb-12">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-2 sm:mb-3 md:mb-4 text-gray-800">
                        Galeri EZFutsal</h2>
                    <p class="text-gray-600 text-sm sm:text-base md:text-lg">Koleksi momen seru di lapangan kami</p>
                </div>

                <!-- Filter Buttons -->
                <div class="flex justify-center gap-2 sm:gap-3 md:gap-4 mb-6 sm:mb-8 md:mb-12 flex-wrap px-2">
                    <button
                        class="filter-btn bg-gradient-to-r from-[#13810A] to-[#0f6e09] 
                                 text-white px-3 sm:px-4 md:px-6 py-1.5 sm:py-2 md:py-3 rounded-lg sm:rounded-xl font-bold border-2 border-[#13810A]
                                 shadow-lg hover:shadow-xl transition-all duration-300 text-xs sm:text-sm md:text-base"
                        data-filter="all">
                        Semua
                    </button>

                    @foreach ($categoriesGalleries as $cat)
                        <button
                            class="filter-btn bg-white text-[#13810A] border-2 border-[#13810A] 
                                 hover:bg-gradient-to-r hover:from-[#13810A] hover:to-[#0f6e09] hover:text-white 
                                 px-3 sm:px-4 md:px-6 py-1.5 sm:py-2 md:py-3 rounded-lg sm:rounded-xl font-bold transition-all duration-300 shadow-md hover:shadow-lg text-xs sm:text-sm md:text-base"
                            data-filter="{{ strtolower($cat['name']) }}">
                            {{ ucfirst($cat['name']) }}
                        </button>
                    @endforeach
                </div>

                <!-- Gallery Grid -->
                <div id="gallery-grid"
                    class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-5 lg:gap-6 px-2 sm:px-0">
                    @foreach ($galleries as $gallery)
                        @php
                            $category = strtolower($gallery['category_gallery']['name'] ?? 'unknown');
                        @endphp
                        <div
                            class="gallery-item {{ $category }} relative group cursor-pointer overflow-hidden rounded-lg sm:rounded-xl md:rounded-2xl 
                                    shadow-lg hover:shadow-2xl transition-all duration-500">
                            <img src="{{ $gallery['image'] }}" alt="{{ ucfirst($category) }} {{ $loop->iteration }}"
                                class="w-full h-32 sm:h-40 md:h-48 lg:h-52 xl:h-64 object-cover group-hover:scale-110 transition-transform duration-700">

                            <!-- Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent 
                                        opacity-0 group-hover:opacity-100 transition-opacity duration-500 
                                        flex items-end p-2 sm:p-3 md:p-4">
                                <div
                                    class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                    <div
                                        class="inline-flex items-center gap-1 sm:gap-2 bg-white/20 backdrop-blur-sm px-2 sm:px-3 py-1 sm:py-1.5 rounded-full mb-1 sm:mb-2">
                                        <i class="fas fa-image text-xs"></i>
                                        <span class="text-xs font-medium capitalize">{{ $category }}</span>
                                    </div>
                                    <p class="text-xs sm:text-sm font-semibold">Gallery {{ $loop->iteration }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Enhanced Kontak Section - Responsive -->
        <section id="kontak"
            class="py-12 sm:py-16 md:py-20 px-4 sm:px-6 md:px-12 bg-gradient-to-b from-white to-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-6 sm:mb-8 md:mb-12">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-2 sm:mb-3 md:mb-4 text-gray-800">
                        Hubungi Kami</h2>
                    <p class="text-gray-600 text-sm sm:text-base md:text-lg">Tim kami siap membantu kebutuhan Anda</p>
                </div>

                <div
                    class="bg-white rounded-xl sm:rounded-2xl md:rounded-3xl p-4 sm:p-6 md:p-8 mx-auto w-[95%] sm:w-[97%] max-w-[1500px] shadow-2xl border border-gray-200">
                    <!-- Location -->
                    <div
                        class="flex items-start space-x-3 sm:space-x-4 md:space-x-6 pb-4 sm:pb-6 md:pb-8 border-b border-gray-200/50 group hover:bg-gray-50/50 p-2 sm:p-3 md:p-4 rounded-xl sm:rounded-2xl transition-all duration-300">
                        <div
                            class="bg-gradient-to-br from-[#7A0010] to-[#5A000C] text-white w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 flex items-center 
                                    justify-center rounded-xl sm:rounded-2xl text-lg sm:text-xl md:text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="text-left flex-1">
                            <h3 class="font-bold text-base sm:text-lg md:text-xl text-gray-800 mb-1 sm:mb-2">Location</h3>
                            <p class="text-gray-600 text-sm sm:text-base">Jl. Perusahaan, Perumahan Tirtasani, Estate
                                Malang</p>
                            <a href="#maps"
                                class="inline-flex items-center gap-1 sm:gap-2 text-[#13810A] font-semibold mt-1 sm:mt-2 
                                                 hover:gap-2 sm:hover:gap-3 transition-all duration-300 text-sm sm:text-base">
                                Lihat di peta <i class="fas fa-arrow-right text-xs sm:text-sm"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div
                        class="flex items-start space-x-3 sm:space-x-4 md:space-x-6 py-4 sm:py-6 md:py-8 border-b border-gray-200/50 group hover:bg-gray-50/50 p-2 sm:p-3 md:p-4 rounded-xl sm:rounded-2xl transition-all duration-300">
                        <div
                            class="bg-gradient-to-br from-[#7A0010] to-[#5A000C] text-white w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 flex items-center 
                                    justify-center rounded-xl sm:rounded-2xl text-lg sm:text-xl md:text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="text-left flex-1">
                            <h3 class="font-bold text-base sm:text-lg md:text-xl text-gray-800 mb-1 sm:mb-2">Email</h3>
                            <p class="text-gray-600 text-sm sm:text-base">lapanganfutsal@gmail.com</p>
                            <a href="mailto:lapanganfutsal@gmail.com"
                                class="inline-flex items-center gap-1 sm:gap-2 text-[#13810A] font-semibold mt-1 sm:mt-2 
                                      hover:gap-2 sm:hover:gap-3 transition-all duration-300 text-sm sm:text-base">
                                Kirim email <i class="fas fa-arrow-right text-xs sm:text-sm"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Call -->
                    <div
                        class="flex items-start space-x-3 sm:space-x-4 md:space-x-6 pt-4 sm:pt-6 md:pt-8 group hover:bg-gray-50/50 p-2 sm:p-3 md:p-4 rounded-xl sm:rounded-2xl transition-all duration-300">
                        <div
                            class="bg-gradient-to-br from-[#7A0010] to-[#5A000C] text-white w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 flex items-center 
                                    justify-center rounded-xl sm:rounded-2xl text-lg sm:text-xl md:text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="text-left flex-1">
                            <h3 class="font-bold text-base sm:text-lg md:text-xl text-gray-800 mb-1 sm:mb-2">Telepon</h3>
                            <p class="text-gray-600 text-sm sm:text-base">+62 000-0000-0000</p>
                            <a href="tel:+620000000000"
                                class="inline-flex items-center gap-1 sm:gap-2 text-[#13810A] font-semibold mt-1 sm:mt-2 
                                      hover:gap-2 sm:hover:gap-3 transition-all duration-300 text-sm sm:text-base">
                                Hubungi kami <i class="fas fa-arrow-right text-xs sm:text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Maps Section - Responsive -->
        <section id="maps"
            class="py-12 sm:py-16 md:py-20 px-4 sm:px-6 md:px-12 bg-gradient-to-b from-gray-50 to-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-6 sm:mb-8 md:mb-12">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-2 sm:mb-3 md:mb-4 text-gray-800">
                        Lokasi Kami</h2>
                    <p class="text-gray-600 text-sm sm:text-base md:text-lg">Temukan kami dengan mudah di Google Maps</p>
                </div>

                <div
                    class="max-w-[1500px] mx-auto bg-white rounded-xl sm:rounded-2xl md:rounded-3xl shadow-2xl overflow-hidden border border-gray-200 relative">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.8660680895628!2d112.63119177302289!3d-7.909057078710882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd62b9fde296155%3A0x9f2b9e49f08bd861!2sTirtasani%20Estate%20F%2F3!5e0!3m2!1sid!2sid!4v1760976402420!5m2!1sid!2sid"
                        class="w-full h-[300px] sm:h-[350px] md:h-[400px] lg:h-[450px] xl:h-[500px] border-0"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <!-- Map Info Overlay -->
                    <div
                        class="absolute bottom-2 sm:bottom-3 md:bottom-4 lg:bottom-6 left-2 sm:left-3 md:left-4 lg:left-6 bg-white/95 backdrop-blur-sm rounded-lg sm:rounded-xl md:rounded-2xl p-2 sm:p-3 md:p-4 lg:p-5 max-w-[180px] sm:max-w-[200px] md:max-w-xs shadow-xl border border-gray-200">
                        <div class="flex items-center gap-2 sm:gap-3 mb-1 sm:mb-2 md:mb-3">
                            <div
                                class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 bg-gradient-to-r from-[#13810A] to-[#0f6e09] rounded-lg sm:rounded-xl flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white text-sm sm:text-base"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-xs sm:text-sm md:text-base">EZFutsal Malang</h4>
                                <p class="text-gray-600 text-xs sm:text-sm">Buka 08:00 - 22:00</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-xs sm:text-sm">Jl. Perusahaan, Perumahan Tirtasani, Estate Malang</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <style>
        @keyframes slowZoom {

            0%,
            100% {
                transform: scale(1.05);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* Custom breakpoint for extra small devices */
        @media (max-width: 475px) {
            .xs\:inline {
                display: inline !important;
            }

            .xs\:hidden {
                display: none !important;
            }

            .xs\:flex-row {
                flex-direction: row !important;
            }
        }

        /* Custom scrollbar for horizontal nav */
        #sectionNav div::-webkit-scrollbar {
            height: 4px;
        }

        #sectionNav div::-webkit-scrollbar-track {
            background: transparent;
        }

        #sectionNav div::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Banner Carousel
            let currentSlide = 0;
            const slides = document.querySelectorAll('#banner-carousel > div');
            const dots = document.querySelectorAll('.banner-dot');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            function updateCarousel() {
                const carousel = document.getElementById('banner-carousel');
                if (carousel) {
                    carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
                }

                dots.forEach((dot, index) => {
                    if (dot) {
                        dot.classList.toggle('!bg-white', index === currentSlide);
                        dot.classList.toggle('w-4', index === currentSlide);
                        dot.classList.toggle('sm:w-5', index === currentSlide && window.innerWidth >= 640);
                        dot.classList.toggle('md:w-6', index === currentSlide && window.innerWidth >= 768);
                        dot.classList.toggle('lg:w-8', index === currentSlide && window.innerWidth >= 1024);
                        dot.classList.toggle('w-2', index !== currentSlide && window.innerWidth < 640);
                        dot.classList.toggle('sm:w-2.5', index !== currentSlide && window.innerWidth >=
                            640);
                        dot.classList.toggle('md:w-3', index !== currentSlide && window.innerWidth >= 768);
                    }
                });
            }

            if (prevBtn && nextBtn) {
                prevBtn.addEventListener('click', () => {
                    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                    updateCarousel();
                });

                nextBtn.addEventListener('click', () => {
                    currentSlide = (currentSlide + 1) % slides.length;
                    updateCarousel();
                });

                // Auto slide every 5 seconds
                setInterval(() => {
                    currentSlide = (currentSlide + 1) % slides.length;
                    updateCarousel();
                }, 5000);
            }

            // Gallery Filter
            const filterButtons = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Update active button
                    filterButtons.forEach(btn => {
                        if (btn.dataset.filter === 'all') {
                            btn.classList.remove('bg-white', 'text-[#13810A]',
                                'border-[#13810A]');
                            btn.classList.add('bg-gradient-to-r', 'from-[#13810A]',
                                'to-[#0f6e09]', 'text-white');
                        } else {
                            btn.classList.remove('bg-gradient-to-r', 'from-[#13810A]',
                                'to-[#0f6e09]', 'text-white');
                            btn.classList.add('bg-white', 'text-[#13810A]',
                                'border-[#13810A]');
                        }
                    });

                    if (button.dataset.filter === 'all') {
                        button.classList.remove('bg-white', 'text-[#13810A]', 'border-[#13810A]');
                        button.classList.add('bg-gradient-to-r', 'from-[#13810A]', 'to-[#0f6e09]',
                            'text-white');
                    } else {
                        button.classList.remove('bg-white', 'text-[#13810A]', 'border-[#13810A]');
                        button.classList.add('bg-gradient-to-r', 'from-[#13810A]', 'to-[#0f6e09]',
                            'text-white');
                    }

                    // Filter gallery items
                    const filterValue = button.dataset.filter;

                    galleryItems.forEach(item => {
                        if (filterValue === 'all' || item.classList.contains(filterValue)) {
                            item.style.display = 'block';
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'scale(1)';
                            }, 10);
                        } else {
                            item.style.opacity = '0';
                            item.style.transform = 'scale(0.8)';
                            setTimeout(() => {
                                item.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });

            // Form Loader
            const form = document.getElementById('myForm');
            const formLoader = document.getElementById('formLoader');

            if (form && formLoader) {
                form.addEventListener('submit', function(e) {
                    formLoader.classList.remove('hidden');
                    formLoader.classList.add('flex');
                });
            }

            // Time select validation
            const jamMulai = document.getElementById('jam_mulai');
            const jamSelesai = document.getElementById('close_time');

            function updateOptions() {
                if (!jamMulai || !jamSelesai) return;

                const startHour = parseInt(jamMulai.value.split(':')[0]) || 0;
                const endHour = parseInt(jamSelesai.value.split(':')[0]) || 24;

                // Disable jam selesai yang lebih kecil atau sama dengan jam mulai
                for (let i = 8; i <= 21; i++) {
                    const option = jamSelesai.querySelector(`option[value="${String(i).padStart(2,'0')}:00"]`);
                    if (option) option.disabled = i <= startHour;
                }

                // Disable jam mulai yang lebih besar atau sama dengan jam selesai
                for (let i = 8; i <= 21; i++) {
                    const option = jamMulai.querySelector(`option[value="${String(i).padStart(2,'0')}:00"]`);
                    if (option) option.disabled = i >= endHour;
                }
            }

            if (jamMulai && jamSelesai) {
                jamMulai.addEventListener('change', updateOptions);
                jamSelesai.addEventListener('change', updateOptions);
                updateOptions();
            }

            // Smooth scroll for navigation
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        const offset = window.innerWidth < 768 ? 80 : 100;
                        window.scrollTo({
                            top: targetElement.offsetTop - offset,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endsection
