<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function PageLogin()
    {
        return view('beranda.login');
    }
    public function PageRegister()
    {
        return view('beranda.daftar');
    }

    public function  PageIndex()
    {
        return view('beranda.index');
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
        $response = Http::post('http://localhost:8001/api/login', [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        // 🔹 3. CEK HASIL DARI BACKEND
        if ($response->successful()) {
            $data = $response->json();

            // Simpan token ke session (atau cookie)
            session(['token' => $data['token'] ?? null]);
            session(['user' => $data['user'] ?? null]);

            return redirect()->route('PageIndex')->with('success', 'Login berhasil!');
        }

        // 🔹 4. JIKA LOGIN GAGAL
        return back()->withErrors([
            'login' => $response->json()['message'] ?? 'Email atau password salah!',
        ])->withInput();
    }
}
