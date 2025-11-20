@extends('beranda.layouts.master')

@section('content')
    <!--background-->
    <div class="absolute inset-0 top-[70px] -z-50">
        <div class="relative h-[60vh]">
            <img src="{{ asset('aset/lapangan-bg.jpg') }}" class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
    </div>

    <!--navbar-->
    <div id="sectionNav"
        class="sticky top-[65px] z-40 bg-black/70 text-white backdrop-blur-sm border-b border-black/20 
        transition-transform duration-300">
        <div class="max-w-7xl mx-auto flex justify-center gap-8 md:gap-10 text-lg md:text-xl py-4">
            <a href="#banner" class="hover:text-[#13810A] transition">Banner</a>
            <a href="#galeri" class="hover:text-[#13810A] transition">Galeri</a>
            <a href="#kontak" class="hover:text-[#13810A] transition">Kontak</a>
            <a href="#maps" class="hover:text-[#13810A] transition">Maps</a>
            <a href="{{ route('beranda.riwayat') }}" class="hover:text-[#13810A] transition">Riwayat Pesanan</a>
        </div>
    </div>

    <!-- card search -->
    <section id="home" class="flex justify-center items-start mt-[300px] px-6 relative z-10">
        <div class="bg-[#7A0010] p-6 rounded-xl shadow-xl w-full max-w-[1500px]">
            <form action="" method="GET" class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">

                <div class="flex flex-col gap-4 w-full md:w-[45%]">
                    <div>
                        <label for="tanggal_main" class="text-white font-semibold mb-1 text-center text-lg block">Tanggal Main</label>
                        <input type="date" id="tanggal_main" name="tanggal_main"
                            class="w-full px-5 py-4 rounded-lg text-gray-700 text-center outline-none text-lg focus:ring-4 focus:ring-[#B3001B] cursor-pointer"
                            required />
                    </div>
                    <div>
                        <label for="jam_mulai" class="text-white font-semibold mb-1 text-center text-lg block">Jam Mulai</label>
                        <select id="jam_mulai" name="jam_mulai"
                            class="w-full px-5 py-4 rounded-lg text-gray-700 text-center outline-none text-lg focus:ring-4 focus:ring-[#B3001B] cursor-pointer"
                            required>
                            <option value="">Pilih Jam</option>
                            @for ($i = 8; $i <= 21; $i++)
                                <option>{{ sprintf('%02d.00', $i) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-4 w-full md:w-[45%]">
                    <div>
                        <label for="tipe_lapangan" class="text-white font-semibold mb-1 text-center text-lg block">Tipe Lapangan</label>
                        <select id="tipe_lapangan" name="tipe_lapangan"
                            class="w-full px-5 py-4 rounded-lg text-gray-700 text-center outline-none text-lg focus:ring-4 focus:ring-[#B3001B] cursor-pointer"
                            required>
                            <option value="">Pilih Tipe</option>
                            <option>Indoor</option>
                            <option>Outdoor</option>
                        </select>
                    </div>
                    <div>
                        <label for="jam_selesai" class="text-white font-semibold mb-1 text-center text-lg block">Jam Selesai</label>
                        <select id="jam_selesai" name="jam_selesai"
                            class="w-full px-5 py-4 rounded-lg text-gray-700 text-center outline-none text-lg focus:ring-4 focus:ring-[#B3001B] cursor-pointer"
                            required>
                            <option value="">Pilih Jam</option>
                            @for ($i = 8; $i <= 21; $i++)
                                <option>{{ sprintf('%02d.00', $i) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="flex justify-center items-center w-full md:w-[20%] mt-6 md:mt-0">
                    <button type="submit"
                        class="bg-[#13810A] hover:bg-green-800 text-white font-semibold px-9 py-4 rounded-lg text-xl shadow-md transition inline-block text-center w-full">
                        Search
                    </button>
                </div>

            </form>
        </div>
    </section>

    <!-- card lapangan -->
    @php
        $lapangans = [
            (object) ['nama' => 'Lapangan 1', 'foto' => 'aset/img-lapangan/lapangan-1.jpg'],
            (object) ['nama' => 'Lapangan 2', 'foto' => 'aset/img-lapangan/lapangan-2.jpg'],
            (object) ['nama' => 'Lapangan 3', 'foto' => 'aset/img-lapangan/lapangan-2.jpg'],
            (object) ['nama' => 'Lapangan 4', 'foto' => 'aset/img-lapangan/lapangan-1.jpg'],
            (object) ['nama' => 'Lapangan 5', 'foto' => 'aset/img-lapangan/lapangan-1.jpg'],
            (object) ['nama' => 'Lapangan 6', 'foto' => 'aset/img-lapangan/lapangan-2.jpg'],
            (object) ['nama' => 'Lapangan 7', 'foto' => 'aset/img-lapangan/lapangan-2.jpg'],
            (object) ['nama' => 'Lapangan 8', 'foto' => 'aset/img-lapangan/lapangan-1.jpg'],
        ];

        $isSearch =
            request()->has('tanggal_main') &&
            request()->has('jam_mulai') &&
            request()->has('jam_selesai') &&
            request()->has('tipe_lapangan');

        $showAll = request()->get('show') === 'all';

        if ($isSearch) {
            $showAll = false;
        }

        $available = [0, 1, 2, 3];
        $notAvailable = [4, 5, 6, 7];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-[1500px] mx-auto mt-16 w-[97%]">

        @foreach ($lapangans as $index => $lapangan)
            @if (!$isSearch && !$showAll && $index >= 4)
                @break
            @endif

            @if ($isSearch)
                @php
                    $status = in_array($index, $available) ? 'available' : 'not-available';
                @endphp

                <div class="relative rounded-2xl overflow-hidden shadow-lg transition transform group hover:scale-105 hover:shadow-2xl cursor-pointer">
                    <img src="{{ asset($lapangan->foto) }}" class="w-full h-56 object-cover">

                    @if ($status === 'not-available')
                        <div class="absolute inset-0 bg-red-700/60 flex items-center justify-center group-hover:bg-red-700/40 transition">
                            <span class="text-white text-2xl font-bold">Tidak Tersedia</span>
                        </div>
                    @else
                        <div class="absolute inset-0 bg-green-700/60 flex items-center justify-center group-hover:bg-green-700/40 transition">
                            <span class="text-white text-2xl font-bold">Tersedia</span>
                        </div>
                    @endif
                </div>
            @else
                <div class="relative rounded-2xl overflow-hidden shadow-lg group cursor-pointer hover:shadow-2xl hover:scale-105 transition">
                    <img src="{{ asset($lapangan->foto) }}" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center group-hover:bg-black/60 transition">
                        <h2 class="text-white text-2xl font-semibold tracking-wide">{{ $lapangan->nama }}</h2>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- Padding bawah tetap wajar --}}
    <div class="pb-16"></div>

    {{-- Tombol lihat semua --}}
    @if (!$isSearch && !$showAll)
        <div class="flex justify-center mt-4">
            <a href="?show=all" class="px-6 py-3 bg-[#13810A] text-white rounded-xl hover:bg-green-800 transition text-lg">
                Lihat Semua
            </a>
        </div>
    @endif

    {{-- Tombol tutup --}}
    @if ($showAll)
        <div class="flex justify-center mt-6 mb-10">
            <a href="?" class="px-6 py-3 bg-[#7A0010] text-white rounded-xl hover:bg-[#8f0014] transition text-lg">
                Tutup
            </a>
        </div>
    @endif

    <!-- SEMUA SECTION LAIN HILANG SAAT SHOW ALL / SEARCH -->
    @if (!$showAll && !$isSearch)

        <!-- banner -->
        <section id="banner" class="py-24 md:py-32 px-6 md:px-12 bg-white text-center">
            <h2 class="text-3xl md:text-5xl font-bold mb-10 text-[#000000]">Banner</h2>

            @php
                $banners = [
                    (object) ['gambar' => 'aset/img-banner/banner.jpg'],
                    (object) ['gambar' => 'aset/img-banner/banner.jpg'],
                    (object) ['gambar' => 'aset/img-banner/banner.jpg'],
                ];
            @endphp

            <div class="relative max-w-6xl mx-auto overflow-hidden rounded-2xl shadow-xl w-[80%] max-w-[900px]">
                <div id="banner-carousel" class="flex transition-transform duration-700 ease-in-out">
                    @foreach ($banners as $banner)
                        <img src="{{ asset($banner->gambar) }}" alt="Banner {{ $loop->iteration }}"
                            class="min-w-full h-[400px] object-cover rounded-2xl">
                    @endforeach
                </div>
            </div>

            <div class="flex justify-center mt-6 space-x-3">
                <span class="w-5 h-5 bg-black rounded-full opacity-100 transition-all" id="dot-0"></span>
                <span class="w-5 h-5 bg-gray-400 rounded-full opacity-60 transition-all" id="dot-1"></span>
                <span class="w-5 h-5 bg-gray-400 rounded-full opacity-60 transition-all" id="dot-2"></span>
            </div>
        </section>

        <!-- galeri -->
        <section id="galeri" class="py-15 md:py-15 px-6 md:px-12 bg-white text-center">
            <h2 class="text-3xl md:5xl font-bold mb-10 text-[#000000]">Galeri</h2>

            @php
                $galeris = [
                    (object) ['kategori' => 'lapangan', 'gambar' => 'aset/img-lapangan/lapangan-1.jpg'],
                    (object) ['kategori' => 'lapangan', 'gambar' => 'aset/img-lapangan/lapangan-2.jpg'],
                    (object) ['kategori' => 'fasilitas', 'gambar' => 'aset/img-fasilitas/fasilitas-1.jpg'],
                    (object) ['kategori' => 'fasilitas', 'gambar' => 'aset/img-fasilitas/fasilitas-2.jpg'],
                ];
            @endphp

            <div class="flex justify-center gap-4 mb-10 flex-wrap">
                <button class="filter-btn bg-[#13810A] text-white px-5 py-2 rounded-md font-semibold border border-[#13810A]" data-filter="all">All</button>
                <button class="filter-btn bg-transparent text-[#13810A] border border-[#13810A] hover:bg-[#13810A] hover:text-white px-5 py-2 rounded-md font-semibold" data-filter="lapangan">Lapangan</button>
                <button class="filter-btn bg-transparent text-[#13810A] border border-[#13810A] hover:bg-[#13810A] hover:text-white px-5 py-2 rounded-md font-semibold" data-filter="fasilitas">Fasilitas</button>
            </div>

            <div id="gallery-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach ($galeris as $galeri)
                    <div class="gallery-item {{ $galeri->kategori }} transition duration-300 ease-in-out transform hover:scale-105 cursor-pointer">
                        <img src="{{ asset($galeri->gambar) }}" alt="{{ ucfirst($galeri->kategori) }} {{ $loop->iteration }}"
                            class="rounded-lg object-cover w-full h-52 md:h-64 shadow-md">
                    </div>
                @endforeach
            </div>
        </section>

        <!-- kontak -->
        <section id="kontak" class="py-20 px-6 md:px-12 bg-white-50 text-center">
            <h2 class="text-3xl md:text-5xl font-bold mb-10 text-[#000000]">Contact Us</h2>
            <div class="bg-white rounded-xl p-8 mx-auto w-[97%] max-w-[1500px] shadow-[0_0_25px_rgba(0,0,0,0.15)]">
                <div class="flex items-start space-x-4 pb-6 border-b border-gray-200">
                    <div class="bg-[#7A0010] text-white p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zM12 22s8-4.5 8-11a8 8 0 10-16 0c0 6.5 8 11 8 11z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h3 class="font-semibold text-lg">Location</h3>
                        <p class="text-gray-600 text-sm">jl perusahaan, perumahan tirtasani, estate malang</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 py-6 border-b border-gray-200">
                    <div class="bg-[#7A0010] text-white p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l9 6 9-6M4 6h16a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h3 class="font-semibold text-lg">Email</h3>
                        <p class="text-gray-600 text-sm">lapanganfutsal@gmail.com</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 pt-6">
                    <div class="bg-[#7A0010] text-white p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3l2 5-2.5 1.5a11 11 0 005 5L15 15l5 2v3a2 2 0 01-2 2h-1C9.82 22 3 15.18 3 7V5z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h3 class="font-semibold text-lg">Call</h3>
                        <p class="text-gray-600 text-sm">+62 000-0000-0000</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- maps -->
        <section id="maps" class="py-20 px-6 md:px-12 bg-white-50">
            <h2 class="text-3xl md:text-5xl font-bold mb-10 text-center text-[#000000]">Maps</h2>
            <div class="max-w-[1500px] mx-auto bg-white rounded-xl shadow-[0_0_25px_rgba(0,0,0,0.15)] overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.8660680895628!2d112.63119177302289!3d-7.909057078710882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd62b9fde296155%3A0x9f2b9e49f08bd861!2sTirtasani%20Estate%20F%2F3!5e0!3m2!1sid!2sid!4v1760976402420!5m2!1sid!2sid"
                    class="w-full h-[400px] md:h-[600px] border-0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </section>
    @endif

@endsection

@push('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
    @include('Auth.notification.script')
@endpush
