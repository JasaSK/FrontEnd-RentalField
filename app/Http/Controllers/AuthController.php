<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8001/api';
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
        $email = $request->query('email');
        return view('auth.verify', compact('email'));
    }

    public function login(Request $request)
    {
        // 🔹 1. VALIDASI INPUT
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        // 🔹 2. KIRIM DATA KE API BACKEND
        $response = Http::post("{$this->apiUrl}/login", [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        // 🔹 3. CEK HASIL DARI BACKEND
        if ($response->successful()) {
            $data = $response->json();

            // Simpan token ke session (atau cookie)
            session(['token' => $data['token'] ?? null]);
            session(['user' => $data['user'] ?? null]);

            return redirect()->back()->with('success', 'Login berhasil!');
        }

        // 🔹 4. JIKA LOGIN GAGAL
        return back()->withErrors([
            'login' => $response->json()['message'] ?? 'Email atau password salah!',
        ])->with('error', 'Email atau password salah!');
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

            if ($response->successful()) {
                // Redirect ke halaman verifikasi, tanpa menyimpan session login
                if ($response->successful()) {
                    return back()
                        ->with('success', $data['message'] ?? 'Registrasi berhasil, silakan verifikasi email Anda.')
                        ->with('email', $request->email);
                }
            } else {
                return back()->with('error', $data['message'] ?? 'Terjadi kesalahan saat registrasi.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Server tidak dapat dihubungi. Pastikan API aktif.');
        }
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'code' => 'required|digits:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'code.required' => 'Kode verifikasi wajib diisi.',
            'code.digits' => 'Kode verifikasi harus 6 digit angka.',
        ]);

        try {
            $response = Http::post("{$this->apiUrl}/verify", [
                'email' => $request->email,
                'code' => $request->code,
            ]);

            $data = $response->json();

            if ($response->successful()) {
                return back()->with('verified_success', $data['message'] ?? 'Verifikasi berhasil!');
            } else {
                return back()->with('error', $data['message'] ?? 'Kode verifikasi salah atau kadaluarsa.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Server tidak dapat dihubungi. Pastikan API aktif.');
        }
    }
}
