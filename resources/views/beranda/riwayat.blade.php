@extends('beranda.layouts.master')
@section('title','Home')
@section('content')
<!-- Riwayat Pemesanan -->
<section class="pt-32 pb-20 px-6 md:px-12 bg-white/70">
  <h2 class="text-2xl md:text-3xl font-bold text-center mb-10">Riwayat Pemesanan</h2>

  <div class="mx-auto space-y-6  w-[97%] max-w-[1500px]">
    <!-- Card Sukses -->
    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
      <h3 class="text-lg font-semibold mb-2">Detail Pesanan</h3>
      <p class="text-gray-700">Lapangan 1</p>
      <p class="text-gray-700 mb-3">00-00-0000</p>
      <div class="flex justify-between items-center">
        <p class="font-semibold">Status Pemesanan:</p>
        <span class="text-green-600 font-semibold">Sukses</span>
      </div>
    </div>

    <!-- Card Ditolak -->
    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
      <h3 class="text-lg font-semibold mb-2">Detail Pesanan</h3>
      <p class="text-gray-700">Lapangan 1</p>
      <p class="text-gray-700 mb-3">00-00-0000</p>
      <div class="flex justify-between items-center">
        <p class="font-semibold">Status Pemesanan:</p>
        <span class="text-red-600 font-semibold">Ditolak</span>
      </div>
    </div>
    @endsection