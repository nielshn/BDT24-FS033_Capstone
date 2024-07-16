<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['customer', 'seller']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'address_one' => 'required|string',
            'address_two' => 'nullable|string',
            'provinces_id' => 'required|integer',
            'regencies_id' => 'required|integer',
            'zip_code' => 'required|integer',
            'country' => 'required|string',
            'phone_number' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
        ];
    }
}
