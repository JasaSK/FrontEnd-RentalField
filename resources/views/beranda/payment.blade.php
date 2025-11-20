@extends('beranda.layouts.master')
@section('title','Home')
@section('content')
<!-- Progress Bar -->
<div class="relative w-3/4 mx-auto mt-32 mb-12">
  <div class="relative h-6">
    <!-- Garis(full) -->
    <div class="absolute top-1/2 left-0 right-0 h-4 bg-gray-500 transform -translate-y-1/2 rounded-full"></div>
    <div class="absolute top-1/2 left-0 h-4 bg-[#13810A] transform -translate-y-1/2 transition-all duration-700 rounded-full" style="width: 33%;"></div>
    <!-- Titik bulat -->
    <div class="absolute top-1/2 left-0 w-8 h-8 bg-[#13810A] rounded-full transform -translate-y-1/2 -translate-x-1/2 border-2 border-white"></div>
    <div class="absolute top-1/2 left-1/3 w-8 h-8 bg-[#13810A] rounded-full transform -translate-y-1/2 -translate-x-1/2 border-2 border-white"></div>
    <div class="absolute top-1/2 left-2/3 w-8 h-8 bg-gray-400 rounded-full transform -translate-y-1/2 -translate-x-1/2 border-2 border-white"></div>
    <div class="absolute top-1/2 right-0 w-8 h-8 bg-gray-400 rounded-full transform -translate-y-1/2 translate-x-1/2 border-2 border-white"></div>
  </div>
  <!-- Label -->
  <div class="flex justify-between mt-10 text-black text-xl font-bold">
    <p class="mt-1 text-center font-bold text-lg leading-tight relative -left-4">
      Order<br>Validation
    </p>
    <p class="mt-1 text-center font-bold text-lg leading-tight">
      Payment
    </p>
    <p class="mt-1 text-center font-bold text-lg leading-tight">
      Pending
    </p>
    <p class="mt-1 text-center font-bold text-lg leading-tight relative left-4">
      Sukses
    </p>
  </div>
</div>
</div>
<!-- ukuran konten -->
<div class="mx-auto space-y-6 w-[97%] max-w-[1000px] mt-2 mb-10">
  <!-- CARD DETAIL PESANAN -->
  <div class="bg-white rounded-md shadow-[0_4px_8px_rgba(0,0,0,0.12),inset_0_2px_4px_rgba(0,0,0,0.05)] p-5">
    <h3 class="text-lg font-bold mb-3 text-black">Detail Pesanan</h3>
    <div class="space-y-1 text-gray-700 text-sm">
      <p>Lapangan 1</p>
      <p>00-00-0000</p>
      <p>00.00 – 00.00</p>
      <p>Nama Customer</p>
      <p>test@gmail.com</p>
      <p>BO-001</p>
      <p>085876524367</p>
      <p>Notes</p>
    </div>
    <div class="mt-4 pt-6 flex justify-between text-sm text-gray-800 pr-8">
      <span>Harga lapangan</span>
      <span class="font-semibold">Rp0</span>
    </div>
    <div class="border-t border-gray-300 pt-6 flex justify-between text-sm text-gray-800 pr-8">
      <span>Total Bayar</span>
      <span class="font-semibold ">Rp0</span>
    </div>
  </div>
</div>
<!--  QRIS Container -->
<div class="mx-auto space-y-6  mt-2 mb-10 text-center">
  <h4 class="text-gray-800 text-2xl font-bold">QRIS </h4>
  <div class="bg-white rounded-xl shadow-[0_4px_8px_rgba(0,0,0,0.1)] p-20 max-w-md mx-auto">
    <img
      src="{{ asset('aset/qris-lapangan.jpg') }}"
      alt="QRIS"
      class="mx-auto rounded-lg border border-gray-300 w-56 mb-5">
    <p class="text-sm text-gray-700 mt-3">
      A.N: <span class="text-gray-900 font-semibold">EZFutsal</span>
    </p>
  </div>
  <!-- BUTTONS -->
  <div class="flex justify-center gap-6 pt-4">
    <!-- Tombol Upload -->
    <form id="uploadForm" enctype="multipart/form-data">
      <input
        type="file"
        id="buktiPembayaran"
        name="buktiPembayaran"
        accept="image/*,application/pdf"
        class="hidden">
      <label
        for="buktiPembayaran"
        class="cursor-pointer bg-[#13810A] hover:bg-[#0f6e09] text-white px-6 py-3 rounded-md font-semibold transition-all duration-200 shadow-md hover:shadow-lg inline-block">
        Upload Bukti Pembayaran
      </label>
    </form>
    <!-- Tombol Konfirmasi -->
    <a href="{{ route('beranda.pending') }}"
      class="bg-[#13810A] hover:bg-[#0f6e09] text-white px-8 py-3 rounded-md font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
      Konfirmasi Pembayaran
    </a>
  </div>
  @endsection
  @push('scripts')
  <script src="{{ asset('js/upload-preview.js') }}"></script>
  @endpush