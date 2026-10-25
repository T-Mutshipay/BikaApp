<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Les Policies arrivent à l'étape 2 (rôles et permissions).
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'date', 'before_or_equal:today'],
            'genre' => ['required', Rule::in(['Masculin', 'Féminin'])],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s().]{6,20}$/'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('patients', 'email')->ignore($this->route('patient')),
            ],
        ];
    }
}
