<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:200'],
            'type' => ['string', 'max:200'],
            'starting_price' => ['max:200'],
            'button_url' => ['url'],
            'order' => ['required', 'integer'],
            'status' => ['required'],
            'image' => ['nullable', 'image', 'max:2000']
        ];
    }
}
