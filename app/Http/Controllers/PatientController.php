<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::orderBy('nom')->orderBy('prenom')->get();

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(PatientRequest $request)
    {
        Patient::create($request->validated());

        return redirect()->route('patients.index')->with('success', 'Patient ajouté avec succès.');
    }

    public function show(Patient $patient)
    {
        $patient->load([
            'hospitalisations.room',
            'hospitalisations.service',
            'examens',
        ]);

        return view('patients.show', ['patient' => $patient, 'consultations' => $patient->consultations]);
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(PatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());

        return redirect()->route('patients.index')->with('success', 'Patient mis à jour avec succès.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès.');
    }
}
