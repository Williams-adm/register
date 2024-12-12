<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $productId = $this->route('product')->id;
        return [
            'name' => ['sometimes', 'required', 'string', 'between:3,60', "unique:products,name,{$productId}"],
            'description' => ['sometimes', 'required', 'string'],
            "price" => ['sometimes', 'required', 'numeric', 'decimal:2'],
            "stock" => ['sometimes', 'required', 'numeric', 'min:1'],
            'discount' => ['sometimes', 'required', 'numeric', 'decimal:2', 'max:4'],
            'photo_path' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1000000'],
            'category_id' => ['sometimes', 'required', 'exists:categories,id', 'numeric'],
        ];
    }
}
