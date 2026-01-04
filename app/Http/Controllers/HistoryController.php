<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{
    private $apiUrl;
    private $imgUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
        $this->imgUrl = config('services.api_image.url');
    }

    // Menampilkan halaman history semua booking user
    public function index()
    {
        $bookingResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept'        => 'application/json'
        ])->get("{$this->apiUrl}/booking-history");

        $bookings = $bookingResponse->successful()
            ? ($bookingResponse->json()['data'] ?? [])
            : [];

        foreach ($bookings as &$booking) {
            if (!empty($booking['field']['image'])) {
                $booking['field']['image_url'] =
                    "{$this->imgUrl}/storage/{$booking['field']['image']}";
            } else {
                $booking['field']['image_url'] = null;
            }

            if (!empty($booking['refunds'][0]['proof'])) {
                $booking['refunds'][0]['proof_url'] =
                    "{$this->imgUrl}/storage/{$booking['refunds'][0]['proof']}";
            }
        }
        unset($booking);

        $approvedCount = collect($bookings)->where('status', 'approved')->count();
        $pendingCount  = collect($bookings)->where('status', 'pending')->count();

        return view('beranda.history', compact(
            'bookings',
            'approvedCount',
            'pendingCount'
        ));
    }
}
