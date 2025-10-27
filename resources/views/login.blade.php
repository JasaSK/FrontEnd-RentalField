<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
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
  <div class="h-28"></div>

  <!-- CARD UTAMA -->
  <div class="relative w-[970px] h-[520px] rounded-2xl overflow-hidden shadow-2xl bg-white">
    
    <!-- GAMBAR BACKGROUND -->
    <div class="absolute inset-0 bg-[url('/aset/login-bg.jpg')] bg-cover bg-center"></div>

    <!-- TEKS -->
    <div class="absolute bottom-8 left-[120px] text-white text-xl font-semibold drop-shadow-lg max-w-sm leading-relaxed">
      Welcome back! Let's make today <br>
      <span class="pl-6">productive and smooth.</span>
    </div>

    <!-- CARD LOGIN -->
    <div class="absolute top-6 right-6 bottom-6 bg-[#13810A] bg-opacity-65 backdrop-blur-md p-8 rounded-2xl shadow-2xl w-[360px] text-white flex flex-col justify-center items-center">
      <div class="flex flex-col items-center w-full">

        <!-- ICON -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 6.197 9 9 0 015.12 17.804z" />
        </svg>

        <h2 class="text-2xl font-bold mb-6">Login</h2>

        <!-- FORM LOGIN -->
        <form class="w-full flex flex-col gap-4">
          <!-- Username -->
          <div>
            <label class="block mb-1 text-sm">Email</label>
            <input 
              type="text" 
              placeholder="Masukkan Email"
              class="w-full p-2 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-400 outline-none"
            >
          </div>

          <!-- Password -->
          <div>
            <label class="block mb-1 text-sm">Password</label>
            <input 
              type="password" 
              placeholder="Masukkan Password"
              class="w-full p-2 rounded-md text-black placeholder-gray-400 focus:ring-2 focus:ring-green-400 outline-none"
            >
          </div>

          <!-- Remember me & Forgot password -->
          <div class="flex justify-between items-center text-sm mt-1 w-full px-1 gap-6">
            <label class="flex items-center gap-2">
              <input type="checkbox" class="accent-red-500">
              <span>Remember me</span>
            </label>
            <a href="#" class="hover:underline ml-4">Forgot password?</a>
          </div>

          <!-- Belum punya akun -->
          <p class="text-center text-sm leading-tight mt-2">
            Belum memiliki akun? <br>
            <a href="#" class="underline text-blue-400 hover:text-blue-500">Daftar sekarang</a>
          </p>

          <!-- Tombol Login -->
          <button 
            type="submit" 
            class="bg-white text-green-700 font-bold py-2 rounded-md hover:bg-gray-100 transition mt-2">
            Login
          </button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
