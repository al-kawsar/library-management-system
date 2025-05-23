<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'author' => 'required|string|max:50',
            'publisher' => 'required|string|max:50',
            'category' => 'required|string|max:20',
            'year' => 'required|integer|digits:4',
            'stock' => 'required|integer|min:0',
        ];
    }
}
