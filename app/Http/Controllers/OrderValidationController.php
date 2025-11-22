<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderValidationController extends Controller
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
        // dd([
        //     'status' => $response->status(),
        //     'body' => $response->body(),
        //     'json' => $response->json()
        // ]);
        if ($response->failed()) {
            // fallback jika API gagal
            $booking = [];
            // bisa juga redirect dengan error
            // return redirect()->route('beranda.home')->with('error', 'Data booking tidak tersedia');
        } else {
            $booking = $response->json() ?? [];
        }

        if (!empty($booking['field']) && isset($booking['field']['image'])) {
            $booking['field']['image_url'] = "{$this->imgUrl}/storage/{$booking['field']['image']}";
        }

        return view('beranda.bookingValidation', compact('booking'));
    }
}
