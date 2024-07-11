<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTableRequest extends FormRequest
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
            'table_number' => [
                'required',
                'min:1',
                'numeric',
                Rule::unique('tables')->ignore($this->table)
            ],
            'capacity' => 'required|numeric|min:1|max:10',
            'status' => 'required|string|in:available,occupied,reserved'
        ];
    }
}
