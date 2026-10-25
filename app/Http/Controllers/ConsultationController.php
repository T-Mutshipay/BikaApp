<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function store(StoreConsultationRequest $request, Patient $patient)
    {
        $patient->consultations()->create($request->validated() + [
            'user_id' => Auth::id(),
            'date_consultation' => now()->toDateString(),
            'heure_consultation' => now()->format('H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Consultation enregistrée avec succès');
    }
}
