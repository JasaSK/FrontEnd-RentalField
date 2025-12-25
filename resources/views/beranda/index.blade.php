@extends('beranda.layouts.master')

@section('content')
    <!-- Enhanced Background with Gradient Overlay -->
    <div class="absolute inset-0 top-[70px] -z-50">
        <div class="relative h-[60vh]">
            <img src="{{ asset('aset/lapangan-bg.jpg') }}"
                class="absolute inset-0 h-full w-full object-cover transform scale-105 animate-[slowZoom_30s_ease-in-out_infinite]">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-transparent"></div>
            <!-- Subtle Pattern Overlay -->
            <div
                class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-transparent via-black/10 to-transparent">
            </div>
        </div>
    </div>

    <!-- Enhanced Navbar SectionNav -->
    <div id="sectionNav"
        class="sticky top-16 z-40 bg-black/80 backdrop-blur-xl border-b border-white/10 shadow-xl transition-all duration-300">
        <div class="max-w-7xl mx-auto flex justify-center gap-6 md:gap-10 text-lg md:text-xl py-4">
            <a href="#banner" class="relative px-2 py-1 text-white/90 hover:text-white transition-all duration-300 group">
                <span class="relative z-10">Banner</span>
                <div
                    class="absolute inset-0 bg-[#13810A] rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 opacity-0 group-hover:opacity-20">
                </div>
                <div
                    class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-[#13810A] -translate-x-1/2 group-hover:w-3/4 transition-all duration-300">
                </div>
            </a>
            <a href="#galeri" class="relative px-2 py-1 text-white/90 hover:text-white transition-all duration-300 group">
                <span class="relative z-10">Galeri</span>
                <div
                    class="absolute inset-0 bg-[#13810A] rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 opacity-0 group-hover:opacity-20">
                </div>
                <div
                    class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-[#13810A] -translate-x-1/2 group-hover:w-3/4 transition-all duration-300">
                </div>
            </a>
            <a href="#kontak" class="relative px-2 py-1 text-white/90 hover:text-white transition-all duration-300 group">
                <span class="relative z-10">Kontak</span>
                <div
                    class="absolute inset-0 bg-[#13810A] rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 opacity-0 group-hover:opacity-20">
                </div>
                <div
                    class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-[#13810A] -translate-x-1/2 group-hover:w-3/4 transition-all duration-300">
                </div>
            </a>
            <a href="#maps" class="relative px-2 py-1 text-white/90 hover:text-white transition-all duration-300 group">
                <span class="relative z-10">Maps</span>
                <div
                    class="absolute inset-0 bg-[#13810A] rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 opacity-0 group-hover:opacity-20">
                </div>
                <div
                    class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-[#13810A] -translate-x-1/2 group-hover:w-3/4 transition-all duration-300">
                </div>
            </a>
            <a href="{{ route('history.index') }}"
                class="relative px-2 py-1 text-white/90 hover:text-white transition-all duration-300 group">
                <span class="relative z-10">Riwayat Pesanan</span>
                <div
                    class="absolute inset-0 bg-[#13810A] rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 opacity-0 group-hover:opacity-20">
                </div>
                <div
                    class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-[#13810A] -translate-x-1/2 group-hover:w-3/4 transition-all duration-300">
                </div>
            </a>
        </div>
    </div>

    <!-- Enhanced Card Search -->
    <section id="home" class="flex justify-center items-start mt-[300px] px-6 relative z-10">
        <div
            class="bg-gradient-to-br from-[#7A0010] to-[#5A000C] p-8 rounded-3xl shadow-2xl w-full max-w-[1500px] border border-white/10">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-white mb-2">Cari Lapangan Futsal</h2>
                <p class="text-white/80 text-sm">Temukan lapangan yang sesuai dengan kebutuhan Anda</p>
            </div>

            <form id="myForm" action="{{ route('beranda.search') }}" method="post"
                class="flex flex-wrap md:flex-nowrap items-center justify-between gap-6">
                @csrf

                <!-- Tanggal & Jam -->
                <div class="flex flex-col gap-5 w-full md:w-[45%]">
                    <div class="group">
                        <label for="tanggal_main" class="text-white font-semibold mb-2 block text-lg text-center">Tanggal
                            Main</label>
                        <div class="relative">
                            <input type="date" id="tanggal_main" name="tanggal_main"
                                value="{{ old('tanggal_main', $request['tanggal_main'] ?? '') }}"
                                class="w-full px-5 py-4 rounded-xl bg-white text-gray-800 text-center outline-none 
                                   focus:ring-3 focus:ring-[#FF4C4C]/50 focus:border-[#FF4C4C] 
                                   transition-all duration-300 cursor-pointer shadow-lg
                                   group-hover:shadow-xl group-hover:-translate-y-0.5" />
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <label for="jam_mulai" class="text-white font-semibold mb-2 block text-lg text-center">Jam
                            Mulai</label>
                        <div class="relative">
                            <select id="jam_mulai" name="open_time"
                                class="w-full px-5 py-4 rounded-xl bg-white text-gray-800 text-center outline-none 
                                   focus:ring-3 focus:ring-[#FF4C4C]/50 focus:border-[#FF4C4C] 
                                   transition-all duration-300 cursor-pointer shadow-lg pr-12
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
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tipe & Jam Selesai -->
                <div class="flex flex-col gap-5 w-full md:w-[45%]">
                    <div class="group">
                        <label for="category_field_id" class="text-white font-semibold mb-2 block text-lg text-center">
                            Tipe Lapangan
                        </label>
                        <div class="relative">
                            <select id="category_field_id" name="category_field_id"
                                class="w-full px-5 py-4 rounded-xl bg-white text-gray-800 text-center outline-none 
                                   focus:ring-3 focus:ring-[#FF4C4C]/50 focus:border-[#FF4C4C] 
                                   transition-all duration-300 cursor-pointer shadow-lg pr-12
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
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <label for="close_time" class="text-white font-semibold mb-2 block text-lg text-center">Jam
                            Selesai</label>
                        <div class="relative">
                            <select id="close_time" name="close_time"
                                class="w-full px-5 py-4 rounded-xl bg-white text-gray-800 text-center outline-none 
                                   focus:ring-3 focus:ring-[#FF4C4C]/50 focus:border-[#FF4C4C] 
                                   transition-all duration-300 cursor-pointer shadow-lg pr-12
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
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-center items-center w-full md:w-[20%] mt-2 md:mt-0">
                    <button type="submit"
                        class="group relative w-full bg-gradient-to-r from-[#13810A] via-[#0f6e09] to-[#0d5c07] 
                           text-white font-bold px-9 py-5 rounded-xl text-xl shadow-xl 
                           hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <i class="fas fa-search"></i>
                            Search
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
                    class="absolute inset-0 bg-white/90 backdrop-blur-sm flex items-center justify-center hidden z-10 rounded-3xl">
                    <div class="text-center">
                        <div
                            class="w-16 h-16 border-4 border-[#13810A] border-t-transparent rounded-full animate-spin mx-auto mb-4">
                        </div>
                        <p class="text-gray-700 font-semibold">Memproses...</p>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <!-- Enhanced Card Lapangan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-[1500px] mx-auto mt-20 w-[97%]">
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
                class="relative rounded-3xl overflow-hidden shadow-xl group hover:shadow-2xl hover:scale-[1.02] 
                       transition-all duration-500 cursor-pointer bg-white border border-gray-200">

                <!-- Image Container -->
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ $field['image'] ?? asset('aset/no-image.png') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                    <!-- Status Badge -->
                    @if ($isSearch)
                        <div class="absolute top-4 right-4">
                            <span
                                class="{{ $statusInfo['bg'] }} text-white px-4 py-2 rounded-full text-sm font-semibold 
                                       shadow-lg flex items-center gap-2">
                                <i class="{{ $statusInfo['icon'] }}"></i>
                                {{ $statusInfo['text'] }}
                            </span>
                        </div>
                    @endif

                    <!-- Title Overlay -->
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-center w-full px-4">
                        <h2 class="text-white text-2xl md:text-3xl font-bold mb-2 drop-shadow-lg">{{ $field['name'] }}
                        </h2>
                        <div class="flex items-center justify-center gap-4 text-white/90">
                            <span class="flex items-center gap-1">
                                <i class="fas fa-clock"></i>
                                {{ $field['open_time'] }} - {{ $field['close_time'] }}
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="fas fa-tag"></i>
                                Rp {{ number_format($field['price_per_hour'] ?? 0, 0, ',', '.') }}/jam
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Content Footer -->
                <div class="p-6 bg-gradient-to-b from-white to-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-gray-600">
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-ruler-combined text-[#13810A]"></i>
                                <span class="font-medium">{{ $field['size'] ?? 'Standar' }}</span>
                            </div>
                            <p class="text-sm text-gray-500 line-clamp-1">
                                {{ $field['description'] ?? 'Lapangan futsal berkualitas' }}</p>
                        </div>
                        <div class="text-[#13810A] font-bold group-hover:translate-x-2 transition-transform duration-300">
                            Pesan <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center py-12 bg-white rounded-3xl shadow-lg border border-gray-200">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-700 mb-2">Lapangan Tidak Ditemukan</h3>
                <p class="text-gray-500 mb-6">Coba dengan kriteria pencarian yang berbeda</p>
                <a href="{{ route('beranda.index') }}"
                    class="inline-flex items-center gap-2 bg-[#13810A] text-white px-6 py-3 rounded-xl font-medium hover:bg-[#0f6e09] transition-colors duration-300">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        @endforelse
    </div>

    {{-- Enhanced Tombol Lihat Semua / Tutup --}}
    @if (!$showAll && $totalFields > 4)
        <div class="flex justify-center mt-12 mb-16">
            <a href="{{ url()->current() . '?' . http_build_query(array_merge($request, ['show' => 'all'])) }}"
                class="group relative px-8 py-4 bg-gradient-to-r from-[#13810A] to-[#0f6e09] 
                      text-white font-bold rounded-xl text-lg shadow-lg
                      hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden">
                <span class="relative z-10 flex items-center gap-3">
                    Lihat Semua Lapangan
                    <i class="fas fa-chevron-down group-hover:translate-y-1 transition-transform duration-300"></i>
                </span>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-[#0f6e09] to-[#0d5c07] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </a>
        </div>
    @endif

    @if ($showAll)
        <div class="flex justify-center mt-12 mb-16">
            <a href="{{ url()->current() }}"
                class="group relative px-8 py-4 bg-gradient-to-r from-red-600 to-[#BF0E26] 
                      text-white font-bold rounded-xl text-lg shadow-lg
                      hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden">
                <span class="relative z-10 flex items-center gap-3">
                    <i class="fas fa-times"></i> Tutup
                </span>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-[#BF0E26] to-red-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </a>
        </div>
    @endif

    <!-- Enhanced Banner Section -->
    @if (!$isSearch)
        <section id="banner" class="py-16 md:py-20 px-6 md:px-12 bg-gradient-to-b from-white to-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800">Promo & Event</h2>
                    <p class="text-gray-600 text-lg">Dapatkan penawaran spesial dari EZFutsal</p>
                </div>

                <div class="relative max-w-6xl mx-auto overflow-hidden rounded-3xl shadow-2xl">
                    <div id="banner-carousel" class="flex transition-transform duration-700 ease-in-out">
                        @foreach ($banners as $banner)
                            <div class="min-w-full relative">
                                <img src="{{ $banner['image'] }}" alt="Banner {{ $loop->iteration }}"
                                    class="w-full h-[400px] md:h-[450px] object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Buttons -->
                    <button id="prevBtn"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm 
                                   rounded-full flex items-center justify-center text-white hover:bg-white/30 
                                   transition-all duration-300 shadow-lg">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="nextBtn"
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm 
                                   rounded-full flex items-center justify-center text-white hover:bg-white/30 
                                   transition-all duration-300 shadow-lg">
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    <!-- Dots -->
                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3">
                        @foreach ($banners as $banner)
                            <button
                                class="banner-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 
                                          {{ $loop->first ? '!bg-white w-8' : '' }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Galeri Section -->
        <section id="galeri" class="py-20 px-6 md:px-12 bg-gradient-to-b from-gray-50 to-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800">Galeri EZFutsal</h2>
                    <p class="text-gray-600 text-lg">Koleksi momen seru di lapangan kami</p>
                </div>

                <!-- Filter Buttons -->
                <div class="flex justify-center gap-4 mb-12 flex-wrap">
                    <button
                        class="filter-btn bg-gradient-to-r from-[#13810A] to-[#0f6e09] 
                                 text-white px-6 py-3 rounded-xl font-bold border-2 border-[#13810A]
                                 shadow-lg hover:shadow-xl transition-all duration-300"
                        data-filter="all">
                        Semua
                    </button>

                    @foreach ($categoriesGalleries as $cat)
                        <button
                            class="filter-btn bg-white text-[#13810A] border-2 border-[#13810A] 
                                 hover:bg-gradient-to-r hover:from-[#13810A] hover:to-[#0f6e09] hover:text-white 
                                 px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-md hover:shadow-lg"
                            data-filter="{{ strtolower($cat['name']) }}">
                            {{ ucfirst($cat['name']) }}
                        </button>
                    @endforeach
                </div>

                <!-- Gallery Grid -->
                <div id="gallery-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                    @foreach ($galleries as $gallery)
                        @php
                            $category = strtolower($gallery['category_gallery']['name'] ?? 'unknown');
                        @endphp
                        <div
                            class="gallery-item {{ $category }} relative group cursor-pointer overflow-hidden rounded-2xl 
                                    shadow-lg hover:shadow-2xl transition-all duration-500">
                            <img src="{{ $gallery['image'] }}" alt="{{ ucfirst($category) }} {{ $loop->iteration }}"
                                class="w-full h-52 md:h-64 object-cover group-hover:scale-110 transition-transform duration-700">

                            <!-- Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent 
                                        opacity-0 group-hover:opacity-100 transition-opacity duration-500 
                                        flex items-end p-4">
                                <div
                                    class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                    <div
                                        class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-full mb-2">
                                        <i class="fas fa-image text-xs"></i>
                                        <span class="text-xs font-medium capitalize">{{ $category }}</span>
                                    </div>
                                    <p class="text-sm font-semibold">Gallery {{ $loop->iteration }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Enhanced Kontak Section -->
        <section id="kontak" class="py-20 px-6 md:px-12 bg-gradient-to-b from-white to-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800">Hubungi Kami</h2>
                    <p class="text-gray-600 text-lg">Tim kami siap membantu kebutuhan Anda</p>
                </div>

                <div class="bg-white rounded-3xl p-8 mx-auto w-[97%] max-w-[1500px] shadow-2xl border border-gray-200">
                    <!-- Location -->
                    <div
                        class="flex items-start space-x-6 pb-8 border-b border-gray-200/50 group hover:bg-gray-50/50 p-4 rounded-2xl transition-all duration-300">
                        <div
                            class="bg-gradient-to-br from-[#7A0010] to-[#5A000C] text-white w-14 h-14 flex items-center 
                                    justify-center rounded-2xl text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="text-left flex-1">
                            <h3 class="font-bold text-xl text-gray-800 mb-2">Location</h3>
                            <p class="text-gray-600">Jl. Perusahaan, Perumahan Tirtasani, Estate Malang</p>
                            <a href="#maps"
                                class="inline-flex items-center gap-2 text-[#13810A] font-semibold mt-2 
                                                 hover:gap-3 transition-all duration-300">
                                Lihat di peta <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div
                        class="flex items-start space-x-6 py-8 border-b border-gray-200/50 group hover:bg-gray-50/50 p-4 rounded-2xl transition-all duration-300">
                        <div
                            class="bg-gradient-to-br from-[#7A0010] to-[#5A000C] text-white w-14 h-14 flex items-center 
                                    justify-center rounded-2xl text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="text-left flex-1">
                            <h3 class="font-bold text-xl text-gray-800 mb-2">Email</h3>
                            <p class="text-gray-600">lapanganfutsal@gmail.com</p>
                            <a href="mailto:lapanganfutsal@gmail.com"
                                class="inline-flex items-center gap-2 text-[#13810A] font-semibold mt-2 
                                      hover:gap-3 transition-all duration-300">
                                Kirim email <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Call -->
                    <div
                        class="flex items-start space-x-6 pt-8 group hover:bg-gray-50/50 p-4 rounded-2xl transition-all duration-300">
                        <div
                            class="bg-gradient-to-br from-[#7A0010] to-[#5A000C] text-white w-14 h-14 flex items-center 
                                    justify-center rounded-2xl text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="text-left flex-1">
                            <h3 class="font-bold text-xl text-gray-800 mb-2">Telepon</h3>
                            <p class="text-gray-600">+62 000-0000-0000</p>
                            <a href="tel:+620000000000"
                                class="inline-flex items-center gap-2 text-[#13810A] font-semibold mt-2 
                                      hover:gap-3 transition-all duration-300">
                                Hubungi kami <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Maps Section -->
        <section id="maps" class="py-20 px-6 md:px-12 bg-gradient-to-b from-gray-50 to-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800">Lokasi Kami</h2>
                    <p class="text-gray-600 text-lg">Temukan kami dengan mudah di Google Maps</p>
                </div>

                <div class="max-w-[1500px] mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.8660680895628!2d112.63119177302289!3d-7.909057078710882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd62b9fde296155%3A0x9f2b9e49f08bd861!2sTirtasani%20Estate%20F%2F3!5e0!3m2!1sid!2sid!4v1760976402420!5m2!1sid!2sid"
                        class="w-full h-[400px] md:h-[500px] border-0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <!-- Map Info Overlay -->
                    <div
                        class="absolute bottom-6 left-6 bg-white/95 backdrop-blur-sm rounded-2xl p-5 max-w-xs shadow-xl border border-gray-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-[#13810A] to-[#0f6e09] rounded-xl flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">EZFutsal Malang</h4>
                                <p class="text-sm text-gray-600">Buka 08:00 - 22:00</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-sm">Jl. Perusahaan, Perumahan Tirtasani, Estate Malang</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <style>
        
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
                        dot.classList.toggle('w-8', index === currentSlide);
                        dot.classList.toggle('w-3', index !== currentSlide);
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
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endsection
