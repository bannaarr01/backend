<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FruitRequest extends FormRequest
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
            'name'=>'required|min:3'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'name is required field',
            'name.min' => 'name must be at least 3 characters',
            'name.max' => 'name cannot exceed 255 characters',
            'name.string' => 'name must be a string'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
