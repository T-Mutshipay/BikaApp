<?php

namespace App\Http\Requests;

use App\Models\Facturation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFacturationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'hospitalisation_id' => ['nullable', 'integer', 'exists:hospitalisations,id'],
            'consultation_id' => ['nullable', 'integer', 'exists:consultations,id'],
            'examen_id' => ['nullable', 'integer', 'exists:examens,id'],
            'montant_total' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'statut' => ['required', Rule::in(Facturation::STATUTS)],
        ];
    }
}
