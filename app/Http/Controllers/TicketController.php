<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Ticket;

class TicketController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url'); // URL API backend
    }

    public function show($booking_id)
    {
        // Pastikan user login
        if (!session('token')) {
            return redirect()->route('PageLogin')->with('error', 'Login diperlukan');
        }

        // Panggil API backend untuk data booking + QR
        $ticketResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$this->apiUrl}/ticket/{$booking_id}");
        // dd($ticketResponse);
        if ($ticketResponse->failed()) {
            return back()->with('error', 'Gagal mengambil data tiket.');
        }
        $data = $ticketResponse->json()['data'];
        // dd($data);
        // $qrBase64 = $data['qrBase64'] ?? null;
        // $booking  = $data['booking'] ?? null;
        return view('beranda.ticket', [
            'ticket'   => $data['ticket'],
            'booking'  => $data['ticket']['booking'],
            'qrBase64' => $data['qrBase64'],
        ]);
    }

    public function download($bookingId)
    {
        // Panggil endpoint backend untuk download PDF
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token')
        ])->get("{$this->apiUrl}/booking/{$bookingId}/ticket");

        if ($response->failed()) {
            return back()->with('error', 'Gagal mengunduh tiket.');
        }

        $pdfContent = $response->body();
        $fileName = "ticket-{$bookingId}.pdf";

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename={$fileName}"
        ]);
    }
}
