<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|max:3000',
            'image' => ['file', 'mimes:png,jpg,jpeg,webp', 'max:4048', $this->method() == "PUT" ? 'nullable' : 'required'],
            'category_id' => 'required|numeric'
        ];
    }
}
