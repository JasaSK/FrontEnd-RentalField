@extends('beranda.layouts.master')

@section('content')
    <!-- Background -->

    <div class="absolute inset-0 top-[70px] -z-50">
        <div class="relative h-[60vh]">
            <img src="{{ asset('aset/lapangan-bg.jpg') }}" class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
    </div>

    <!-- Navbar SectionNav -->
    <div id="sectionNav"
        class="sticky top-16 z-40 bg-black/70 text-white backdrop-blur-sm border-b border-black/20 transition-transform duration-300">
        <div class="max-w-7xl mx-auto flex justify-center gap-6 md:gap-10 text-lg md:text-xl py-4">
            <a href="#banner" class="hover:text-[#13810A] transition-all duration-200">Banner</a>
            <a href="#galeri" class="hover:text-[#13810A] transition-all duration-200">Galeri</a>
            <a href="#kontak" class="hover:text-[#13810A] transition-all duration-200">Kontak</a>
            <a href="#maps" class="hover:text-[#13810A] transition-all duration-200">Maps</a>
            <a href="{{ route('history.index') }}" class="hover:text-[#13810A] transition-all duration-200">Riwayat
                Pesanan</a>
        </div>
    </div>


    <!-- Card Search -->
    <section id="home" class="flex justify-center items-start mt-[300px] px-6 relative z-10">
        <div class="bg-gradient-to-r from-[#7A0010] to-[#B3001B] p-6 rounded-3xl shadow-2xl w-full max-w-[1500px]">
            <form action="{{ route('beranda.search') }}" method="post"
                class="flex flex-wrap md:flex-nowrap items-center justify-between gap-4">
                @csrf
                <!-- Tanggal & Jam -->
                <div class="flex flex-col gap-4 w-full md:w-[45%]">
                    <div>
                        <label for="tanggal_main" class="text-white font-semibold mb-1 block text-lg text-center">Tanggal
                            Main</label>
                        <input type="date" id="tanggal_main" name="tanggal_main"
                            class="w-full px-5 py-4 rounded-xl text-gray-800 text-center outline-none focus:ring-2 focus:ring-[#FF4C4C] cursor-pointer" />
                    </div>
                    <div>
                        <label for="jam_mulai" class="text-white font-semibold mb-1 block text-lg text-center">Jam
                            Mulai</label>
                        <select id="jam_mulai" name="open_time"
                            class="w-full px-5 py-4 rounded-xl text-gray-800 text-center outline-none focus:ring-2 focus:ring-[#FF4C4C] cursor-pointer">
                            <option value="">Pilih Jam</option>
                            @for ($i = 8; $i <= 21; $i++)
                                <option>{{ sprintf('%02d.00', $i) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <!-- Tipe & Jam Selesai -->
                <div class="flex flex-col gap-4 w-full md:w-[45%]">
                    <div>
                        <label for="category_field_id" class="text-white font-semibold mb-1 block text-lg text-center">Tipe
                            Lapangan</label>
                        <select id="category_field_id" name="category_field_id"
                            class="w-full px-5 py-4 rounded-xl text-gray-800 text-center outline-none focus:ring-2 focus:ring-[#FF4C4C] cursor-pointer">
                            <option value="">Pilih Tipe Lapangan</option>
                            @foreach ($categoriesFields as $cat)
                                <option value="{{ $cat['id'] }}"
                                    {{ request('category_field_id') == $cat['id'] ? 'selected' : '' }}>
                                    {{ $cat['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="close_time" class="text-white font-semibold mb-1 block text-lg text-center">Jam
                            Selesai</label>
                        <select id="close_time" name="close_time"
                            class="w-full px-5 py-4 rounded-xl text-gray-800 text-center outline-none focus:ring-2 focus:ring-[#FF4C4C] cursor-pointer">
                            <option value="">Pilih Jam</option>
                            @for ($i = 8; $i <= 21; $i++)
                                <option>{{ sprintf('%02d.00', $i) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <!-- Submit -->
                <div class="flex justify-center items-center w-full md:w-[20%] mt-6 md:mt-0">
                    <button type="submit"
                        class="bg-[#13810A] hover:bg-[#0f6e09] text-white font-semibold px-9 py-4 rounded-xl text-xl shadow-md w-full transition-all duration-200">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Card Lapangan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-[1500px] mx-auto mt-16 w-[97%]">
        @forelse ($fields as $field)
            @if (!$showAll && !$isSearch && $loop->iteration > 4)
                @break
            @endif

            @php
                $status = $field['status'] ?? 'available';
            @endphp

            <div onclick="window.location='{{ route('beranda.booking.show', $field['id']) }}'"
                class="relative rounded-3xl overflow-hidden shadow-lg group hover:shadow-2xl hover:scale-105 transition-transform duration-300 cursor-pointer">

                <img src="{{ $field['image'] ?? asset('aset/no-image.png') }}" class="w-full h-56 object-cover">

                <div
                    class="absolute inset-0 bg-black/30 flex flex-col items-center justify-center group-hover:bg-black/50 transition-all duration-300">

                    <h2 class="text-white text-2xl font-semibold mb-2">{{ $field['name'] }}</h2>

                    {{-- STATUS hanya muncul ketika user menekan Search --}}
                    @if ($isSearch)
                        @if ($status === 'booked')
                            <span class="text-white text-lg font-bold bg-[#8B0C17] px-4 py-1 rounded-xl">Tidak Tersedia</span>
                        @elseif ($status === 'maintenance')
                            <span class="text-white text-lg font-bold bg-[#D37B00] px-4 py-1 rounded-xl">Maintenance</span>
                        @else
                            <span class="text-white text-lg font-bold bg-[#13810A] px-4 py-1 rounded-xl">Tersedia</span>
                        @endif
                    @endif
                </div>
            </div>

        @empty
            <p class="text-center text-lg text-red-500 mt-4">Lapangan tidak ditemukan</p>
        @endforelse
    </div>

    {{-- Tombol Lihat Semua / Tutup --}}
    @if (!$showAll && !$isSearch)
        <div class="flex justify-center mt-6 mb-10">
            <a href="?show=all"
                class="px-6 py-3 bg-[#13810A] text-white rounded-xl hover:bg-[#0f6e09] transition text-lg shadow-md">
                Lihat Semua
            </a>
        </div>
    @endif

    @if ($showAll || $isSearch)
        <div class="flex justify-center mt-6 mb-10">
            <a href="{{ route('beranda.index') }}"
                class="px-6 py-3 bg-[#8B0C17] text-white rounded-xl hover:bg-[#7a0a15] transition text-lg shadow-md">
                Tutup
            </a>
        </div>
    @endif

    <!-- Banner Section -->
    @if (!$showAll && !$isSearch)
        <section id="banner" class="py-24 md:py-32 px-6 md:px-12 bg-white text-center">
            <h2 class="text-3xl md:text-5xl font-bold mb-10 text-[#000000]">Banner</h2>
            <div class="relative max-w-6xl mx-auto overflow-hidden rounded-2xl shadow-xl w-[80%] max-w-[900px]">
                <div id="banner-carousel" class="flex transition-transform duration-700 ease-in-out">
                    @foreach ($banners as $banner)
                        <img src="{{ $banner['image'] }}" alt="Banner {{ $loop->iteration }}"
                            class="min-w-full h-[400px] object-cover rounded-2xl">
                    @endforeach
                </div>
            </div>

            <div class="flex justify-center mt-6 space-x-3">
                @foreach ($banners as $banner)
                    <span class="w-5 h-5 bg-gray-400 rounded-full opacity-60 transition-all"
                        id="dot-{{ $loop->index }}"></span>
                @endforeach
            </div>
        </section>

        <!-- Galeri Section -->
        <section id="galeri" class="py-15 md:py-15 px-6 md:px-12 bg-white text-center">
            <h2 class="text-3xl md:5xl font-bold mb-10 text-[#000000]">Galeri</h2>

            <div class="flex justify-center gap-4 mb-10 flex-wrap">
                <button
                    class="filter-btn bg-[#13810A] text-white px-5 py-2 rounded-xl font-semibold border border-[#13810A]"
                    data-filter="all">
                    All
                </button>

                @foreach ($categoriesGalleries as $cat)
                    <button
                        class="filter-btn bg-transparent text-[#13810A] border border-[#13810A] hover:bg-[#13810A] hover:text-white px-5 py-2 rounded-xl font-semibold transition"
                        data-filter="{{ strtolower($cat['name']) }}">
                        {{ ucfirst($cat['name']) }}
                    </button>
                @endforeach
            </div>

            <div id="gallery-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach ($galleries as $gallery)
                    @php
                        $category = strtolower($gallery['category_gallery']['name'] ?? 'unknown');
                    @endphp
                    <div
                        class="gallery-item {{ $category }} transition duration-300 ease-in-out transform hover:scale-105 hover:brightness-110 cursor-pointer">
                        <img src="{{ $gallery['image'] }}" alt="{{ ucfirst($category) }} {{ $loop->iteration }}"
                            class="rounded-2xl object-cover w-full h-52 md:h-64 shadow-md">
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Kontak Section -->
        <section id="kontak" class="py-20 px-6 md:px-12 bg-gray-50 text-center">
            <h2 class="text-3xl md:text-5xl font-bold mb-10 text-[#000000]">Contact Us</h2>
            <div class="bg-white rounded-2xl p-8 mx-auto w-[97%] max-w-[1500px] shadow-xl">

                <!-- Location -->
                <div class="flex items-start space-x-4 pb-6 border-b border-gray-200">
                    <div class="bg-[#7A0010] text-white w-12 h-12 flex items-center justify-center rounded-full text-xl">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="text-left">
                        <h3 class="font-semibold text-lg">Location</h3>
                        <p class="text-gray-600 text-sm">Jl. Perusahaan, Perumahan Tirtasani, Estate Malang</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start space-x-4 py-6 border-b border-gray-200">
                    <div class="bg-[#7A0010] text-white w-12 h-12 flex items-center justify-center rounded-full text-xl">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="text-left">
                        <h3 class="font-semibold text-lg">Email</h3>
                        <p class="text-gray-600 text-sm">lapanganfutsal@gmail.com</p>
                    </div>
                </div>

                <!-- Call -->
                <div class="flex items-start space-x-4 pt-6">
                    <div class="bg-[#7A0010] text-white w-12 h-12 flex items-center justify-center rounded-full text-xl">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="text-left">
                        <h3 class="font-semibold text-lg">Call</h3>
                        <p class="text-gray-600 text-sm">+62 000-0000-0000</p>
                    </div>
                </div>

            </div>
        </section>

        <!-- Maps Section -->
        <section id="maps" class="py-20 px-6 md:px-12 bg-gray-50">
            <h2 class="text-3xl md:text-5xl font-bold mb-10 text-center text-[#000000]">Maps</h2>
            <div class="max-w-[1500px] mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.8660680895628!2d112.63119177302289!3d-7.909057078710882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd62b9fde296155%3A0x9f2b9e49f08bd861!2sTirtasani%20Estate%20F%2F3!5e0!3m2!1sid!2sid!4v1760976402420!5m2!1sid!2sid"
                    class="w-full h-[400px] md:h-[600px] border-0 rounded-2xl" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
    @endif

@endsection
