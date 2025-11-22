<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar | EZFutsal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-white flex flex-col items-center min-h-screen">

    <!-- NAVBAR -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-300">
        <div class="flex justify-between items-center px-6 md:px-12 py-4">
            <h1 class="text-xl md:text-3xl font-bold text-[#13810A]">EZFutsal</h1>
        </div>
    </nav>

    <div class="h-20"></div>

    <!-- CARD UTAMA -->
    <div class="relative w-[95%] max-w-[1200px] rounded-2xl overflow-hidden shadow-2xl bg-white">

        <!-- BACKGROUND (desktop) -->
        <div class="hidden md:block absolute inset-0">
            <div class="w-full h-full bg-[url('/aset/register-bg.jpg')] bg-cover bg-center"></div>
            <div class="absolute inset-0 bg-black/25"></div>
        </div>

        <!-- TEKS PROMO (desktop) -->
        <div
            class="hidden md:block absolute top-1/2 left-12 md:left-20 -translate-y-1/2 text-white font-semibold drop-shadow-lg max-w-xs leading-relaxed text-base md:text-[20px] z-10">
            Selamat datang! Silakan buat akun untuk mulai mengakses layanan kami.
        </div>

        <!-- FORM REGISTER -->
        <div
            class="relative z-20 bg-[#13810A]/90 md:backdrop-blur-md p-8 rounded-2xl shadow-2xl w-full md:w-[400px] md:ml-auto md:mr-12 my-8 text-white flex flex-col gap-4">

            <!-- ICON -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>

            <h2 class="text-2xl font-bold mb-4 text-center">Sign Up</h2>

            <form action="{{ route('Register') }}" method="POST" class="flex flex-col gap-4 w-full">
                @csrf

                <div class="flex flex-col">
                    <label for="name" class="mb-1">Nama</label>
                    <input id="name" name="name" type="text" placeholder="Nama lengkap" required
                        class="w-full p-2.5 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="no_telp" class="mb-1">Nomor Telepon</label>
                    <div class="flex items-center rounded-md overflow-hidden bg-white border border-gray-300">
                        <div class="flex items-center gap-1 px-3 py-2 bg-gray-100 border-r border-gray-300 text-black">
                            <img src="https://flagcdn.com/w20/id.png" alt="Indonesia" class="w-5 h-4 rounded-sm">
                            <span class="text-sm font-medium">+62</span>
                        </div>
                        <input id="no_telp" name="no_telp" type="tel" placeholder="81234567890" required
                            class="flex-1 p-2.5 text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="email" class="mb-1">Email</label>
                    <input id="email" name="email" type="email" placeholder="Masukkan email" required
                        class="w-full p-2.5 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="password" class="mb-1">Password</label>
                    <input id="password" name="password" type="password" placeholder="Masukkan password" required
                        class="w-full p-2.5 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="password_confirmation" class="mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Ulangi password" required
                        class="w-full p-2.5 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
                </div>

                <input type="hidden" name="role" value="user">

                <button type="submit"
                    class="w-full bg-white text-[#13810A] font-bold py-2.5 rounded-md hover:bg-gray-100 transition mt-2">
                    Daftar
                </button>

                <p class="text-center text-sm mt-3">
                    Sudah memiliki akun?
                    <a href="{{ route('PageLogin') }}"
                        class="text-red-600 hover:text-red-500 hover:underline transition">
                        Login sekarang
                    </a>
                </p>
            </form>
        </div>

    </div>

    @include('beranda.layouts.script')
</body>

</html>
