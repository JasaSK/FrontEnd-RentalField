<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RefundController extends Controller
{

    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
    }


    public function index($id, Request $request)
    {
        $refundResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token')
        ])->get("{$this->apiUrl}/booking/{$id}");

        $bookingData = $refundResponse->json()['data'] ?? null;
        // Ambil code_booking saja
        $code_booking = [
            'code_booking' => $bookingData['code_booking'] ?? null,
            'total_price' => $bookingData['total_price'] ?? 0,
            'id' => $bookingData['id'] ?? 0,
        ];

        return view('beranda.refund', compact('code_booking'));
    }
    public function store(Request $request)
    {
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
        
        $request->validate([
            'booking_id' => 'required|integer',
            'refund_method' => 'required|string',
            'account_number' => 'required|string',
            'reason' => 'required|string',
        ], [
            'booking_id.required' => 'ID booking wajib diisi.',
            'booking_id.integer' => 'ID booking harus berupa angka.',
            'refund_method.required' => 'Metode refund wajib diisi.',
            'refund_method.string' => 'Metode refund harus berupa teks.',
            'account_number.required' => 'Nomor rekening wajib diisi.',
            'account_number.string' => 'Nomor rekening harus berupa teks.',
            'reason.required' => 'Alasan refund wajib diisi.',
            'reason.string' => 'Alasan refund harus berupa teks.',
        ]);
        // dd($request->all());

        $user = session('user');
        // Siapkan body untuk API
        $payload = [
            'user_id' => $user['id'] ?? null,
            'booking_id' => $request->booking_id,
            'amount_paid' => $request->amount_paid ?? 0, 
            'refund_method' => $request->refund_method,
            'account_number' => $request->account_number,
            'reason' => $request->reason,
        ];

        // Kirim request ke API
        $refundResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token')
        ])->post("{$this->apiUrl}/refund/request", $payload);

        if ($refundResponse->failed()) {
            return back()->with('error', 'Gagal membuat refund');
        }

        return redirect()->route('history.index')->with('success', 'Refund berhasil diajukan');
    }
}
