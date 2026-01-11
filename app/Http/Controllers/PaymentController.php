<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\BookingAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
    }

    public function paymentPage(BookingAuth $request, $booking_id)
    {

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
        if ($paymentResponse->failed()) {
            return back()->with('error', 'Gagal memuat data payment');
        }
        $paymentData = $paymentResponse->json()['data'];
        $qrisUrl = $paymentData['qris_url'] ?? null;
        $expiresAt = $paymentData['expires_at'] ?? null;
        return view('beranda.payment', [
            'booking' => $booking,
            'booking_id' => $booking_id,
            'qrisUrl' => $qrisUrl,
            'expiresAt' => $expiresAt,
            'apiUrl' => $this->apiUrl,
        ]);
    }

    public function create($booking_id)
    {
        if (!session('token')) {
            return redirect()->route('PageLogin')->with('error', 'Login diperlukan');
        }

        $paymentResponse = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->post("{$this->apiUrl}/payment/create-qris/{$booking_id}");

        if ($paymentResponse->failed()) {
            return back()->with('error', 'Gagal membuat QRIS Payment');
        }

        return redirect()->route('beranda.payment', ['id' => $booking_id])
            ->with(['success' => 'QRIS Payment berhasil dibuat! Silakan lanjutkan pembayaran.',]);
    }

    public function ajaxStatus($id)
    {
        $res = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->get("{$this->apiUrl}/booking/status/{$id}");
        return response()->json($res->json());
    }
}
