<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

@extends('beranda.layouts.head')
<!--topbar-->
<body class="text-black relative overflow-x-hidden">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-300">
        <div class="flex justify-between items-center px-6 md:px-12 py-4">
            <h1 class="text-xl md:text-3xl font-bold text-[#13810A]">
                EZFutsal
            </h1>
            <div class="flex space-x-4">
                <a href="{{ url('beranda/login') }}"
                    class="bg-[#13810A] text-white font-semibold text-lg px-4 py-1 rounded-lg hover:bg-[#0f6508] transition">
                    Login
                </a>
                <a href="{{ url('beranda/daftar') }}"
                    class="bg-[#13810A] text-white font-semibold text-lg px-4 py-1 rounded-lg hover:bg-[#0f6508] transition">
                    Daftar
                </a>
            </div>
        </div>
    </nav>
    @yield('content')
    <!--footer-->
    <footer class="w-screen bg-white py-14 border-t shadow-[0_-4px_10px_rgba(0,0,0,0.1)] relative left-1/2 -translate-x-1/2">
        <div class="max-w-6xl mx-auto px-6 md:px-12">
            <div class="flex justify-center items-center space-x-6 mb-10">
                <a href="https://www.instagram.com/" class="bg-[#13810A] hover:bg-[#0f6508] transition text-black w-12 h-12 rounded-full flex items-center justify-center">
                    <i class="fa-brands fa-instagram text-2xl"></i>
                </a>
                <a href="https://www.facebook.com/" class="bg-[#13810A] hover:bg-[#0f6508] transition text-black w-12 h-12 rounded-full flex items-center justify-center">
                    <i class="fa-brands fa-facebook-f text-2xl"></i>
                </a>
                <a href="https://www.tiktok.com/" class="bg-[#13810A] hover:bg-[#0f6508] transition text-black w-12 h-12 rounded-full flex items-center justify-center">
                    <i class="fa-brands fa-tiktok text-2xl"></i>
                </a>
            </div>
            <div class="w-full text-left">
                <h3 class="text-2xl font-bold mb-3 text-black">About Lapangan</h3>
                <p class="text-gray-700 text-sm md:text-base leading-relaxed mb-8">
                    Lapangan Futsal kami menyediakan fasilitas terbaik untuk Anda yang ingin bermain dengan nyaman dan aman.
                    Kami berlokasi strategis dan menawarkan layanan sewa lapangan dengan harga terjangkau.
                    Nikmati pengalaman bermain futsal bersama teman atau rekan kerja hanya di tempat kami.
                </p>
                <a href="#" class="home inline-block bg-[#13810A] hover:bg-[#0f6508] transition text-white font-semibold px-6 py-3 rounded-md text-lg">
                    Pesin Sekarang >>
                </a>
            </div>
        </div>
    </footer>
    <!-- Script -->
    @stack('scripts')
</body>

</html>