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
        return in_array($this->user()->role, ['admin', 'vendor']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'subcategory' => ['nullable'],
            'child_category' => ['nullable'],
            'brand_id' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'video_url' => ['nullable'],
            'sku' => ['nullable'],
            'offer_price' => ['nullable'],
            'offer_start_date' => ['nullable'],
            'offer_end_date' => ['nullable'],
            'product_type' => ['nullable'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required']
        ];
    }
}
