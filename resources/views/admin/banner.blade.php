@extends('admin.layouts.master')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-3">Info Banner</h1>
<div class="p-3 flex-1">
  <div class="mx-auto w-[97%] max-w-[1500px] space-y-6 mb-6">

    <!-- Card Upload Banner -->
    <div class="bg-white border border-gray-200 shadow-md rounded-xl p-6">
      <h3 class="text-xl font-semibold mb-4 text-gray-800">Upload Banner</h3>
      <p class="text-gray-700 mb-2">Upload Gambar Banner</p>

      <div class="flex items-center gap-3 mb-4">
        <input type="file"
          class="border border-gray-300 rounded-lg px-3 py-2 w-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#880719]" />
      </div>

      <button
        class="bg-[#880719] hover:bg-[#a41e27] text-white font-semibold px-5 py-2 rounded-lg shadow-md">
        Upload Banner
      </button>
    </div>

    <!-- Card Daftar Banner -->
    <div class="bg-white border border-gray-200 shadow-md rounded-xl p-6">
      <h3 class="text-2xl font-bold text-gray-800 mb-4">Daftar Banner</h3>

      <table class="w-full border-collapse">
        <thead class="text-center bg-gray-100">
          <tr class="border-b border-gray-300">
            <th class="py-3 px-2">No</th>
            <th class="py-3 px-2">Gambar</th>
            <th class="py-3 px-2">Tanggal Upload</th>
            <th class="py-3 px-2">Status</th>
            <th class="py-3 px-2">Aksi</th>
          </tr>
        </thead>

        <tbody class="text-gray-700 text-center">
          <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
            <td class="py-3 px-2">1</td>
            <td class="py-3 px-2">
              <img src="{{ asset('aset/img-banner/banner.jpg') }}" class="banner-img w-20 mx-auto rounded-md shadow">
            </td>
            <td class="py-3 px-2 tanggal">20 Okt 2025</td>
            <td class="py-3 px-2 status">
              <span class="status-label bg-[#13810A] text-white text-sm font-semibold px-4 py-1 rounded-full shadow">Aktif</span>
            </td>
            <td class="py-3 px-2 relative">
              <button
                class="editBtn bg-[#120A81] hover:bg-blue-900 text-white text-sm font-semibold px-3 py-1 rounded-lg shadow">
                Edit
              </button>
              <button
                class="hapusBtn bg-[#880719] hover:bg-[#a41e27] text-white text-sm font-semibold px-3 py-1 rounded-lg shadow ml-2">
                Hapus
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- 🔹 Modal Edit Banner -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
      <div class="bg-white rounded-xl shadow-lg p-6 w-[400px] relative">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Banner</h2>

        <form id="editForm">
          <!-- Edit Gambar -->
          <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Banner</label>
            <input type="file" id="editImage" name="image"
              class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#880719]" />
            <img id="previewImage" src="" class="w-32 mt-2 rounded-md shadow hidden">
          </div>

          <!-- Edit Tanggal Upload -->
          <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Upload</label>
            <input type="date" id="editDate" name="tanggal"
              class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#880719]" />
          </div>

          <!-- Edit Status -->
          <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="editStatus" name="status"
              class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#880719]">
              <option value="Aktif">Aktif</option>
              <option value="Nonaktif">Nonaktif</option>
            </select>
          </div>

          <div class="flex justify-end gap-2 mt-5">
            <button type="button" id="cancelEdit"
              class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">Batal</button>
            <button type="submit"
              class="px-4 py-2 rounded-lg bg-[#880719] hover:bg-[#a41e27] text-white font-semibold">Simpan</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/edit-banner.js') }}"></script>
@endpush
