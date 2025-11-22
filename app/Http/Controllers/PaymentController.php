<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    private $apiUrl;
    private $imgUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
        $this->imgUrl = config('services.api_image.url');
    }

    public function paymentPage($booking_id)
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

        return view('beranda.payment', [
            'booking' => $booking,
            'snapToken' => null,
            'booking_id' => $booking_id
        ]);
    }

    public function create($booking_id)
    {
        if (!session('token')) {
            return redirect()->route('PageLogin')->with('error', 'Login diperlukan');
        }

        $bookingResponse = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->get("{$this->apiUrl}/booking/{$booking_id}");

        if ($bookingResponse->failed()) {
            return back()->with('error', 'Gagal memuat data booking');
        }

        $booking = $bookingResponse->json();

        // SNAP PAYMENT
        $snapRes = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->post("{$this->apiUrl}/payment/create/{$booking_id}");

        $snapToken = $snapRes->json()['snap_token'] ?? null;
        if (!$snapToken) return back()->with('error', 'Token Snap kosong, pembayaran gagal dimuat.');

        // QRIS PAYMENT
        $qrisRes = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->post("{$this->apiUrl}/payment/create-qris/{$booking_id}");

        // Ambil url QR dari actions[0]
        $qrisUrl = $qrisRes->json()['actions'][0]['url'] ?? null;

        return view('beranda.payment', compact('booking', 'snapToken', 'qrisUrl', 'booking_id'));
    }

    public function getStatus($booking_id)
    {
        if (!session('token')) {
            return response()->json(['status' => 'error']);
        }

        $res = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->get("{$this->apiUrl}/booking/{$booking_id}");

        if ($res->failed()) {
            return response()->json(['status' => 'error']);
        }

        // Ambil status dari API, bisa 'pending' atau 'paid'
        return response()->json([
            'status' => $res->json()['status'] ?? 'pending'
        ]);
    }
}
