<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoletoPaymentRequest extends FormRequest
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
            'identificationField'  => 'required',
            'scheduleDate'         => 'required|date',
            'description'          => 'string|min:10',
            'dueDate'              => 'required|date',
            'value'                => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }
}
