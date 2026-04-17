<?php

namespace App\Http\Controllers;

use App\Models\PatientResponsable;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class PatientResponsableController extends Controller
{
    public function index()
    {
        $patientResponsables = PatientResponsable::with(['patient', 'user'])->get();
        return view('patient_responsables.index', compact('patientResponsables'));
    }
    public function create()
    {
        $patients = Patient::all();
        $users = User::all();
        return view('patient_responsables.create', compact('patients', 'users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string|max:255',
        ]);

        PatientResponsable::create($request->all());

        return redirect()->route('patient_responsables.index')->with('success', 'Responsable ajouté avec succès.');
    }
    public function show($id)
    {
        $patientResponsable = PatientResponsable::with(['patient', 'user'])->findOrFail($id);
        return view('patient_responsables.show', compact('patientResponsable'));
    }
    public function edit($id)
    {
        $patientResponsable = PatientResponsable::findOrFail($id);
        $patients = Patient::all();
        $users = User::all();
        return view('patient_responsables.edit', compact('patientResponsable', 'patients', 'users'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string|max:255',
        ]);

        $patientResponsable = PatientResponsable::findOrFail($id);
        $patientResponsable->update($request->all());

        return redirect()->route('patient_responsables.index')->with('success', 'Responsable mis à jour avec succès.');
    }
    public function destroy($id)
    {
        $patientResponsable = PatientResponsable::findOrFail($id);
        $patientResponsable->delete();

        return redirect()->route('patient_responsables.index')->with('success', 'Responsable supprimé avec succès.');
    }
}
