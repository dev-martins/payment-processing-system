<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardPaymentRequest extends FormRequest
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
            'billingType'  => 'required|string',
            'creditCard'  => 'required|array',
            'creditCard.holderName'  => 'required|string',
            'creditCard.number'  => 'required|string',
            'creditCard.expiryMonth'  => 'required|string',
            'creditCard.expiryYear'  => 'required|string',
            'creditCard.ccv'  => 'required|string',
            'creditCardHolderInfo'  => 'required|array',
            'creditCardHolderInfo.name'  => 'required|string',
            'creditCardHolderInfo.email'  => 'required|email',
            'creditCardHolderInfo.cpfCnpj'  => 'required|string',
            'creditCardHolderInfo.postalCode'  => 'required|string',
            'creditCardHolderInfo.addressNumber'  => 'required|int',
            'creditCardHolderInfo.mobilePhone'  => 'required|string',
            'dueDate'  => 'required|date',
            'value'  => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }

    public function messages()
    {
        return [
            'creditCard.holderName.required' => 'O Nome do titular é obrigatório',
            'creditCard.holderName.string' => 'O Nome do titular deve ser do tipo string',
            'creditCard.number.required' => 'O Número é obrigatório',
            'creditCard.number.string' => 'O Número deve ser do tipo string',
            'creditCard.expiryMonth.required' => 'O Mês de expiração obrigatório',
            'creditCard.expiryMonth.string' => 'O Mês de expiração deve ser do tipo string',
            'creditCard.expiryYear.required' => 'O Ano de expiração obrigatório',
            'creditCard.expiryYear.string' => 'O Ano de expiração deve ser do tipo string',
            'creditCard.ccv.required' => 'O Código de verificação de expiração obrigatório',
            'creditCard.ccv.string' => 'O Código de verificação de expiração deve ser do tipo string',
            'creditCard.creditCardHolderInfo.required' => 'As informações do titular são obrigatórias',
            'creditCard.creditCardHolderInfo.string' => 'As informações do titular deve ser do tipo array',
            'creditCardHolderInfo.name.required' => 'O nome do titular é obrigatório',
            'creditCardHolderInfo.name.string' => 'O nome do titular deve ser do tipo string',
            'creditCardHolderInfo.email.required' => 'O Email do titular é obrigatório',
            'creditCardHolderInfo.email.email' => 'O Email do titular deve ser um email válido',
            'creditCardHolderInfo.cpfCnpj.required' => 'O CPFCNPJ do titular é obrigatório',
            'creditCardHolderInfo.cpfCnpj.string' => 'O CPFCNPJ do titular deve ser do tipo string',
            'creditCardHolderInfo.postalCode.required' => 'O CEP do titular é obrigatório',
            'creditCardHolderInfo.postalCode.string' => 'O CEP do titular deve ser do tipo string',
            'creditCardHolderInfo.addressNumber.required' => 'O Número do endereço do titular é obrigatório',
            'creditCardHolderInfo.addressNumber.string' => 'O Número do endereço do titular deve ser do tipo string',
            'creditCardHolderInfo.mobilePhone.required' => 'O Celular do titular é obrigatório',
            'creditCardHolderInfo.mobilePhone.string' => 'O Celular do titular deve ser do tipo string',
            'creditCardHolderInfo.dueDate.required' => 'A Data de vencimento é obrigatória',
            'creditCardHolderInfo.dueDate.string' => 'A Data de vencimento deve ser do tipo date',
            'creditCardHolderInfo.value.required' => 'O Valor é obrigatório',
            'creditCardHolderInfo.value.string' => 'O Valor deve ser do tipo float',
        ];
    }
}
