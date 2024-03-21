<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
            'website_name' => ['required', 'max:200'],
            'layout' => ['required', 'max:200'],
            'contact_email' => ['email', 'required'],
            'currency_icon' => ['required', 'max:200'],
            'timezone' => ['required', 'max:200'],
        ];
    }
}
