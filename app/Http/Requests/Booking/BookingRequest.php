<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return session()->has('user') && session()->has('token');
    }


    protected function failedAuthorization()
    {
        abort(
            redirect()
                ->route('PageLogin')
                ->with([
                    'swal' => [
                        'icon'  => 'warning',
                        'title' => 'Login Diperlukan!',
                        'text'  => 'Silakan login terlebih dahulu untuk melakukan booking.',
                        'timer' => 3000,
                    ],
                ])
        );
    }
    public function rules(): array
    {
        return [
            'field_id'   => 'required|numeric',
            'date'       => 'required|date',
            'start_time' => 'required',
            'end_time'   => 'required',
            'user_id'    => 'required|numeric'
        ];
    }
    public function messages(): array
    {
        return
            [
                'field_id.required'   => 'Field ID harus diisi.',
                'date.required'       => 'Tanggal harus diisi.',
                'start_time.required' => 'Waktu mulai harus diisi.',
                'end_time.required'   => 'Waktu selesai harus diisi.',
                'user_id.required'    => 'User ID harus diisi.',
            ];
    }
}
