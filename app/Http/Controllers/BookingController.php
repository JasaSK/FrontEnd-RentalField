<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $fieldResponse = Http::get("{$this->apiUrl}/fields/{$fieldId}");
        // dd($fieldResponse);
        $field = $fieldResponse->successful() ? ($fieldResponse->json()['data'] ?? []) : [];
        if (!empty($field) && isset($field['image'])) {
            $field['image_url'] = "{$this->imgUrl}/storage/{$field['image']}";
        }

        $date = request()->get('date', now()->toDateString());

        // Tambahkan token jika API butuh autentikasi
        $bookingResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get("{$this->apiUrl}/bookings/booked-hours/{$fieldId}", [
            'date' => $date
        ]);

        $bookedHoursRaw = $bookingResponse->successful()
            ? ($bookingResponse->json()['booked_hours'] ?? [])
            : [];

        // Round booked hours ke jam penuh (misal 11:47 → 11:00)
        $bookedHours = array_map(function ($hour) {
            return Carbon::parse($hour)->format('H:00');
        }, $bookedHoursRaw);

        // Hilangkan duplikat dan urutkan
        $bookedHours = array_unique($bookedHours);
        sort($bookedHours);

        return view('beranda.booking', [
            'field'       => $field,
            'bookedHours' => $bookedHours,
            'date'        => $date,
        ]);
    }


    public function store(Request $request)
    {
        // dd(session('token'));


        if (!session('user') || !session('token')) {
            return redirect()->route('PageLogin')->with([
                'swal' => [
                    'icon'  => 'warning',
                    'title' => 'Login Diperlukan!',
                    'text'  => 'Silakan login terlebih dahulu untuk melakukan booking.',
                    'timer' => 3000
                ]
            ]);
        }
        $validated = $request->validate([
            'field_id'   => 'required|numeric',
            'date'       => 'required|date',
            'start_time' => 'required',
            'end_time'   => 'required',
            'user_id'    => 'required|numeric'
        ], [
            'field_id.required'   => 'Field ID harus diisi.',
            'date.required'       => 'Tanggal harus diisi.',
            'start_time.required' => 'Waktu mulai harus diisi.',
            'end_time.required'   => 'Waktu selesai harus diisi.',
            'user_id.required'    => 'User ID harus diisi.',
        ]);
        // dd($request->all());
        $response = Http::withHeaders([
            "accept" => "application/json",
            "Authorization" => "Bearer " . session('token')
        ])->withoutRedirecting()->post("{$this->apiUrl}/booking", $validated);
        // dd($response->body(), $response->status());
        if (!$response->successful()) {
            return back()->withErrors([
                'msg' => $response->json('message') ?? 'Booking gagal, silahkan coba lagi.'
            ]);
        }
        // dd($response->body(), $response->status());
        // dd("URL:", "{$this->apiUrl}/booking");

        // dd($response->json());
        $booking = $response->json('data');
        // dd($booking);


        if (isset($booking['field']['image'])) {
            $booking['field']['image_url'] = "{$this->imgUrl}/storage/{$booking['field']['image']}";
        }

        return redirect()->route(
            'beranda.bookingValidation',
            ['id' => $booking['id']],

        )->with('success', 'Booking berhasil dibuat!');
    }
}
