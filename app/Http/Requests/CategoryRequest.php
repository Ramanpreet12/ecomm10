<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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

          if (request()->isMethod('put')) {
            $category_id = request()->segment(3);
            return [
                'category_name' => 'required',
                'url' => ['required', Rule::unique('categories')->ignore($category_id)],
            ];
        }

        return [
            'category_name' => 'required',
            'parent_id' => 'required',
            'category_image' => 'nullable',
            'category_discount' => 'numeric',
            'url' => 'required|unique:categories,url',
        ];
    }
}
