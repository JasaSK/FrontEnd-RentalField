<?php

namespace App\Http\Controllers;

use App\Models\FakeUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    private $apiUrl;
    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
    }
    public function PageLogin()
    {
        return view('auth.login');
    }
    public function PageRegister()
    {
        return view('auth.register');
    }
    public function PageVerify(Request $request)
    {
        $email = $request->email ?? session('email');
        return view('auth.verify', compact('email'));
    }


    public function login(Request $request)
    {
        // 1. VALIDASI
        $validated = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);
        // dd($request->all());
        // 2. REQUEST KE API BACKEND
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post("{$this->apiUrl}/login");
        // dd($response->json());

        $data = $response->json();
        // dd($data);
        if ($response->successful() && $data['status'] === true) {
            $dataUser = $data['data'];

            // Simpan session
            session([
                'token' => $data['token'],
                'user' => $dataUser,
                'role' => $data['role'] ?? null,
            ]);

            $user = new User($dataUser);
            Auth::login($user);

            return redirect()->route('beranda.index')->with([
                'swal' => [
                    'icon' => 'success',
                    'title' => 'Login Berhasil!',
                    'text' => 'Selamat datang, ' . ($dataUser['name'] ?? 'User') . '!',
                    'timer' => 2000
                ]
            ]);
        }

        // 4. LOGIN GAGAL
        return back()->withErrors([
            'login' => $data['message'] ?? 'Email atau password salah!',
        ])->with([
            'swal' => [
                'icon' => 'error',
                'title' => 'Login Gagal!',
                'text' => $data['message'] ?? 'Email atau password salah!',
            ]
        ]);
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|min:10|max:15',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'no_telp.min' => 'Nomor telepon minimal 10 digit.',
            'no_telp.max' => 'Nomor telepon maksimal 15 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        try {
            $response = Http::post("{$this->apiUrl}/register", [
                'name' => $request->name,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'role' => 'user',
            ]);

            $data = $response->json();

            // Redirect ke halaman verifikasi, tanpa menyimpan session login
            if ($response->successful()) {

                session(['email' => $request->email]);
                return redirect()
                    ->route('PageVerify', ['email' => $request->email])
                    ->with(
                        [
                            'swal' => [
                                'icon' => 'success',
                                'title' => 'Registrasi Berhasil!',
                                'text' => $data['message'] ?? 'Silakan cek email Anda untuk kode verifikasi.',
                                'timer' => 3000
                            ]
                        ]
                    );
            } else {
                return back()->with([
                    'swal' => [
                        'icon' => 'error',
                        'title' => 'Registrasi Gagal!',
                        'text' => $data['message'] ?? 'Terjadi kesalahan saat registrasi.',
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Server tidak dapat dihubungi. Pastikan API aktif.');
        }
    }

    public function verify(Request $request)
    {

        $mergedCode = implode('', $request->code);

        $request->merge([
            'code' => $mergedCode
        ]);

        $request->validate([
            'email' => 'required|string|email',
            'code' => 'required|digits:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'code.required' => 'Kode verifikasi wajib diisi.',
            'code.digits' => 'Kode verifikasi harus 6 digit angka.',
        ]);

        // dd($request->all());
        try {
            $response = Http::post("{$this->apiUrl}/verify-code", [
                'email' => $request->email,
                'code' => $request->code,
            ]);

            // $data = $response->json();
            // dd($response->body(), $response->status());

            if ($response->successful()) {
                return back()->with('verified_success', 'Akun Anda telah terverifikasi.');
            } else {
                return back()->with([
                    'swal' => [
                        'icon' => 'error',
                        'title' => 'Verifikasi Gagal!',
                        'text' => $response->json()['message'] ?? 'Kode verifikasi salah atau kadaluarsa.',
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Server tidak dapat dihubungi. Pastikan API aktif.');
        }
    }

    public function resendCode()
    {
        $email = session('email'); // <-- ambil email dari session

        if (!$email) {
            return back()->with('error', 'Email tidak ditemukan di session. Silakan registrasi ulang.');
        }

        try {
            $response = Http::post("{$this->apiUrl}/resend-code", [
                'email' => $email,
            ]);

            $data = $response->json();

            if ($response->successful()) {
                return back()->with([
                    'swal' => [
                        'icon' => 'success',
                        'title' => 'Kode Terkirim!',
                        'text' => $data['message'] ?? 'Kode verifikasi telah dikirim ulang ke email Anda.',
                        'timer' => 3000
                    ]
                ]);
            } else {
                return back()->with([
                    'swal' => [
                        'icon' => 'error',
                        'title' => 'Gagal Mengirim Kode!',
                        'text' => $data['message'] ?? 'Terjadi kesalahan saat mengirim ulang kode verifikasi.',
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Server tidak dapat dihubungi. Pastikan API aktif.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with([
            'swal' => [
                'icon' => 'success',
                'title' => 'Logout Berhasil!',
                'text' => 'Anda telah berhasil logout.',
                'timer' => 3000
            ]
        ]);
    }
    public function PageForgotPassword()
    {
        return view('auth.forgotpassword');
    }

    public function ForgotPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email'
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.'
            ]
        );
        // dd($request->all());
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->post("{$this->apiUrl}/forgot-password", [
                'email' => $request->email
            ]);


            // dd($response->json());

            $data = $response->json();


            if (!$response->successful()) {
                return back()->with('error', 'Tunggu beberapa saat untuk mengirim ulang kode reset.');
            }

            session(['email' => $request->email]);
            return redirect()->route('verifyresetcode')->with('success', 'Kode reset dikirim.');
        } catch (\Exception $e) {
            return back()->with('error', 'Server API tidak merespon.');
        }
    }


    public function PageResetCode()
    {
        return view('auth.verifyresetcode');
    }

    public function VerifyResetCode(Request $request)
    {
        // Gabungkan array code[] → string
        $mergedCode = implode('', $request->reset_code);

        $request->merge([
            'reset_code' => $mergedCode
        ]);

        $request->validate(
            [
                'email' => 'required|email',
                'reset_code' => 'required|digits:6'
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'reset_code.required' => 'Kode reset wajib diisi.',
                'reset_code.digits' => 'Kode reset harus 6 digit angka.'
            ]
        );
        // dd($request->all());

        // try {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post("{$this->apiUrl}/verify-reset-code", [
            'email' => $request->email,
            'reset_code' => $request->reset_code,
        ]);

        $email = $request->email;

        Session::put('email', $email);
        Session::put('reset_code', $request->reset_code);
        Session::put('expires_at', Carbon::now()->addMinutes(10));

        if ($response->successful()) {
            return redirect()->route('resetpassword')->with('success', 'Kode verifikasi benar. Silakan atur ulang password Anda.');
        }
        return back()->with('error', 'Kode salah atau kadaluarsa.');
    }

    public function ResendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.'
        ]);


        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post("{$this->apiUrl}/forgot-password", [
            'email' => $request->email
        ]);


        if ($response->successful()) {
            return back()->with([
                'swal' => [
                    'icon' => 'success',
                    'title' => 'Kode Terkirim!',
                    'text' => $data['message'] ?? 'Kode verifikasi telah dikirim ulang ke email Anda.',
                    'timer' => 3000
                ]
            ]);
        } else {
            return back()->with([
                'swal' => [
                    'icon' => 'error',
                    'title' => 'Gagal Mengirim Kode!',
                    'text' => $data['message'] ?? 'Terjadi kesalahan saat mengirim ulang kode verifikasi.',
                ]
            ]);
        }

        return back()->with('success', 'Kode baru telah dikirim.');
    }

    public function PageResetPassword()
    {
        $expiresAt = session('expires_at');


        if (!$expiresAt) {
            return redirect()->route('forgotpassword')
                ->with('error', 'Silakan lakukan verifikasi kode terlebih dahulu.');
        }

        if (Carbon::now()->greaterThan(Carbon::parse($expiresAt))) {

            Session::forget('expires_at');
            Session::forget('email');

            return redirect()->route('forgotpassword')
                ->with('error', 'Waktu verifikasi sudah kadaluarsa. Silakan lakukan verifikasi ulang.');
        }
        return view('auth.resetpassword');
    }

    public function ResetPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed'
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 6 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.'
            ]
        );

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post("{$this->apiUrl}/reset-password", [
            'email' => $request->email,
            'reset_code' => $request->reset_code,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
        if (!$response->successful()) {
            return back()->with('error', 'Gagal mereset password.');
        }

        Session::forget(['email', 'reset_code', 'expires_at']);

        return redirect()->route('PageLogin')->with('success', 'Password berhasil direset.');
    }
}
