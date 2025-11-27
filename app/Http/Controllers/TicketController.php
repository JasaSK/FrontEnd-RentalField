<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TicketController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url'); // URL API backend
    }

    public function show($id)
    {
        // Pastikan user login
        if (!session('token')) {
            return redirect()->route('PageLogin')->with('error', 'Login diperlukan');
        }

        // Panggil API backend untuk data booking + QR
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token')
        ])->get("{$this->apiUrl}/ticket/{$id}");

        if ($response->failed()) {
            return back()->with('error', 'Gagal mengambil data tiket.');
        }

        $data = $response->json();

        return view('beranda.ticket', [
            'booking' => $data['booking'],
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
