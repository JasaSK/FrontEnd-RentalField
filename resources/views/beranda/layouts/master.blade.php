<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

@include('beranda.layouts.head')

<body class="text-black relative overflow-x-hidden font-sans bg-gray-50">
    <!-- Loader -->
    <div id="loader"
        class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-white transition-opacity duration-500 px-4">

        <!-- Field futsal mini -->
        <div
            class="relative 
               w-64 h-40 
               sm:w-72 sm:h-44 
               md:w-80 md:h-48 
               mb-10 sm:mb-12 
               border-4 border-[#13810A] 
               rounded-xl 
               bg-gradient-to-b from-green-100 to-green-50 
               overflow-hidden">

            <!-- Garis tengah -->
            <div
                class="absolute top-1/2 left-0 w-full 
                   h-1 sm:h-[5px] 
                   bg-[#13810A] 
                   -translate-y-1/2">
            </div>

            <!-- Lingkaran tengah -->
            <div
                class="absolute top-1/2 left-1/2 
                   w-12 h-12 
                   sm:w-14 sm:h-14 
                   md:w-16 md:h-16 
                   border-2 border-[#13810A] 
                   rounded-full 
                   -translate-x-1/2 -translate-y-1/2">
            </div>

            <!-- Bola animasi -->
            <div
                class="absolute top-1/2 left-0 
                   w-6 h-6 
                   sm:w-7 sm:h-7 
                   md:w-8 md:h-8 
                   bg-gradient-to-r from-[#13810A] to-[#0f6508] 
                   rounded-full 
                   -translate-y-1/2 
                   animate-[ballMove_2s_linear_infinite]">

                <!-- Pola bola -->
                <div class="absolute inset-1 border-2 border-white rounded-full"></div>

                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-3 h-0.5 bg-white rotate-45"></div>
                    <div class="w-3 h-0.5 bg-white -rotate-45 absolute"></div>
                </div>
            </div>
        </div>

        <!-- Text -->
        <div class="text-center">
            <h1 class="text-2xl sm:text-3xl font-bold text-[#13810A] mb-2 animate-pulse">
                EZFutsal
            </h1>
            <p class="text-sm sm:text-base text-gray-600 max-w-xs sm:max-w-md">
                Menyiapkan lapangan terbaik untuk Anda...
            </p>
        </div>
    </div>

    <!-- Top Bar -->
    <div class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-xl border-b border-gray-200/50 shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 md:px-12 h-16">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-[#13810A] to-[#0f6508] rounded-xl flex items-center justify-center shadow-md">
                    <span class="text-white font-bold text-lg">EZ</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-[#13810A] tracking-tight">
                    Futsal
                </h1>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-3 md:space-x-4">
                @if (session('user'))
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button" id="logoutButton"
                            class="group relative px-5 py-2.5 bg-gradient-to-r from-[#13810A] to-[#0f6508] 
                                   text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-300 
                                   overflow-hidden">
                            <span class="relative z-10 flex items-center gap-2">
                                Logout
                                <i
                                    class="fas fa-sign-out-alt group-hover:translate-x-1 transition-transform duration-300"></i>
                            </span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-[#0f6508] to-[#0d5606] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </button>
                    </form>
                @else
                    <a href="{{ route('PageLogin') }}"
                        class="px-5 py-2.5 border-2 border-[#13810A] text-[#13810A] rounded-xl font-semibold 
                               hover:bg-[#13810A] hover:text-white transition-all duration-300 shadow-sm 
                               hover:shadow-md">
                        Login
                    </a>
                    <a href="{{ route('PageRegister') }}"
                        class="px-5 py-2.5 bg-gradient-to-r from-[#13810A] to-[#0f6508] text-white rounded-xl 
                               font-semibold hover:shadow-lg transition-all duration-300 shadow-md 
                               hover:scale-105">
                        Daftar
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-gray-50 to-white border-t border-gray-200/50 py-14 mt-20">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-10">
                <!-- Brand Section -->
                <div class="text-center md:text-left">
                    <div class="flex items-center gap-3 mb-6 justify-center md:justify-start">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-[#13810A] to-[#0f6508] rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-xl">EZ</span>
                        </div>
                        <h3 class="text-2xl font-bold text-[#13810A]">EZFutsal</h3>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed max-w-md mb-6">
                        Lapangan Futsal kami menyediakan fasilitas terbaik untuk bermain nyaman dan aman. Harga sewa
                        terjangkau,
                        lokasi strategis, cocok untuk teman atau rekan kerja.
                    </p>
                    <a href="{{ route('beranda.index') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-[#13810A] to-[#0f6508] 
                               text-white font-semibold px-6 py-3 rounded-xl text-lg shadow-md 
                               hover:shadow-lg hover:scale-105 transition-all duration-300">
                        Pesan Sekarang
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>

                <!-- Social Media -->
                <div class="text-center md:text-left">
                    <h4 class="text-lg font-semibold text-gray-800 mb-6">Ikuti Kami</h4>
                    <div class="flex justify-center md:justify-start items-center space-x-4">
                        <a href="#"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-br from-[#13810A] to-[#0f6508] 
                                   text-white shadow-lg hover:scale-110 hover:shadow-xl transition-all duration-300">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </a>
                        <a href="#"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-br from-[#13810A] to-[#0f6508] 
                                   text-white shadow-lg hover:scale-110 hover:shadow-xl transition-all duration-300">
                            <i class="fa-brands fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-br from-[#13810A] to-[#0f6508] 
                                   text-white shadow-lg hover:scale-110 hover:shadow-xl transition-all duration-300">
                            <i class="fa-brands fa-tiktok text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-12 pt-8 border-t border-gray-200/50 text-center">
                <p class="text-gray-500 text-sm">
                    © 2024 EZFutsal. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @include('beranda.layouts.script')
</body>

</html>
