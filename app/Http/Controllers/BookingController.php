<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    private string $apiUrl;
    private string $imgUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
        $this->imgUrl = config('services.api_image.url');
    }

    public function show($fieldId)
    {
        // Ambil detail field
        $fieldResponse = Http::get("{$this->apiUrl}/fields/{$fieldId}");
        $field = $fieldResponse->successful() ? ($fieldResponse->json()['data'] ?? []) : [];

        if (!empty($field) && isset($field['image'])) {
            $field['image_url'] = "{$this->imgUrl}/storage/{$field['image']}";
        }

        // Ambil daftar semua field
        $fieldsResponse = Http::get("{$this->apiUrl}/fields");
        $fields = $fieldsResponse->successful()
            ? ($fieldsResponse->json()['data'] ?? [])
            : [];

        return view('beranda.booking', [
            'fields'  => $fields,
            'field'   => $field,
            'booking' => []
        ]);
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('PageLogin')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $validated = $request->validate([
            'field_id'   => 'required|numeric',
            'date'       => 'required|date',
            'start_time' => 'required',
            'end_time'   => 'required',
            'user_id'    => 'required|numeric'
        ]);

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . session('token')
        ])->post("{$this->apiUrl}/booking", $validated);

        if (!$response->successful()) {
            return back()->withErrors([
                'msg' => $response->json('message') ?? 'Booking gagal, silahkan coba lagi.'
            ]);
        }

        $booking = $response->json('data');

        if (isset($booking['field']['image'])) {
            $booking['field']['image_url'] = "{$this->imgUrl}/storage/{$booking['field']['image']}";
        }

        return redirect()->route(
            'beranda.order-validation'
        )->with('success', 'Booking berhasil dibuat!');
    }


    public function cancel($bookingId)
    {
        $response = Http::delete("{$this->apiUrl}/booking/{$bookingId}");

        if ($response->successful()) {
            return redirect()->route('beranda.index')
                ->with('success', 'Booking berhasil dibatalkan.');
        }

        return back()->withErrors(['msg' => 'Gagal membatalkan booking.']);
    }

    public function history()
    {
        $userId = auth()->id();
        $response = Http::get("{$this->apiUrl}/booking?user_id={$userId}");

        $bookings = [];

        if ($response->successful()) {
            $bookings = $response->json()['data'] ?? [];

            // Format image url di setiap booking
            foreach ($bookings as &$booking) {
                if (!empty($booking['field']) && isset($booking['field']['image'])) {
                    $booking['field']['image_url'] = "{$this->imgUrl}/storage/{$booking['field']['image']}";
                }
            }
        }

        return view('beranda.booking_history', compact('bookings'));
    }
}
