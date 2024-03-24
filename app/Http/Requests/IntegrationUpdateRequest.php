<?php

namespace App\Http\Requests;

use App\Enums\Marketplace;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class IntegrationUpdateRequest extends FormRequest
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
    public function rules(): array {
        return [
            'marketplace' => ['required', new Enum(Marketplace::class)],
            'username'    => ['nullable', 'string'],
            'password'    => ['nullable', 'string']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array {
        return [
            'marketplace.required' => 'Marketplace is required',
            'marketplace.enum'     => 'Marketplace is invalid ',
            'username.string'      => 'Username must be a string',
            'password.string'      => 'Password must be a string'
        ];
    }
}
