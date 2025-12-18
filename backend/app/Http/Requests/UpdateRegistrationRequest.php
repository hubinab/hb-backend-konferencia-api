<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistrationRequest extends FormRequest
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
            'name' => ['required', 'string', 'between:1,40'],
            'vegetarian' => ['required', 'boolean'],
            'date' => ['required','date_format:Y-m-d'],
            'arrived' => ['nullable', 'date_format:H:i:s','after_or_equal:08:00:00','before_or_equal:14:00:00'],
        ];
    }
}
