<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kode | EZFutsal</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-white flex flex-col items-center min-h-screen font-sans">

    <!-- Topbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-300">
        <div class="flex justify-start items-center px-6 md:px-12 py-3">
            <h1 class="text-2xl font-bold text-[#13810A]">EZFutsal</h1>
        </div>
    </nav>

    <!-- Konten -->
    <div class="flex flex-col justify-center items-center flex-grow w-full max-w-md px-6 pt-24 pb-10">
        <div class="w-full border border-gray-300 rounded-md shadow-md bg-white p-6">

            <h2 class="text-gray-800 text-lg font-semibold mb-3">Kode telah dikirimkan!</h2>

            <p class="text-gray-700 text-sm mb-4 leading-relaxed">
                Kami telah mengirimkan kode verifikasi 6 digit ke alamat email Anda.
                Silakan masukkan kode tersebut di bawah ini untuk melanjutkan pengaturan ulang kata sandi Anda.
            </p>
            <form action="{{ route('Verify') }}" method="POST">
                @csrf

                <!-- Email tersembunyi -->
                <input type="hidden" name="email" value="{{ session('email') }}">

                <!-- Input Kode Verifikasi -->
                <div class="flex justify-center gap-3 mb-5">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1" name="code[]"
                            class="code-input w-10 h-10 sm:w-12 sm:h-12 bg-[#13810A9E] text-white border border-[#13810A] rounded-md text-center text-lg font-semibold focus:outline-none focus:ring-2 focus:ring-[#0f6d09]" />
                    @endfor
                </div>

                <button type="submit"
                    class="w-full bg-[#13810A] hover:bg-[#0f6d09] text-white font-semibold py-2 rounded-md transition duration-200 mb-4">
                    Verifikasi
                </button>
            </form>


            <!-- Peringatan -->
            <p class="text-red-600 text-sm font-semibold mb-4 text-center">
                Penting: Kode ini hanya berlaku selama 10 menit. Jangan bagikan kode ini kepada siapa pun.
            </p>

            <!-- Kirim Ulang -->
            <div class="text-center">
                <form action="{{ route('ResendCode') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    <p id="statusPesan" class="text-black font-semibold text-sm mb-2">
                        Tidak menerima kode?
                    </p>
                    <button type="submit" id="btnKirimUlang"
                        class="bg-[#13810A] hover:bg-[#0f6d09] text-white text-sm font-semibold py-2 px-4 rounded-md transition duration-200">
                        Kirim Ulang Kode
                    </button>

                </form>
            </div>
            <!-- script -->
            <script src="{{ asset('js/verifikasi.js') }}"></script>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('beranda.layouts.script')


</html>
