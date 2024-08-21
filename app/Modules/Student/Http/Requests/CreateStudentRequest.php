<?php

namespace App\Modules\Student\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:students'],
            'dob' => ['required', 'date'],
            'monday' => ['sometimes', 'boolean'],
            'tuesday' => ['sometimes', 'boolean'],
            'wednesday' => ['sometimes', 'boolean'],
            'thursday' => ['sometimes', 'boolean'],
            'friday' => ['sometimes', 'boolean'],
            'saturday' => ['sometimes', 'boolean'],
            'sunday' => ['sometimes', 'boolean'],
        ];
    }
}
