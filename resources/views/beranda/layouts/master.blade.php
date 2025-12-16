<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

@include('beranda.layouts.head')
<!-- Loader -->



<body class="text-black relative overflow-x-hidden font-sans bg-gray-50">
    <!-- Top Bar -->
    <div class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200 shadow-sm h-16">
        {{-- @if (session('token'))
            <p class="text-sm text-gray-600">
                Token: {{ session('token') }}
            </p>
        @endif --}}
        {{-- @php
            dd(Auth::check(), Auth::user(), session()->all());
        @endphp --}}

        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 md:px-12 h-full">
            <h1 class="text-2xl md:text-3xl font-bold text-[#13810A] tracking-tight">
                EZFutsal
            </h1>
            <div class="flex items-center space-x-3 md:space-x-4">
                @if (session('user'))

                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button" id="logoutButton"
                            class="px-5 py-2 bg-gradient-to-r from-[#13810A] to-[#0f6508] text-white rounded-lg font-semibold hover:opacity-90 transition duration-200 shadow-sm">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('PageLogin') }}"
                        class="px-5 py-2 border border-[#13810A] text-[#13810A] rounded-lg font-semibold hover:bg-[#13810A] hover:text-white transition duration-200 shadow-sm">
                        Login
                    </a>
                    <a href="{{ route('PageRegister') }}"
                        class="px-5 py-2 bg-[#13810A] text-white rounded-lg font-semibold hover:bg-[#0f6508] transition duration-200 shadow-sm">
                        Daftar
                    </a>
                @endauth
        </div>

    </div>
</div>


<!-- Main Content -->
<main class="pt-16">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-50 border-t shadow-inner py-14 mt-10">
    <div class="max-w-6xl mx-auto px-6 md:px-12 text-center md:text-left">
        <div class="flex justify-center md:justify-start items-center space-x-6 mb-10">
            <a href="#"
                class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-tr from-[#13810A] to-[#0f6508] text-white shadow-md hover:scale-110 transition-transform">
                <i class="fa-brands fa-instagram text-xl md:text-2xl"></i>
            </a>
            <a href="#"
                class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-tr from-[#13810A] to-[#0f6508] text-white shadow-md hover:scale-110 transition-transform">
                <i class="fa-brands fa-facebook-f text-xl md:text-2xl"></i>
            </a>
            <a href="#"
                class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-tr from-[#13810A] to-[#0f6508] text-white shadow-md hover:scale-110 transition-transform">
                <i class="fa-brands fa-tiktok text-xl md:text-2xl"></i>
            </a>
        </div>
        <h3 class="text-2xl font-bold mb-4 text-[#13810A]">About Lapangan</h3>
        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-6">
            Lapangan Futsal kami menyediakan fasilitas terbaik untuk bermain nyaman dan aman. Harga sewa terjangkau,
            lokasi strategis, cocok untuk teman atau rekan kerja.
        </p>
        <a href="{{ route('beranda.index') }}"
            class="inline-block bg-[#13810A] hover:bg-green-800 text-white font-semibold px-6 py-3 rounded-xl text-lg shadow-md transition-all duration-200">
            Pesan Sekarang &raquo;
        </a>
    </div>
</footer>


<!-- Scripts -->
@include('beranda.layouts.script')
</body>

</html>
