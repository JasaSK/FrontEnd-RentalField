@extends('beranda.layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="max-w-[800px] mx-auto bg-white shadow-md rounded-2xl p-8 border border-gray-200">
            {{-- @if (session('email'))
                <p>Email Anda adalah: <strong>{{ session('email') }}</strong></p>
                <p>Email Anda adalah: <strong>{{ session('email_verified_at') }}</strong></p>
            @else
                <p>Email belum tersedia di session.</p>
            @endif --}}
            <h2 class="text-2xl font-bold text-center mb-6">Reset Password</h2>
            <p class="text-gray-600 text-center mb-6">
                Masukkan password baru kamu untuk mengganti password lama.
            </p>

            <form action="{{ route('resetpassword.post') }}" method="POST" id="myForm">
                @csrf

                {{-- Loader kecil --}}
                <div id="formLoader" class="hidden mb-4 text-center">
                    <span class="text-gray-600">Memproses...</span>
                </div>

                <input type="hidden" name="email" value="{{ session('email') }}">

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Password Baru</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Masukkan password baru" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Ulangi password baru" required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition-all">
                    Kirim
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
