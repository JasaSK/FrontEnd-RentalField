@extends('admin.layouts.master')

@section('content')
    <p>Token: {{ session('token') }}</p>
    <!-- Konten -->
    <h1 class="text-3xl font-bold text-gray-800 mb-3">Info Galeri</h1>
    <div class="p-3 flex-1">

        <!-- Wrapper utama untuk atur lebar -->
        <div class="mx-auto w-[97%] max-w-[1500px] space-y-6 mb-6">

            <!-- Card Upload Galeri -->
            <div class="bg-white border border-gray-200 shadow-md rounded-xl p-6 mt-8">
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- CSRF Token -->

                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Upload Galeri Baru</h3>

                    <!-- Nama Gambar -->
                    <label class="block text-gray-700 font-medium mb-2" for="name">Nama Gambar</label>
                    <input type="text" name="name" id="name" placeholder="Nama Gambar"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#880719] mb-4"
                        value="{{ old('name') }}" />

                    <!-- Deskripsi Gambar -->
                    <label class="block text-gray-700 font-medium mb-2" for="description">Deskripsi Gambar</label>
                    <input type="text" name="description" id="description" placeholder="Deskripsi Gambar"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#880719] mb-4"
                        value="{{ old('description') }}" />

                    <!-- Dropdown Kategori -->
                    <label class="block text-gray-700 font-medium mb-2" for="category_gallery_id">Kategori</label>
                    <select name="category_gallery_id" id="category_gallery_id"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full mb-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#13810A]">
                        <option value="" disabled selected>Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}"
                                {{ old('category_gallery_id') == $category['id'] ? 'selected' : '' }}>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Upload Gambar -->
                    <label class="block text-gray-700 font-medium mb-2" for="image">Upload Gambar Galeri</label>
                    <input type="file" name="image" id="image"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#880719] mb-4" />

                    <button type="submit"
                        class="bg-[#880719] hover:bg-[#a41e27] text-white font-semibold px-5 py-2 rounded-lg shadow-md">
                        Upload Galeri
                    </button>
                </form>

            </div>

            <!-- Card Daftar Galeri -->
            <div class="bg-white border border-gray-200 shadow-md rounded-xl p-6 mt-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Daftar Galeri</h3>

                <table class="w-full border-collapse">
                    <thead class="text-center bg-gray-100">
                        <tr class="border-b border-gray-300">
                            <th class="py-3 px-2">No</th>
                            <th class="py-3 px-2">Gambar</th>
                            <th class="py-3 px-2">Nama</th>
                            <th class="py-3 px-2">Deskripsi</th>
                            <th class="py-3 px-2">Tanggal Upload</th>
                            <th class="py-3 px-2">Kategori</th>
                            <th class="py-3 px-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700 text-center">
                        <!-- Baris 1 -->
                        @foreach ($galleries as $data)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                <td class="py-3 px-2">1</td>
                                <td class="py-3 px-2">
                                    <div class="flex items-center justify-center">
                                        <img src="{{ $data['image'] }}" alt="Fasilitas"
                                            class="w-20 h-14 object-cover rounded-md shadow">
                                    </div>
                                </td>

                                </td>
                                <td class="py-3 px-2 kategori">
                                    {{ $data['name'] }}
                                </td>
                                <td class="py-3 px-2 kategori">
                                    {{ $data['description'] }}
                                </td>
                                <td class="py-3 px-2"> {{ \Carbon\Carbon::parse($data['created_at'])->format('d M Y') }}
                                <td class="py-3 px-2 kategori">
                                    {{ $data['category_gallery']['name'] ?? 'Tidak ada kategori' }}
                                </td>
                                <td class="py-3 px-2 relative">
                                    <!-- Dropdown Edit -->
                                    <div class="relative inline-block text-left">
                                        <button
                                            class="editBtn bg-[#120A81] hover:bg-blue-900 text-white text-sm font-semibold px-3 py-1 rounded-lg shadow">
                                            Edit
                                        </button>
                                        <div
                                            class="dropdown hidden absolute z-10 right-0 mt-2 w-28 bg-white border border-gray-200 rounded-lg shadow-lg">
                                            <button
                                                class="dropdown-item block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                data-kategori="Fasilitas">Fasilitas</button>
                                            <button
                                                class="dropdown-item block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                data-kategori="Lapangan">Lapangan</button>
                                        </div>
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
                <script src="{{ asset('js/edit-galeri.js') }}"></script>
            @endpush
        @endsection
