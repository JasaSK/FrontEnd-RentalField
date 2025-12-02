<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookingValidationController extends Controller
{
    private string $apiUrl;
    private string $imgUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
        $this->imgUrl = config('services.api_image.url');
    }
    public function show($id)
    {
        // pastikan user login
        if (!session('token')) {
            return redirect()->route('PageLogin')->with('error', 'Login diperlukan');
        }

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->get("{$this->apiUrl}/booking/{$id}");

        $data = $response->json();

        // Pastikan API mengembalikan data booking
        if (!isset($data['data'])) {
            return back()->with('error', 'Format data booking tidak valid.');
        }

        // Ambil data booking asli
        $booking = $data['data'];

        // Cek apakah field & image ada
        if (isset($booking['field']) && isset($booking['field']['image'])) {
            $booking['field']['image_url'] = "{$this->imgUrl}/storage/{$booking['field']['image']}";
        }

        return view('beranda.bookingValidation', compact('booking'));
    }


    public function cancel($id)
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->delete("{$this->apiUrl}/booking/{$id}");

        if ($response->successful()) {
            return redirect()->route('beranda.index')->with('success', 'Booking berhasil dibatalkan.');
        }

        return back()->withErrors(['msg' => 'Gagal membatalkan booking. Silakan coba lagi.']);
    }
}
