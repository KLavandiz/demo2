<?php

namespace App\Http\Requests\Product;

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
        return [
            'productId'=>'required|integer',
            'name'=>'nullable|string|min:3|max:50',
            'description'=>'nullable|string|min:3',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1999',
            'price' => 'nullable|integer',
            'currencyId' => 'nullable|integer',
            'categoryId' => 'nullable|integer',

        ];
    }

    public function messages(): array
    {
        return [
            'productId.required'=>'productId required',

        ];
    }
}
