<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $categoryId = $this->route('category')->id;

        return [
            'name' => ['sometimes', 'required', 'string', 'between:3,60', "unique:categories,name,{$categoryId}"],
            'description' => ['sometimes', 'required', 'string'],
            'image_path' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1000000'],
        ];
    }
}
