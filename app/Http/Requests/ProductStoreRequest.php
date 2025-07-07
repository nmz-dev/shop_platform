<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            //

            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'pics' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|url',
            'types' => 'nullable|string',
            'colors' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
