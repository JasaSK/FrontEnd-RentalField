<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetVerifyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    protected function prepareForValidation()
    {
        if (is_array($this->reset_code)) {
            $this->merge([
                'reset_code' => implode('', $this->reset_code),
            ]);
        }
    }
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'reset_code' => 'required|digits:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'reset_code.required' => 'Kode verifikasi wajib diisi.',
            'reset_code.digits' => 'Kode verifikasi harus 6 digit angka.',
        ];
    }
}
