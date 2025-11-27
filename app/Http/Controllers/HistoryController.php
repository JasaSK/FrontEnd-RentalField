<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url'); // URL API backend
    }

    // Menampilkan halaman history semua booking user
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token')
        ])->get("{$this->apiUrl}/booking-history");
        // dd($response->json());
        if ($response->failed()) {
            return back()->with('error', 'Gagal mengambil riwayat pemesanan.');
        }

        $bookings = $response->json()['data'] ?? [];
        // dd($bookings);
        return view('beranda.history', compact('bookings'));
    }

    // Menampilkan halaman ticket (detail)
    public function show($id)
    {
        if (!session('token')) {
            return redirect()->route('PageLogin')->with('error', 'Login diperlukan');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token')
        ])->get("{$this->apiUrl}/ticket/{$id}");

        if ($response->failed()) {
            return back()->with('error', 'Gagal mengambil data tiket.');
        }

        $data = $response->json();

        return view('beranda.ticket', [
            'booking' => $data['booking'],
            'qrBase64' => $data['qrBase64'],
        ]);
    }
}
