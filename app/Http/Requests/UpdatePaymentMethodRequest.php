<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentMethodRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('payment_methods', 'name')->ignore($this->payment_method->id)],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,nonactive']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Metode pembayaran harus diisi.',
            'name.string' => 'Metode pembayaran harus berupa teks.',
            'name.unique' => 'Metode pembayaran sudah ada.'
        ];
    }
}
