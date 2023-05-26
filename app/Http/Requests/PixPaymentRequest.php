<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PixPaymentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'qrCode'            => 'required|array',
            'qrCode.payload'    => 'required|string',
            'value'             => 'required|numeric',
            'description'       => 'required|string',
            'scheduleDate'      => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'qrCode.payload.required' => 'O payload do QR Code é obrigatório',
        ];
    }
}
