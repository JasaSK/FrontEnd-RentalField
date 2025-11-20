@extends('admin.layouts.master')

@section('content')
    <!-- Konten -->
    <h1 class="text-3xl font-bold text-gray-800 mb-3">Info Lapangan</h1>
    <div class="p-3 flex-1">

        <!-- Wrapper utama untuk atur lebar -->
        <div class="mx-auto w-[97%] max-w-[1500px] space-y-6 mb-6">

            <!-- Card Upload Galeri -->
            <div class="bg-white border border-gray-200 shadow-md rounded-xl p-6 mt-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Kelola Lapangan</h3>

                <form action="{{ route('admin.field.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <!-- Lapangan -->
                    <label class="block text-gray-700 font-semibold mb-1">Nama Lapangan</label>
                    <input type="text" name="name" placeholder="contoh: Lapangan 1"
                        class="bg-gray-100 border border-gray-300 rounded-lg w-full px-4 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#13810A]" />

                    <!-- Upload Gambar -->
                    <label class="block text-gray-700 font-medium mb-1">Upload Gambar Galeri</label>
                    <input type="file" name="image"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#880719]" />

                    <!-- Jam Buka -->
                    <label class="block text-gray-700 font-medium mb-1">Jam Buka</label>
                    <input type="time" name="open_time"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#880719]" />

                    <!-- Jam Tutup -->
                    <label class="block text-gray-700 font-medium mb-1">Jam Tutup</label>
                    <input type="time" name="close_time"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#880719]" />

                    <!-- Harga per jam -->
                    <label class="block text-gray-700 font-medium mb-1">Harga per Jam</label>
                    <input type="number" name="price_per_hour" placeholder="contoh: 50000"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#880719]" />

                    <!-- Deskripsi -->
                    <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Masukkan deskripsi..."
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#880719]"></textarea>

                    <!-- Kategori -->
                    <label class="block text-gray-700 font-medium mb-1">Kategori Lapangan</label>
                    <select name="category_field_id"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#880719]"
                        required>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>

                    <!-- Status -->
                    <label class="block text-gray-700 font-medium mb-1">Status</label>
                    <select name="status"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#880719]">
                        <option value="">-- Pilih Status --</option>
                        <option value="available">Tersedia</option>
                        <option value="booked">Sudah Dibooking</option>
                        <option value="maintenance">Perbaikan</option>
                        <option value="closed">Ditutup</option>
                        <option value="pending">Menunggu Pembayaran</option>
                    </select>


                    <!-- Tombol -->
                    <button type="submit"
                        class="bg-[#880719] hover:bg-[#a41e27] text-white font-semibold px-5 py-2 rounded-lg shadow-md">
                        Upload Galeri
                    </button>
                </form>
            </div>

            <!-- Card Daftar Lapangan -->
            <div class="bg-white border border-gray-200 shadow-md rounded-xl p-6 mt-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Daftar Lapangan</h3>

                <table class="w-full border-collapse">
                    <thead class="text-center bg-gray-100">
                        <tr class="border-b border-gray-300">
                            <th class="py-3 px-3">No</th>
                            <th class="py-3 px-3">Gambar</th>
                            <th class="py-3 px-3">Nama Lapangan</th>
                            <th class="py-3 px-3">Buka Lapangan</th>
                            <th class="py-3 px-3">Tutup Lapangan</th>
                            <th class="py-3 px-3">Description</th>
                            <th class="py-3 px-3">Harga</th>
                            <th class="py-3 px-3">Kategori Lapangan</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">
                        @foreach ($fields as $index => $data)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                <td class="py-3 px-2 text-center">{{ $index + 1 }}</td>
                                <td class="py-3 px-2">
                                    <div class="flex justify-center">
                                        <img src="{{ $data['image'] }}" alt="Lapangan 1"
                                            class="w-20 h-14 object-cover rounded-md shadow">
                                    </div>
                                </td>
                                <td class="py-3 px-2 text-center">{{ $data['name'] }}</td>
                                <td class="py-3 px-2 text-center">{{ $data['open_time'] }}</td>
                                <td class="py-3 px-2 text-center">{{ $data['close_time'] }}</td>
                                <td class="py-3 px-2 text-center">{{ $data['description'] }}</td>
                                <td class="py-3 px-2 text-center">{{ $data['price_per_hour'] }}</td>
                                <td class="py-3 px-2 text-center status">
                                    <span
                                        class="status-label bg-[#13810A] text-white text-sm font-semibold px-3 py-1 rounded-lg shadow">
                                        {{ $data['category_field']['name'] ?? 'Tidak ada status' }}
                                    </span>
                                </td>
                                <td class="py-3 px-2 text-center">{{ $data['status'] }}</td>
                                <td class="py-3 px-3 relative text-center">
                                    <!-- Dropdown Edit -->
                                    <div class="relative inline-block text-left">
                                        <button
                                            class="editBtn bg-[#120A81] hover:bg-blue-900 text-white text-sm font-semibold px-3 py-1 rounded-lg shadow">
                                            Edit
                                        </button>
                                    </div>

                                    <!-- Tombol Hapus -->
                                    <button
                                        class="hapusBtn bg-[#880719] hover:bg-[#a41e27] text-white text-sm font-semibold px-3 py-1 rounded-lg shadow ml-2">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- script js -->
            @push('scripts')
                <script src="{{ asset('js/usercard.js') }}"></script>
                <script src="{{ asset('js/edit-lapangan.js') }}"></script>
            @endpush
        @endsection
