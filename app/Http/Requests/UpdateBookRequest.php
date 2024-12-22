<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => 'sometimes|string|max:100',
            'author' => 'sometimes|string|max:50',
            'publisher' => 'sometimes|string|max:50',
            'category' => 'sometimes|string|max:20',
            'year' => 'sometimes|integer|digits:4',
            'stock' => 'sometimes|integer|min:0',
        ];
    }
}
