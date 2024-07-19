<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderDetailRequest extends FormRequest
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
            'order_id' => ['required'],
            'menu_id' => ['required'],
            'quantity' => ['required', 'min:1']
        ];
    }

    public function messages()
    {
        return [

            'order_id.required' => 'order harus diisi!',
            'menu_id.required' => 'menu harus diisi!',
            'quantity.required' => 'quantity harus diisi!',
            'quantity.min' => 'quantity tidak boleh kurang dari 1!',
        ];
    }
}
