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
        $bookingResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token')
        ])->get("{$this->apiUrl}/booking-history");
        // dd($bookingResponse->json());
        // dd($bookingResponse->json());
        // dd($bookingResponse->json());
        $bookings = ($bookingResponse->status() === 200) ? $bookingResponse->json()['data'] ?? [] : [];
        $approvedCount = collect($bookings)->where('status', 'approved')->count();
        $pendingCount = collect($bookings)->where('status', 'pending')->count();
        // dd($bookings);
        // $refundResponse = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . session('token')
        // ])->get("{$this->apiUrl}/refund/user");

        // $refunds = ($refundResponse->status() === 200) ? $refundResponse->json()['data'] ?? [] : [];

        // foreach ($bookings as &$booking) {
        //     $booking['refund'] = null;
        //     foreach ($refunds as $refund) {
        //         if ($refund['booking_id'] == $booking['id']) {
        //             $booking['refund'] = $refund;
        //             break;
        //         }
        //     }
        // }

        return view('beranda.history', compact('bookings', 'approvedCount', 'pendingCount'));
    }

    // Menampilkan halaman ticket (detail)
    // public function show($id)
    // {
    //     if (!session('token')) {
    //         return redirect()->route('PageLogin')->with('error', 'Login diperlukan');
    //     }

    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . session('token')
    //     ])->get("{$this->apiUrl}/ticket/{$id}");
    //     dd($response);
    //     if ($response->failed()) {
    //         return back()->with('error', 'Gagal mengambil data tiket.');
    //     }

    //     $data = $response->json();

    //     return view('beranda.ticket', [
    //         'booking' => $data['booking'],
    //         'qrBase64' => $data['qrBase64'],
    //     ]);
    // }
}
