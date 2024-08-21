<?php

namespace App\Modules\Student\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Student\Models\StudentSession;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateSessionRequest extends FormRequest
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
            'rate' => ['required', 'integer', 'min:0', 'max:10'],
        ];
    }
}
