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
<!-- Layout Utama -->
<body class="bg-white flex flex-col items-center min-h-screen">
  <!--topbar-->
  <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-300">
    <div class="flex justify-between items-center px-6 md:px-12 py-4">
      <h1 class="text-xl md:text-3xl font-bold text-[#13810A]">
        EZFutsal
      </h1>
    </div>
  </nav>
  <!-- Spacer navbar -->
  <div class="h-20"></div>
  <!-- CARD UTAMA -->
  <div class="relative w-[95%] max-w-[980px] h-auto md:h-[580px] rounded-2xl overflow-hidden shadow-2xl bg-white">

    <!-- BACKGROUND (hanya muncul di tablet & desktop) -->
    <div class="hidden md:block absolute inset-0">
      <div class="w-full h-full bg-[url('/aset/register-bg.jpg')] bg-cover bg-center"></div>
      <div class="absolute inset-0 bg-black/25"></div>
    </div>

    <!-- TEKS (hanya di tablet & desktop) -->
    <div class="hidden md:block absolute top-1/2 left-[60px] md:left-[90px] -translate-y-[40%] text-white text-base md:text-[20px] font-semibold drop-shadow-lg leading-relaxed max-w-xs">
      Selamat datang! Silakan buat<br>
      akun untuk mulai mengakses
      <span class="pl-10 md:pl-16">layanan kami.</span>
    </div>

    <!-- CARD REGISTER -->
    <div class="relative md:absolute md:top-5 md:right-5 md:bottom-5 bg-[#13810A]/80 md:backdrop-blur-md p-8 rounded-2xl shadow-2xl w-full md:w-[360px] text-white flex flex-col justify-center items-center transition-all duration-300">
      <div class="flex flex-col items-center w-full">
        <!-- ICON -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mt-2 md:mt-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <h2 class="text-2xl font-bold mb-5 tracking-wide">Sign up</h2>

        <!-- FORM REGISTER -->
        <form class="w-full flex flex-col gap-4 text-sm font-medium">
          <!-- Nama -->
          <div>
            <label class="block mb-1">Nama</label>
            <input
              type="text"
              placeholder="Nama lengkap"
              class="w-full p-2.5 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
          </div>

          <!-- Nomor Telepon -->
          <div>
            <label class="block mb-1">Nomor telepon</label>
            <div class="flex items-center rounded-md overflow-hidden bg-white">
              <div class="flex items-center gap-1 px-3 py-2 bg-gray-100 border-r border-gray-300 text-black">
                <img
                  src="https://flagcdn.com/w20/id.png"
                  alt="Indonesia"
                  class="w-5 h-4 rounded-sm">
                <span class="text-sm font-medium">+62</span>
              </div>
              <input
                type="tel"
                placeholder="000-0000-0000"
                class="flex-1 p-2.5 text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
            </div>
          </div>

          <!-- Email -->
          <div>
            <label class="block mb-1">Email</label>
            <input
              type="email"
              placeholder="Masukkan Email"
              class="w-full p-2.5 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
          </div>

          <!-- Password -->
          <div>
            <label class="block mb-1">Password</label>
            <input
              type="password"
              placeholder="Masukkan password"
              class="w-full p-2.5 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
          </div>

          <!-- Sudah punya akun -->
          <p class="text-center text-sm mt-2">
            Sudah memiliki akun?
            <a href="{{ route('PageLogin') }}"
              class="text-red-600 hover:text-red-500 hover:underline transition">
              Login sekarang
            </a>
          </p>

          <!-- Tombol Daftar -->
          <div class="flex justify-center mt-3 mb-6">
            <button
              type="submit"
              class="bg-white text-[#13810A] font-bold py-2.5 px-6 rounded-md hover:bg-gray-100 transition w-fit">
              Daftar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>