<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductGaleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(
            ['seller', 'admin']
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'products_id' => 'required|exists:products,id',
            'photos' => 'sometimes|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
