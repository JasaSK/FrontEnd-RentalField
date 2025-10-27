<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Daftar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white flex flex-col items-center min-h-screen">

  <!-- Navbar -->
  <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-300">
    <div class="flex justify-between items-center px-6 md:px-12 py-4">
      <h1 class="text-xl md:text-4xl font-bold italic text-[#13810A]">
        Lapangan Futsal
      </h1>
    </div>
  </nav>

  <!-- Spacer navbar -->
  <div class="h-20"></div>

  <!-- CARD UTAMA -->
   <div class="relative w-[980px] h-[580px] rounded-2xl overflow-hidden shadow-2xl bg-black">
    
   <!-- BAGIAN GAMBAR (dengan overlay hitam hanya di sini) -->
  <div class="absolute inset-0">
    <div class="w-full h-full bg-[url('/aset/register-bg.jpg')] bg-cover bg-center"></div>
    <!-- Overlay hitam cuma di area gambar -->
    <div class="absolute inset-0 bg-black/20"></div>
  </div>

 <!-- TEKS KIRI -->
<div class="absolute top-1/2 left-[90px] -translate-y-[40%] text-white text-[20px] font-semibold drop-shadow-lg leading-relaxed max-w-xs">
  Selamat datang! Silakan buat</br>akun untuk mulai mengakses
   <span class="pl-16">layanan kami.</span>
</div>


    <!-- CARD REGISTER -->
    <div class="absolute top-5 right-5 bottom-5 bg-[#13810A]/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl w-[360px] text-white flex flex-col justify-center items-center">
      <div class="flex flex-col items-center w-full">

        <!-- ICON -->
        <div class="w-12 h-12 rounded-full bg-white/25 flex items-center justify-center mb-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 14a4 4 0 10-8 0m8 0v6m-8-6v6m8-6a4 4 0 01-8 0" />
          </svg>
        </div>

        <h2 class="text-2xl font-bold mb-5 tracking-wide">Sign up</h2>

        <!-- FORM REGISTER -->
        <form class="w-full flex flex-col gap-4 text-sm font-medium">

          <!-- Nama -->
          <div>
            <label class="block mb-1">Nama</label>
            <input type="text" placeholder="Nama lengkap"
              class="w-full p-2.5 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
          </div>

          <!-- Nomor Telepon -->
<div>
  <label class="block mb-1">Nomor telepon</label>
  <div class="flex items-center rounded-md overflow-hidden bg-white">
    <div class="flex items-center gap-1 px-3 py-2 bg-gray-100 border-r border-gray-300 text-black">
      <img src="https://flagcdn.com/w20/id.png" alt="Indonesia" class="w-5 h-4 rounded-sm">
      <span class="text-sm font-medium">+62</span>
    </div>
    <input type="tel" placeholder="81234567890"
      class="flex-1 p-2.5 text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
  </div>
</div>

          <!-- Email -->
          <div>
            <label class="block mb-1">Email</label>
            <input type="email" placeholder="Email aktif"
              class="w-full p-2.5 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
          </div>

          <!-- Password -->
          <div>
            <label class="block mb-1">Password</label>
            <input type="password" placeholder="Masukkan password"
              class="w-full p-2.5 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-300 outline-none">
          </div>

          <!-- Sudah punya akun -->
          <p class="text-center text-sm mt-2">
            Sudah memiliki akun?
            <a href="#" class="text-red-600 hover:text-red-500 hover:underline transition">Login sekarang</a>
          </p>

          <!-- Tombol Daftar -->
          <button 
            type="submit" 
            class="bg-white text-[#13810A] font-bold py-2.5 rounded-md hover:bg-gray-100 transition ">
            Daftar
          </button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
