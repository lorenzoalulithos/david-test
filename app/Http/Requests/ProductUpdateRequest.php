<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'color' => 'nullable|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
