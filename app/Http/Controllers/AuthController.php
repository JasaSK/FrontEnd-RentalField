<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\EmailRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\VerifyRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post("{$this->apiUrl}/login", [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        $data = $response->json();
        if ($response->successful() && $data['status'] === true) {
            session([
                'token' => $data['token'],
                'user' => [
                    'id' => $data['data']['id'],
                    'name' => $data['data']['name'],
                    'email' => $data['data']['email'],
                ],
                'role' => $data['role'] ?? null,
            ]);

            return redirect()->route('beranda.index')->with([
                'swal' => [
                    'icon' => 'success',
                    'title' => 'Login Berhasil!',
                    'text' => 'Selamat datang, ' . ($dataUser['name'] ?? 'User') . '!',
                    'timer' => 2000
                ]
            ]);
        }

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

    public function register(RegisterRequest $request)
    {
        $request->validated();

        $response = Http::post("{$this->apiUrl}/register", [
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'role' => 'user',
        ]);

        $data = $response->json();

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
    }

    public function verify(VerifyRequest $request)
    {

        $mergedCode = implode('', $request->code);

        $request->merge([
            'code' => $mergedCode
        ]);

        $request->validated();

        $response = Http::post("{$this->apiUrl}/verify-code", [
            'email' => $request->email,
            'code' => $request->code,
        ]);

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
    }

    public function resendCode()
    {
        $email = session('email');

        if (!$email) {
            return back()->with('error', 'Email tidak ditemukan di session. Silakan registrasi ulang.');
        }

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
    }

    public function logout(Request $request)
    {
        if (session()->has('token')) {
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session('token'),
            ])->post("{$this->apiUrl}/logout");
        }

        $request->session()->flush();
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

    public function ForgotPassword(EmailRequest $request)
    {
        $request->validated();
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post("{$this->apiUrl}/forgot-password", [
            'email' => $request->email
        ]);

        $data = $response->json();
        if (!$response->successful()) {
            return back()->with('error', 'Tunggu beberapa saat untuk mengirim ulang kode reset.');
        }

        session(['email' => $request->email]);
        return redirect()->route('verifyresetcode')->with('success', 'Kode reset dikirim.');
    }


    public function PageResetCode()
    {
        return view('auth.verifyresetcode');
    }

    public function VerifyResetCode(VerifyRequest $request)
    {
        $mergedCode = implode('', $request->reset_code);

        $request->merge([
            'reset_code' => $mergedCode
        ]);

        $request->validated();

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

    public function ResendResetCode(EmailRequest $request)
    {
        $request->validated();

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

    public function ResetPassword(ResetPasswordRequest $request)
    {
        $request->validated();

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
