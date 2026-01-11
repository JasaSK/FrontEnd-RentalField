<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class BookingAuth extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
