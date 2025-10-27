<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lapangan Futsal</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<html lang="id" class="scroll-smooth">
<body class="text-black relative">
  <!-- Background-->
  <div class="absolute inset-0 -z-10">
    <div class="h-[60vh] bg-[url('/aset/lapangan-bg.jpg')] bg-cover bg-center"></div>
  </div>
  <!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-300">
  <div class="flex justify-between items-center px-6 md:px-12 py-4">
    <h1 class="text-xl md:text-2xl font-bold italic text-[#13810A]">
      Lapangan Futsal
    </h1>
    <div class="flex space-x-4">
      <a href="{{ url('/login') }}" 
         class="bg-[#13810A] text-white font-semibold text-xl px-7 py-3 rounded-lg hover:bg-[#0f6508] transition">
        Login
      </a>
      <a href="{{ url('/daftar') }}" 
         class="bg-[#13810A] text-white font-semibold text-xl px-7 py-3 rounded-lg hover:bg-[#0f6508] transition">
        Daftar
      </a>
    </div>
  </div>
</nav>
  <!-- Menu-->
  <div class="flex justify-center space-x-10 text-xl md:text-2xl py-7 text-white bg-black/70 relative z-30 mt-24">
    <a href="#event" class="hover:text-[#13810A] transition">Event</a>
    <a href="#galeri" class="hover:text-[#13810A] transition">Galeri</a>
    <a href="#kontak" class="hover:text-[#13810A] transition">Kontak</a>
    <a href="#maps" class="hover:text-[#13810A] transition">Maps</a>
    <a href="#riwayat-pesanan" class="hover:text-[#13810A] transition">Riwayat Pesanan</a>
  </div>
  <!-- Section Card Form -->
 <section id="home" class="flex justify-center items-start mt-[193px] px-6 relative z-10">
    <div class="bg-[#7A0010] p-6 rounded-xl shadow-xl w-[100%] max-w-[1500px]">
      <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
        <!-- Kolom kiri -->
        <div class="flex flex-col gap-4 w-full md:w-[45%]">
          <div>
            <label class="text-white font-semibold mb-1 text-center text-lg block">Tanggal Main</label>
            <input type="date" class="w-full px-5 py-4 rounded-lg text-gray-700 text-center outline-none text-lg" />
          </div>
          <div>
            <label class="text-white font-semibold mb-1 text-center text-lg block">Jam Mulai</label>
            <select class="w-full px-5 py-4 rounded-lg text-gray-700 text-center outline-none text-lg">
              <option>00.00</option><option>08.00</option><option>09.00</option><option>10.00</option>
              <option>11.00</option><option>12.00</option><option>13.00</option><option>14.00</option>
              <option>15.00</option><option>16.00</option><option>17.00</option><option>18.00</option>
              <option>19.00</option><option>20.00</option><option>21.00</option>
            </select>
          </div>
        </div>
        <!-- Kolom kanan -->
        <div class="flex flex-col gap-4 w-full md:w-[45%]">
          <div>
            <label class="text-white font-semibold mb-1 text-center text-lg block">Tipe Lapangan</label>
            <select class="w-full px-5 py-4 rounded-lg text-gray-700 text-center outline-none text-lg">
              <option>Indoor</option>
              <option>Outdoor</option>
            </select>
          </div>
          <div>
            <label class="text-white font-semibold mb-1 text-center text-lg block">Jam Selesai</label>
            <select class="w-full px-5 py-4 rounded-lg text-gray-700 text-center outline-none text-lg">
             <option>00.00</option><option>08.00</option><option>09.00</option><option>10.00</option>
              <option>11.00</option><option>12.00</option><option>13.00</option><option>14.00</option>
              <option>15.00</option><option>16.00</option><option>17.00</option><option>18.00</option>
              <option>19.00</option><option>20.00</option><option>21.00</option>
            </select>
          </div>
        </div>
        <!-- Tombol Search -->
        <div class="flex justify-center items-center w-full md:w-[20%] mt-6 md:mt-0">
          <button type="submit" 
            class="bg-[#13810A] hover:bg-green-800 text-white font-semibold px-12 py-6 rounded-xl text-xl shadow-md transition">
            Search
          </button>
        </div>
      </div>
    </div>
  </section>
 <!-- Grid Card -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto mt-16  w-[97%] max-w-[1500px]">

    @php
      // Data dummy sementara supaya tampilan tidak error
      $lapangans = [
          (object)['nama' => 'Lapangan 1', 'foto' => 'aset/img-lapangan/lapangan-1.jpg'],
          (object)['nama' => 'Lapangan 2', 'foto' => 'aset/img-lapangan/lapangan-2.jpg'],
          (object)['nama' => 'Lapangan 3', 'foto' => 'aset/img-lapangan/lapangan-2.jpg'],
          (object)['nama' => 'Lapangan 4', 'foto' => 'aset/img-lapangan/lapangan-1.jpg'],
          (object)['nama' => 'Lapangan 5', 'foto' => 'aset/img-lapangan/lapangan-1.jpg'],
          (object)['nama' => 'Lapangan 6', 'foto' => 'aset/img-lapangan/lapangan-2.jpg'],
          (object)['nama' => 'Lapangan 7', 'foto' => 'aset/img-lapangan/lapangan-2.jpg'],
          (object)['nama' => 'Lapangan 8', 'foto' => 'aset/img-lapangan/lapangan-1.jpg'],
      ];
    @endphp

    @foreach($lapangans as $lapangan)
      <div class="relative rounded-2xl overflow-hidden shadow-lg group cursor-pointer hover:shadow-2xl transition">
        <!-- Gambar -->
        <img 
          src="{{ asset($lapangan->foto) }}" 
          alt="{{ $lapangan->nama }}" 
          class="w-full h-56 object-cover group-hover:scale-110 transition duration-500"
        >
        <!-- Overlay + Nama Lapangan -->
        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
          <h2 class="text-white text-2xl font-semibold tracking-wide">
            {{ $lapangan->nama }}
          </h2>
        </div>
      </div>
    @endforeach
  </div>
<!-- Event Section -->
<section id="event" class="py-24 md:py-32 px-6 md:px-12 bg-white text-center">
  <h2 class="text-3xl md:text-5xl font-bold mb-10 text-[#000000]">
    Event
  </h2>

  <!-- Wrapper Carousel -->
  <div class="relative max-w-6xl mx-auto overflow-hidden rounded-2xl shadow-xl w-[97%] max-w-[1200px]">
    <!-- Container Card -->
    <div id="event-carousel" class="flex transition-transform duration-700 ease-in-out">
      <!-- Gambar dummy-->
      <img src="aset/img-event/event1.jpg" class="min-w-full h-[400px] object-cover rounded-2xl ">
      <img src="aset/img-event/event1.jpg" class="min-w-full h-[400px] object-cover rounded-2xl">
      <img src="aset/img-event/event1.jpg" class="min-w-full h-[400px] object-cover rounded-2xl">
    </div>
  </div>
  <!-- Dots titik -->
  <div class="flex justify-center mt-6 space-x-3">
    <span class="w-5 h-5 bg-black rounded-full opacity-100 transition-all" id="dot-0"></span>
    <span class="w-5 h-5 bg-gray-400 rounded-full opacity-60 transition-all" id="dot-1"></span>
    <span class="w-5 h-5 bg-gray-400 rounded-full opacity-60 transition-all" id="dot-2"></span>
  </div>
</section>

<script>
  const carousel = document.getElementById('event-carousel');
  const dots = document.querySelectorAll('[id^="dot-"]');
  let index = 0;

  function updateCarousel() {
    carousel.style.transform = `translateX(-${index * 100}%)`;
    dots.forEach((dot, i) => {
      dot.classList.toggle('bg-black', i === index);
      dot.classList.toggle('bg-gray-400', i !== index);
      dot.classList.toggle('opacity-100', i === index);
      dot.classList.toggle('opacity-60', i !== index);
    });
  }

  setInterval(() => {
    index = (index + 1) % dots.length;
    updateCarousel();
  }, 4000);
</script>
 <!-- Galeri Section -->
<section id="galeri" class="py-15 md:py-15 px-6 md:px-12 bg-white text-center">
  <h2 class="text-3xl md:text-5xl font-bold mb-10 text-[#000000]">
    Galeri
  </h2>
  <div class="flex justify-center gap-6 mb-10">
    <button class="filter-btn bg-transparent border border-[#13810A] hover:bg-[#13810A] hover:text-white px-5 py-2 rounded-md text-[#13810A] font-semibold"" data-filter="all">All</button>
    <button class="filter-btn bg-transparent border border-[#13810A] hover:bg-[#13810A] hover:text-white px-5 py-2 rounded-md text-[#13810A] font-semibold" data-filter="lapangan">Lapangan</button>
    <button class="filter-btn bg-transparent border border-[#13810A] hover:bg-[#13810A] hover:text-white px-5 py-2 rounded-md text-[#13810A] font-semibold" data-filter="fasilitas">Fasilitas</button>
  </div>
<body class="m-0 p-0">
  <!-- Card galeri Lapangan -->
<section class="w-full mt-14">
  <div class="relative w-full overflow-hidden rounded-none shadow-lg gallery-item lapangan">
    <img 
      src="{{ asset('aset/img-lapangan/lapangan-1.jpg') }}" 
      alt="Lapangan Futsal"
      class="w-full h-[500px] object-cover  transform transition-transform duration-500 ease-in-out hover:scale-105"
    >
  </div>
</section>
<section class="w-full mt-14">
  <div class="relative w-full overflow-hidden rounded-none shadow-lg gallery-item lapangan">
    <img 
      src="{{ asset('aset/img-lapangan/lapangan-2.jpg') }}" 
      alt="Lapangan Futsal"
      class="w-full h-[500px] object-cover  transform transition-transform duration-500 ease-in-out hover:scale-105"
    >
  </div>
</section>

<!-- Card fasilitas -->
<section class="w-full mt-14">
  <div class="relative w-full overflow-hidden rounded-none shadow-lg gallery-item fasilitas">
    <img 
      src="{{ asset('aset/img-fasilitas/fasilitas-1.jpg') }}" 
      alt="Fasilitas Futsal"
      class="w-full h-[500px] object-cover  transform transition-transform duration-500 ease-in-out hover:scale-105"
    >
  </div>
</section>
<section class="w-full mt-14">
  <div class="relative w-full overflow-hidden rounded-none shadow-lg gallery-item fasilitas">
    <img 
      src="{{ asset('aset/img-fasilitas/fasilitas-2.jpg') }}" 
      alt="Fasilitas Futsal"
      class="w-full h-[500px] object-cover transform transition-transform duration-500 ease-in-out hover:scale-105"
    >
  </div>
</section>
<!-- JavaScript untuk filter -->
<script>
  const filterButtons = document.querySelectorAll('.filter-btn');
  const galleryItems = document.querySelectorAll('.gallery-item');

  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      // Hapus kelas aktif dari semua tombol
      filterButtons.forEach(b => b.classList.remove('bg-[#13810A]', 'text-white'));
      filterButtons.forEach(b => b.classList.add('bg-transparent', 'text-[#13810A]'));

      // Tambahkan kelas aktif ke tombol yang diklik
      btn.classList.add('bg-[#13810A]', 'text-white');
      btn.classList.remove('bg-transparent', 'text-[#13810A]');

      const filter = btn.dataset.filter;

      galleryItems.forEach(item => {
        if (filter === 'all' || item.classList.contains(filter)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
</script>
<!-- Contact Section -->
<section id="kontak" class="py-20 px-6 md:px-12 bg-white-50 text-center">
  <h2 class="text-3xl md:text-5xl font-bold mb-10 text-[#000000] ">
    Contact Us
  </h2>
<!-- card -->
  <div class="bg-white rounded-xl p-8  mx-auto w-[97%] max-w-[1500px] shadow-[0_0_25px_rgba(0,0,0,0.15)]">
    <!-- Location -->
    <div class="flex items-start space-x-4 pb-6 border-b border-gray-200">
      <div class="bg-[#7A0010] text-white p-3 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zM12 22s8-4.5 8-11a8 8 0 10-16 0c0 6.5 8 11 8 11z" />
        </svg>
      </div>
      <div class="text-left">
        <h3 class="font-semibold text-lg">Location</h3>
        <p class="text-gray-600 text-sm">
          jl perusahaan, perumahan tirtasani, estate malang
        </p>
      </div>
    </div>

    <!-- Email -->
    <div class="flex items-start space-x-4 py-6 border-b border-gray-200">
      <div class="bg-[#7A0010] text-white p-3 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 8l9 6 9-6M4 6h16a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
        </svg>
      </div>
      <div class="text-left">
        <h3 class="font-semibold text-lg">Email</h3>
        <p class="text-gray-600 text-sm">
          lapanganfutsal@gmail.com
        </p>
      </div>
    </div>

    <!-- Call -->
    <div class="flex items-start space-x-4 pt-6">
      <div class="bg-[#7A0010] text-white p-3 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 5a2 2 0 012-2h3l2 5-2.5 1.5a11 11 0 005 5L15 15l5 2v3a2 2 0 01-2 2h-1C9.82 22 3 15.18 3 7V5z" />
        </svg>
      </div>
      <div class="text-left">
        <h3 class="font-semibold text-lg">Call</h3>
        <p class="text-gray-600 text-sm">
          +62 000-0000-0000
        </p>
      </div>
    </div>
  </div>
</section>
   <!-- maps -->
<section id="maps" class="py-20 px-6 md:px-12 bg-white-50">
  <h2 class="text-3xl md:text-5xl font-bold mb-10 text-center text-[#000000]">
    Maps
  </h2>

  <div class="max-w-[1500px] mx-auto bg-white rounded-xl shadow-[0_0_25px_rgba(0,0,0,0.15)] overflow-hidden">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.8660680895628!2d112.63119177302289!3d-7.909057078710882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd62b9fde296155%3A0x9f2b9e49f08bd861!2sTirtasani%20Estate%20F%2F3!5e0!3m2!1sid!2sid!4v1760976402420!5m2!1sid!2sid"
      class="w-full h-[400px] md:h-[600px] border-0"
      style="border:0;"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</section>
<!-- Footer Section -->
<footer class="w-screen bg-white py-14 border-t shadow-[0_-4px_10px_rgba(0,0,0,0.1)] relative left-1/2 -translate-x-1/2">
  <div class="max-w-6xl mx-auto px-6 md:px-12">
    <!-- Ikon Sosial Media -->
    <div class="flex justify-center items-center space-x-6 mb-10">
      <!-- Instagram -->
      <a href="https://www.instagram.com/" class="bg-[#13810A] hover:bg-[#0f6508] transition text-black w-12 h-12 rounded-full flex items-center justify-center">
        <i class="fa-brands fa-instagram text-2xl"></i>
      </a>
      <!-- Facebook -->
      <a href="https://www.facebook.com/" class="bg-[#13810A] hover:bg-[#0f6508] transition text-black w-12 h-12 rounded-full flex items-center justify-center">
        <i class="fa-brands fa-facebook-f text-2xl"></i>
      </a>
      <!-- TikTok -->
      <a href="https://www.tiktok.com/" class="bg-[#13810A] hover:bg-[#0f6508] transition text-black w-12 h-12 rounded-full flex items-center justify-center">
        <i class="fa-brands fa-tiktok text-2xl"></i>
      </a>
    </div>
    <!-- About Lapangan -->
    <div class="w-full text-left">
      <h3 class="text-2xl font-bold mb-3 text-black">About Lapangan</h3>
      <p class="text-gray-700 text-sm md:text-base leading-relaxed mb-8">
        Lapangan Futsal kami menyediakan fasilitas terbaik untuk Anda yang ingin bermain dengan nyaman dan aman. 
        Kami berlokasi strategis dan menawarkan layanan sewa lapangan dengan harga terjangkau. 
        Nikmati pengalaman bermain futsal bersama teman atau rekan kerja hanya di tempat kami.
      </p>
      <a href="#" class="home inline-block bg-[#13810A] hover:bg-[#0f6508] transition text-white font-semibold px-6 py-3 rounded-md text-lg">
    Pesan Sekarang >>
      </a>
    </div>
  </div>
</footer>
</body>
</html>