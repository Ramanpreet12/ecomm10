<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if(request()->isMethod('put')){
            return [
                'product_name' => 'required',
                'category_id' => 'required',
                'brand_id' => 'numeric',
                'product_code' => 'required',
                'product_price' => 'required|numeric',
                // 'product_color' => 'required',
                // 'family_color' => 'required',
                'product_discount' => 'nullable|numeric',

            ];
        }
        else{
            return [
                'product_name' => 'required',
                'category_id' => 'required',
                'brand_id' => 'numeric',
                'product_code' => 'required',
                'product_price' => 'required|numeric',
                // 'product_color' => 'required',
                // 'family_color' => 'required',
                'product_discount' => 'nullable|numeric',
                // 'product_images' => 'required'
            ];
        }

    }
}
