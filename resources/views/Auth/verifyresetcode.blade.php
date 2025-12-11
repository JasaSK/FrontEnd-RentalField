<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Reset Password | EZFutsal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white flex flex-col items-center min-h-screen font-sans">
    {{-- @if (session('email'))
        <p>Email Anda adalah: <strong>{{ session('email') }}</strong></p>
    @else
        <p>Email belum tersedia di session.</p>
    @endif --}}
    <!-- Topbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-300">
        <div class="flex justify-start items-center px-6 md:px-12 py-3">
            <h1 class="text-2xl font-bold text-[#13810A]">EZFutsal</h1>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="flex flex-col justify-center items-center flex-grow w-full max-w-md px-6 pt-24 pb-10">
        <div class="w-full border border-gray-300 rounded-md shadow-md bg-white p-6">

            <h2 class="text-gray-800 text-lg font-semibold mb-3">Kode Reset Password Telah Dikirim!</h2>

            <p class="text-gray-700 text-sm mb-4 leading-relaxed">
                Kami mengirimkan kode verifikasi untuk reset password ke email Anda.
                Silakan masukkan kode 6 digit di bawah ini untuk melanjutkan proses pengaturan ulang kata sandi.
            </p>

            <!-- FORM VERIFIKASI KODE -->
            <form action="{{ route('verifyresetcode.post') }}" method="POST">
                @csrf

                <!-- Email tersembunyi -->
                <input type="hidden" name="email" value="{{ session('email') }}">

                <!-- Input Kode Verifikasi -->
                <div class="flex justify-center gap-3 mb-5">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1" name="reset_code[]" required
                            class="code-input w-10 h-10 sm:w-12 sm:h-12 bg-blue-500 text-white border border-blue-700 rounded-md text-center text-lg font-semibold focus:outline-none focus:ring-2 focus:ring-blue-700" />
                    @endfor
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition duration-200 mb-4">
                    Verifikasi Kode
                </button>
            </form>

            <!-- Peringatan -->
            <p class="text-red-600 text-sm font-semibold mb-4 text-center">
                Penting: Kode reset password hanya berlaku selama 10 menit.
                Jangan bagikan kode ini kepada siapa pun.
            </p>

            <!-- Kirim Ulang Kode -->
            <div class="text-center">
                <form action="{{ route('resetpassword.resend') }}" method="POST" id="formResendCodeForgot">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    <p id="statusPesanForgot" class="text-black font-semibold text-sm mb-2">
                        Tidak menerima kode?
                    </p>
                    <button type="submit" id="btnKirimUlangForgot"
                        class="bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-semibold py-2 px-4 rounded-md transition duration-200">
                        Kirim Ulang Kode
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/verifyresetcode.js') }}"></script>

</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('beranda.layouts.script')

</html>
