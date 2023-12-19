<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'category_name' => 'required|string|min:3|max:50'
        ];
    }

    public function messages(): array
    {
        return [
            'category_name.required' => 'category_name required',
            'category_name.string'=>'category_name need to be string',
            'category_name.min'=>'category_name minimum 3 chars'
        ];
    }
}
