<?php

namespace App\Http\Requests\Information;

use Illuminate\Foundation\Http\FormRequest;

class StoreInformationRequest extends FormRequest
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
        return [
            'address' => 'required|min:5|max:255|string',
            'zip' => 'required|numeric',
            'city' => 'required|min:5|max:100|string',
            'province_id' => 'required|numeric|exists:provinces,id',
        ];
    }
}
