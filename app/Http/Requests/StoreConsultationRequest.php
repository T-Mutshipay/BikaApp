<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'motif_consultation' => ['required', 'string', 'max:2000'],
            'poids' => ['required', 'numeric', 'between:0.3,500'],        // kg
            'taille' => ['required', 'numeric', 'between:20,250'],         // cm
            'temperature' => ['required', 'numeric', 'between:25,45'],     // °C
            'tension' => ['required', 'numeric', 'between:40,300'],        // mmHg (systolique)
            'pouls' => ['required', 'numeric', 'between:20,300'],          // bpm
            'diagnostic' => ['required', 'string', 'max:5000'],
        ];
    }
}
