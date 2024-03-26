<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, ['admin', 'vendor', 'user']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'max:200'],
            'country' => ['required', 'max:200'],
            'state' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip_code' => ['required', 'max:200'],
            'street' => ['required', 'max:200']
        ];
    }
}
