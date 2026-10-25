<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientResponsableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'role' => ['required', 'string', 'max:255'],
        ];
    }
}
