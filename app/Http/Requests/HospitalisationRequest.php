<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalisationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'room_id' => ['required', 'integer', 'exists:rooms,id'],
            'date_admission' => ['required', 'date'],
            'date_sortie' => ['nullable', 'date', 'after_or_equal:date_admission'],
        ];
    }
}
