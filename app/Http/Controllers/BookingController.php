<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\BookingRequest;
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
        $field = $fieldResponse->successful()
            ? ($fieldResponse->json()['data'] ?? [])
            : [];

        if (!empty($field) && isset($field['image'])) {
            $field['image_url'] = "{$this->imgUrl}/storage/{$field['image']}";
        }

        $date = request()->get('date', now()->toDateString());

        // ===== SCHEDULE / MAINTENANCE =====
        $scheduleResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$this->apiUrl}/schedule/{$fieldId}", [
            'date' => $date
        ]);

        $schedule = $scheduleResponse->successful()
            ? ($scheduleResponse->json()['data'] ?? [])
            : [];

        // ===== CONVERT TO MAINTENANCE HOURS =====
        $maintenanceHours = [];

        foreach ($schedule as $item) {

            if ($item['date'] !== $date) {
                continue;
            }

            $start = Carbon::parse($item['date'] . ' ' . $item['start_time']);
            $end   = Carbon::parse($item['date'] . ' ' . $item['end_time']);

            while ($start < $end) {
                $maintenanceHours[] = $start->format('H:00');
                $start->addHour();
            }
        }

        $maintenanceHours = array_unique($maintenanceHours);
        sort($maintenanceHours);

        // ===== BOOKED HOURS =====
        $bookingResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get("{$this->apiUrl}/bookings/booked-hours/{$fieldId}", [
            'date' => $date
        ]);

        $bookedHoursRaw = $bookingResponse->successful()
            ? ($bookingResponse->json()['booked_hours'] ?? [])
            : [];

        $bookedHours = array_map(function ($hour) {
            return Carbon::parse($hour)->format('H:00');
        }, $bookedHoursRaw);

        $bookedHours = array_unique($bookedHours);
        sort($bookedHours);

        return view('beranda.booking', [
            'field'            => $field,
            'bookedHours'      => $bookedHours,
            'maintenanceHours' => $maintenanceHours,
            'date'             => $date,
            'schedules'        => $schedule
        ]);
    }


    public function store(BookingRequest $request)
    {
        $validated = $request->validated();
        $response = Http::withHeaders([
            "accept" => "application/json",
            "Authorization" => "Bearer " . session('token')
        ])->withoutRedirecting()->post("{$this->apiUrl}/booking", $validated);
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
            'beranda.bookingValidation',
            ['id' => $booking['id']],

        )->with('success', 'Booking berhasil dibuat!');
    }
}
