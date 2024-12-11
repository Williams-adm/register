<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'between:3,60', 'unique:products,name'],
            'description' => ['required', 'string'],
            "price" => ['required', 'numeric', 'decimal:2'],
            "stock" => ['required', 'numeric', 'min:1'],
            'discount' => ['required', 'numeric', 'decimal:2', 'max:4'],
            'photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1000000'],
            'category_id' => ['required', 'exists:categories,id', 'numeric'],
        ];
    }
}
