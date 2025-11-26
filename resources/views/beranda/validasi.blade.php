@extends('beranda.layouts.master')
@section('title','Home')
@section('content')
<!-- Progress Bar -->
<div class="relative w-3/4 mx-auto mt-32 mb-12">
  <div class="relative h-6">
    <!-- Garis abu-abu -->
    <div class="absolute top-1/2 left-0 right-0 h-4 bg-gray-500 transform -translate-y-1/2 rounded-full"></div>
    <!-- Garis aktif -->
    <div class="absolute top-1/2 left-0 h-4 bg-gray-500 transform -translate-y-1/2 transition-all duration-700 rounded-full" style="width: 50%;"></div>
    <!-- Titik bulat -->
    <div class="absolute top-1/2 left-0 w-8 h-8 bg-[#13810A] rounded-full transform -translate-y-1/2 -translate-x-1/2 border-2 border-white"></div>
    <div class="absolute top-1/2 left-1/2 w-8 h-8 bg-gray-500 rounded-full transform -translate-y-1/2 -translate-x-1/2 border-2 border-white"></div>
    <div class="absolute top-1/2 right-0 w-8 h-8 bg-gray-500 rounded-full transform -translate-y-1/2 translate-x-1/2 border-2 border-white"></div>
  </div>

  <!-- Label -->
  <div class="flex justify-between mt-10 text-black text-xl font-bold">
    <p class="mt-1 text-center font-bold text-lg leading-tight relative -left-8">
      Validasi<br>Item
    </p>
    <p class="mt-1 text-center font-bold text-lg leading-tight">
      Order<br>Validation
    </p>
    <p class="mt-1 text-center font-bold text-lg leading-tight relative left-8">
      Payment
    </p>
  </div>
</div>

<!-- Riwayat Pemesanan -->
<section class="mt-2 mb-2 px-6 md:px-12 bg-white/70">
  <h2 class="text-2xl md:text-3xl font-bold text-center mb-1">Periksa Pemesanan Anda</h2>
  <p class="mt-2 text-center text-lg">Pastikan Detail Pesanan Anda Sudah Benar</p>
</section>
<!-- ukuran card -->
<div class="mx-auto space-y-6 w-[97%] max-w-[1000px] mt-2 mb-20">
  <!-- CARD 1 -->
  <div class="bg-white rounded-lg shadow-[0_4px_10px_rgba(0,0,0,0.08),inset_0_2px_6px_rgba(0,0,0,0.05)] p-6 py-7 flex justify-between items-start">
    <div>
      <p class="font-bold text-lg">Lapangan 1</p>
      <p class="text-sm text-gray-600">00-00-0000</p>
      <p class="text-sm text-gray-600">00.00 – 00.00</p>
      <p class="text-sm text-gray-600">BO-001</p>
    </div>
    <div class="text-right">
      <p class="font-semibold text-gray-800">Rp0</p>
      <button class="text-gray-600 hover:text-red-600 text-sm mt-2 flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12" />
        </svg>
        Hapus
      </button>
    </div>
  </div>

  <!-- CARD 2 -->
  <div class="bg-white rounded-lg shadow-[0_4px_10px_rgba(0,0,0,0.08),inset_0_2px_6px_rgba(0,0,0,0.05)] p-6 py-7 flex justify-between items-start">
    <div>
      <p class="font-bold text-lg">Lapangan 2</p>
      <p class="text-sm text-gray-600">00-00-0000</p>
      <p class="text-sm text-gray-600">00.00 – 00.00</p>
      <p class="text-sm text-gray-600">BO-002</p>
    </div>
    <div class="text-right">
      <p class="font-semibold text-gray-800">Rp0</p>
      <button class="text-gray-600 hover:text-red-600 text-sm mt-2 flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12" />
        </svg>
        Hapus
      </button>
    </div>
  </div>

  <!-- CARD 3 -->
  <div class="bg-white rounded-lg shadow-[0_4px_10px_rgba(0,0,0,0.08),inset_0_2px_6px_rgba(0,0,0,0.05)] p-6 py-7 flex justify-between items-start">
    <div>
      <p class="font-bold text-lg">Lapangan 3</p>
      <p class="text-sm text-gray-600">00-00-0000</p>
      <p class="text-sm text-gray-600">00.00 – 00.00</p>
      <p class="text-sm text-gray-600">BO-003</p>
    </div>
    <div class="text-right">
      <p class="font-semibold text-gray-800">Rp0</p>
      <button class="text-gray-600 hover:text-red-600 text-sm mt-2 flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12" />
        </svg>
        Hapus
      </button>
    </div>
  </div>

  <!-- BUTTON KONFIRMASI -->
  <div class="flex justify-center pt-4">
    <a href="{{ route('beranda.order-validation') }}"
      class="bg-[#13810A] hover:bg-[#7a0a15] text-white px-8 py-3 rounded-md font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
      Konfirmasi Pemesanan
    </a>
  </div>
</div>
@endsection