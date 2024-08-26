<?php

namespace App\Modules\Report\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateReportRequest extends FormRequest
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
            'student_id' => ['required', 'integer', 'min:1', 'exists:students,id'],
            'split_duration' => ['required', 'integer', 'min:1', 'max:15'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ];
    }
}
