<?php

namespace App\Http\Controllers;

use App\Models\Facturation;
use App\Http\Requests\StoreFacturationRequest;
use App\Http\Requests\UpdateFacturationRequest;
use App\Models\Patient;
use App\Models\Hospitalisation;
use App\Models\Consultation;
use App\Models\Examen;

class FacturationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        $hospitalisations = Hospitalisation::all();
        $consultations = Consultation::all();
        $examens = Examen::all();
        $facturations = Facturation::all();
        return view('factures.index', compact('facturations', 'patients', 'hospitalisations', 'consultations', 'examens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturationRequest $request)
    {
        $request->validated([
            'patient_id' => 'required',
            'montant_total'=> 'required|numeric',
            'statut' => 'required',
        ]);
        Facturation::create($request->all());
        return redirect()->back()->with('success', 'Facturation enregistrée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facturation $facturation)
    {
        return view('factures.show', compact('facturation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facturation $facturation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturationRequest $request, Facturation $facturation)
    {
        $request->validated([
            'patient_id' => 'required',
            'montant_total'=> 'required|numeric',
            'statut' => 'required',
        ]);
        $facturation->update($request->all());
        return redirect()->back()->with('success', 'Facturation modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facturation $facturation)
    {
        $facturation->delete();
        return redirect()->back()->with('success', 'Facturation supprimée avec succès');
    }
}
