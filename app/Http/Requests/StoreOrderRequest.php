<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            // 'customer_id' => ['required'],
            // 'method_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'Customer field required.',
            'method_id.required' => 'Payment field required.'
        ];
    }
}
