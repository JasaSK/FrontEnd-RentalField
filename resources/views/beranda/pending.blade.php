@extends('beranda.layouts.master')
@section('title','Home')
@section('content')
<!-- Progress Bar -->
<div class="relative w-3/4 mx-auto mt-32 mb-12">
  <div class="relative h-6">
    <!-- Garis penuh -->
    <div class="absolute top-1/2 left-0 right-0 h-4 bg-gray-500 transform -translate-y-1/2 rounded-full"></div>

    <!-- Garis progress -->
    <div
      class="absolute top-1/2 left-0 h-4 bg-[#13810A] transform -translate-y-1/2 transition-all duration-700 rounded-full"
      style="width: 66%;"></div>

    <!-- Titik progress -->
    <div class="absolute top-1/2 left-0 w-8 h-8 bg-[#13810A] rounded-full transform -translate-y-1/2 -translate-x-1/2 border-2 border-white"></div>
    <div class="absolute top-1/2 left-1/3 w-8 h-8 bg-[#13810A] rounded-full transform -translate-y-1/2 -translate-x-1/2 border-2 border-white"></div>
    <div class="absolute top-1/2 left-2/3 w-8 h-8 bg-[#13810A] rounded-full transform -translate-y-1/2 -translate-x-1/2 border-2 border-white"></div>
    <div class="absolute top-1/2 right-0 w-8 h-8 bg-gray-400 rounded-full transform -translate-y-1/2 translate-x-1/2 border-2 border-white"></div>
  </div>

  <!-- Label Progress -->
  <div class="flex justify-between mt-10 text-black text-xl font-bold">
    <p class="mt-1 text-center font-bold text-lg relative -left-4">Order<br>Validation</p>
    <p class="mt-1 text-center font-bold text-lg">Payment</p>
    <p class="mt-1 text-center font-bold text-lg">Pending</p>
    <p class="mt-1 text-center font-bold text-lg relative left-4">Sukses</p>
  </div>
</div>

<!-- Konten -->
<div class="mx-auto space-y-6 w-[97%] max-w-[1000px] mt-2 mb-10">
  <!-- CARD DETAIL PESANAN -->
  <div class="bg-white rounded-md shadow p-5">
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
      <span class="font-semibold">Rp0</span>
    </div>

    <!-- BUTTONS -->
    <div class="flex justify-center gap-6 mt-8">
      <button
        class="bg-[#13810A] hover:bg-[#0f6e09] text-white px-6 py-3 rounded-md font-semibold transition-all duration-200 shadow-md hover:shadow-lg w-1/2 md:w-1/3">
        Download Bukti Pembayaran
      </button>

      <button
        id="openRefundModal"
        class="bg-[#13810A] hover:bg-[#0f6e09] text-white px-6 py-3 rounded-md font-semibold transition-all duration-200 shadow-md hover:shadow-lg w-1/2 md:w-1/3">
        Refund
      </button>
    </div>
  </div>
</div>

<!-- MODAL REFUND -->
<div id="refundModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-[90%] max-w-md p-6 relative">
    <h3 class="text-xl font-bold text-center mb-4 text-gray-800">Form Refund</h3>

    <form id="refundForm" class="space-y-4">
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Kode Booking:</label>
        <p class="text-gray-800 font-medium">BO-001</p>
      </div>

      <div>
        <label class="block text-gray-700 font-semibold mb-1">No Rekening</label>
        <input
          type="text"
          placeholder="Masukkan No Rekening"
          class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#13810A] focus:outline-none" />
      </div>

      <div>
        <label class="block text-gray-700 font-semibold mb-1">Alasan Refund</label>
        <input
          type="text"
          placeholder="Masukkan Alasan Refund"
          class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#13810A] focus:outline-none" />
      </div>

      <div>
        <label class="block text-gray-700 font-semibold mb-1">Upload Bukti Transfer</label>
        <input
          type="file"
          class="w-full border border-gray-300 rounded-md p-2 text-gray-700" />
      </div>

      <!-- Tombol aksi -->
      <div class="flex justify-center gap-4 mt-6">
        <button
          type="button"
          id="cancelRefund"
          class="bg-[#9b0000] hover:bg-[#7a0000] text-white px-6 py-2 rounded-md font-semibold transition-all duration-200">
          Cancel
        </button>

        <button
          type="submit"
          class="bg-[#13810A] hover:bg-[#0f6e09] text-white px-6 py-2 rounded-md font-semibold transition-all duration-200">
          Kirim
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/refund.js') }}"></script>
@endpush