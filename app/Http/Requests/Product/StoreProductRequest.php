<?php

namespace App\Http\Requests\Product;

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
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'currencyId' => 'required|integer',
            'categoryId' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1999'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'name required',
            'description.required' => 'description required',
            'price.required' => 'price required',
            'currency.required' => 'currency required',
            'category_id.required' => 'category_id required'
        ];
    }

}
