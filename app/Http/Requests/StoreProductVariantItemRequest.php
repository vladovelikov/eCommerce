<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductVariantItemRequest extends FormRequest
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
            'variant_id' => ['integer', 'required'],
            'item_name' => ['required', 'max:200'],
            'price' => ['regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ];
    }
}
