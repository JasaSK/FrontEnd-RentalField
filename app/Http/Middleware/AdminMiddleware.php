<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = session('user');

        // Kalau belum login sama sekali
        if (!$user) {
            return redirect()->route('PageLogin')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Kalau login tapi bukan admin
        if (isset($user['role']) && $user['role'] !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
