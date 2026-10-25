<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientResponsableRequest;
use App\Models\Patient;
use App\Models\PatientResponsable;
use App\Models\User;

class PatientResponsableController extends Controller
{
    public function index()
    {
        $patientResponsables = PatientResponsable::with(['patient', 'user'])->get();

        return view('patient_responsables.index', compact('patientResponsables'));
    }

    public function create()
    {
        return view('patient_responsables.create', [
            'patients' => Patient::orderBy('nom')->get(),
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function store(PatientResponsableRequest $request)
    {
        PatientResponsable::create($request->validated());

        return redirect()->route('patient_responsables.index')->with('success', 'Responsable ajouté avec succès.');
    }

    public function show(PatientResponsable $patientResponsable)
    {
        $patientResponsable->load(['patient', 'user']);

        return view('patient_responsables.show', compact('patientResponsable'));
    }

    public function edit(PatientResponsable $patientResponsable)
    {
        return view('patient_responsables.edit', [
            'patientResponsable' => $patientResponsable,
            'patients' => Patient::orderBy('nom')->get(),
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function update(PatientResponsableRequest $request, PatientResponsable $patientResponsable)
    {
        $patientResponsable->update($request->validated());

        return redirect()->route('patient_responsables.index')->with('success', 'Responsable mis à jour avec succès.');
    }

    public function destroy(PatientResponsable $patientResponsable)
    {
        $patientResponsable->delete();

        return redirect()->route('patient_responsables.index')->with('success', 'Responsable supprimé avec succès.');
    }
}
