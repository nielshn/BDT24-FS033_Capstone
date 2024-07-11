<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['seller']);
    }

    public function rules(): array
    {
        return [
            'store_name' => ['required', 'string', 'max:255'],
            'categories_id' => ['required', 'integer', 'exists:categories,id'],
            'is_store_open' => ['required', 'boolean'],
        ];
    }
}
