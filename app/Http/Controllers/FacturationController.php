<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacturationRequest;
use App\Http\Requests\UpdateFacturationRequest;
use App\Models\Facturation;
use App\Models\Patient;

class FacturationController extends Controller
{
    public function index()
    {
        $facturations = Facturation::with('patient')->latest()->get();
        $patients = Patient::orderBy('nom')->orderBy('prenom')->get(['id', 'nom', 'prenom']);
        $statuts = Facturation::STATUTS;

        return view('factures.index', compact('facturations', 'patients', 'statuts'));
    }

    public function store(StoreFacturationRequest $request)
    {
        Facturation::create($request->validated());

        return redirect()->route('factures.index')->with('success', 'Facturation enregistrée avec succès');
    }

    public function show(Facturation $facturation)
    {
        $facturation->load(['patient', 'hospitalisation', 'consultation', 'examen']);
        $statuts = Facturation::STATUTS;

        return view('factures.show', compact('facturation', 'statuts'));
    }

    public function update(UpdateFacturationRequest $request, Facturation $facturation)
    {
        $facturation->update($request->validated());

        return redirect()->route('factures.show', $facturation)->with('success', 'Facturation modifiée avec succès');
    }

    public function destroy(Facturation $facturation)
    {
        $facturation->delete();

        return redirect()->route('factures.index')->with('success', 'Facturation supprimée avec succès');
    }
}
