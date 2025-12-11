@extends('beranda.layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="max-w-[800px] mx-auto bg-white shadow-md rounded-2xl p-8 border border-gray-200">

            <h2 class="text-2xl font-bold text-center mb-6">Forgot Password</h2>
            <p class="text-gray-600 text-center mb-6">
                Masukkan email kamu untuk menerima kode reset password.
            </p>

            <form action="{{ route('forgotpassword.post') }}" method="POST" id="myForm">
                @csrf

                {{-- Loader kecil untuk form --}}
                <div id="formLoader" class="hidden mb-4 text-center">
                    <span class="text-gray-600">Mengirim...</span>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Masukkan email" required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition-all">
                    Kirim kode Password
                </button>
            </form>

            <div class="text-center mt-6">
                <a href="{{ route('PageLogin') }}" class="text-[#BF0E26] hover:underline">
                    Kembali ke Login
                </a>
            </div>

        </div>
    </div>
@endsection
