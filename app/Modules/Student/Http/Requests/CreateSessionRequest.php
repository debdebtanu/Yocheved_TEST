<?php

namespace App\Modules\Student\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Student\Models\StudentSession;
use Illuminate\Contracts\Validation\ValidationRule;

class CreateSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
 
    protected function prepareForValidation()
    {
        $this->merge([
            'start_time' => Carbon::parse($this->start_time)->format('Y-m-d H:i:s'),
            'end_time' =>  Carbon::parse($this->start_time)->addMinutes((int)$this->duration)->format('Y-m-d H:i:s'),
        ]);
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
            'start_time' => ['required', 'string', 'after:' . now()->addHour()],
            'end_time' => ['sometimes', 'nullable'],
            'duration' => ['required', 'integer', 'min:1', 'max:15'],
            'type' => ['required', 'string', 'max:10', Rule::in(StudentSession::sessionTypes())],
        ];
    }
}
