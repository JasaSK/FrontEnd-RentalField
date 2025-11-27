<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
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
        $qrisUrl = $booking['qris_url'] ?? null;


        return view('beranda.payment', [
            'booking' => $booking,
            'booking_id' => $booking_id,
            'qrisUrl' => $qrisUrl
        ]);
    }

    public function create($booking_id)
    {
        if (!session('token')) {
            return redirect()->route('PageLogin')->with('error', 'Login diperlukan');
        }

        // Ambil booking
        $bookingResponse = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->get("{$this->apiUrl}/booking/{$booking_id}");

        if ($bookingResponse->failed()) {
            return back()->with('error', 'Gagal memuat data booking');
        }

        $booking = $bookingResponse->json();

        // QRIS PAYMENT ONLY
        $qrisRes = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->post("{$this->apiUrl}/payment/create-qris/{$booking_id}");

        if ($qrisRes->failed()) {
            return back()->with('error', 'Gagal membuat QRIS Payment');
        }

        // Ambil url QR dari actions[0]
        $qrisUrl = $qrisRes->json()['actions'][0]['url'] ?? null;
        if (!$qrisUrl) {
            return back()->with('error', 'URL QRIS tidak ditemukan.');
        }
        // session()->flash('success', 'QRIS Payment berhasil dibuat! Silakan lanjutkan pembayaran.');
        // return view('beranda.payment', compact('booking', 'qrisUrl', 'booking_id'));
        return redirect()->route('beranda.payment', ['id' => $booking_id])
            ->with([
                'success' => 'QRIS Payment berhasil dibuat! Silakan lanjutkan pembayaran.',
                'qrisUrl' => $qrisUrl
            ]);
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

        return response()->json([
            'status' => $res->json()['status'] ?? 'pending'
        ]);
    }
}
