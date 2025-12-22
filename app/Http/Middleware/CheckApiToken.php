<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckApiToken
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('token')) {
            return redirect()->route('login');
        }

        // Optional: ping API ringan
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get(config('services.api.url') . '/me');

        if ($response->status() === 401) {
            session()->flush();
            session()->invalidate();
            session()->regenerateToken();

            return redirect()->route('login')->with([
                'swal' => [
                    'icon' => 'warning',
                    'title' => 'Session Berakhir',
                    'text' => 'Silakan login kembali.'
                ]
            ]);
        }

        return $next($request);
    }
}
