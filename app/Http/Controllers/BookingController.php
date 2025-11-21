<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        ], [
            'field_id.required'   => 'Field wajib dipilih.',
            'field_id.numeric'    => 'Field tidak valid.',
            'date.required'       => 'Tanggal wajib dipilih.',
            'date.date'           => 'Tanggal tidak valid.',
            'start_time.required' => 'Jam mulai wajib diisi.',
            'end_time.required'   => 'Jam selesai wajib diisi.',
            'user_id.required'    => 'User wajib dipilih.',
            'user_id.numeric'     => 'User tidak valid.',
        ]);

        $response = Http::post("{$this->apiUrl}/bookings", $validated);

        if (!$response->successful()) {
            return back()->withErrors(['msg' => 'Booking gagal, silahkan coba lagi.']);
        }

        // Ambil hasil booking
        $booking = $response->json()['data'] ?? [];

        // Tambahkan image_url pada field
        if (!empty($booking['field']) && isset($booking['field']['image'])) {
            $booking['field']['image_url'] = "{$this->imgUrl}/storage/{$booking['field']['image']}";
        }

        // Ambil list fields untuk dropdown
        $fieldsResponse = Http::get("{$this->apiUrl}/fields");
        $fields = $fieldsResponse->successful()
            ? ($fieldsResponse->json()['data'] ?? [])
            : [];

        return view('beranda.booking', [
            'fields'  => $fields,
            'field'   => $booking['field'],
            'booking' => $booking
        ])->with('success', 'Booking berhasil dibuat!');
    }

    public function cancel($bookingId)
    {
        $response = Http::delete("{$this->apiUrl}/bookings/{$bookingId}");

        if ($response->successful()) {
            return redirect()->route('beranda.index')
                ->with('success', 'Booking berhasil dibatalkan.');
        }

        return back()->withErrors(['msg' => 'Gagal membatalkan booking.']);
    }

    public function history()
    {
        $userId = auth()->id();
        $response = Http::get("{$this->apiUrl}/bookings?user_id={$userId}");

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
