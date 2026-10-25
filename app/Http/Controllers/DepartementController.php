<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartementRequest;
use App\Models\Departement;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::orderBy('nom')->get();

        return view('departements.index', compact('departements'));
    }

    public function create()
    {
        return view('departements.create');
    }

    public function store(DepartementRequest $request)
    {
        Departement::create($request->validated());

        return redirect()->route('departements.index')->with('success', 'Département ajouté avec succès.');
    }

    public function show(Departement $departement)
    {
        return view('services.index', [
            'departement' => $departement,
            'services' => $departement->services()->orderBy('nom')->get(),
        ]);
    }

    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    public function update(DepartementRequest $request, Departement $departement)
    {
        $departement->update($request->validated());

        return redirect()->route('departements.index')->with('success', 'Département mis à jour avec succès.');
    }

    public function destroy(Departement $departement)
    {
        $departement->delete();

        return redirect()->route('departements.index')->with('success', 'Département supprimé avec succès.');
    }
}
