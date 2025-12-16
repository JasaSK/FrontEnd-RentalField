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
    public function show($booking_id)
    {
        if (!session('token')) {
            return redirect()->route('PageLogin')->with('error', 'Login diperlukan');
        }

        // Ambil detail booking
        $bookingResponse = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->get("{$this->apiUrl}/booking/{$booking_id}");

        if ($bookingResponse->failed()) {
            return back()->with('error', 'Gagal memuat data booking');
        }
        $booking = $bookingResponse->json();
        $booking = $booking['data'];

        $paymentResponse = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->get("{$this->apiUrl}/payment/{$booking_id}");
        // dd($paymentResponse->json());
        if ($paymentResponse->failed()) {
            return back()->with('error', 'Gagal memuat data payment');
        }
        $paymentData = $paymentResponse->json()['data'];
        $qrisUrl = $paymentData['qris_url'] ?? null;
        $expiresAt = $paymentData['expires_at'] ?? null;
        // dd($qrisUrl);
        return view('beranda.bookingValidation', [
            'booking' => $booking,
            'booking_id' => $booking_id,
            'qrisUrl' => $qrisUrl,
            'expiresAt' => $expiresAt,
            'apiUrl' => $this->apiUrl,
        ]);
    }

    public function paymentPage($booking_id) {}
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
