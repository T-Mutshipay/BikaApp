<?php

namespace App\Http\Controllers;

// use App\View\Components\consultation;
use Carbon\Carbon;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, string $patient_id)
    {
        $request->validate([
            'motif_consultation' => 'required',
            'poids' => 'required',
            'taille' => 'required',
            'temperature' => 'required',
            'tension' => 'required',
            'pouls' => 'required',
            'diagnostic' => 'required', 
        ]);

        $user = Auth::id();
        $date_consultation = Carbon::now()->format('Y-m-d');  
        $heure_consultation = Carbon::now()->format('H:i:s');

        Consultation::create([ 
            'patient_id' => $patient_id,
            'user_id' => $user,
            'motif_consultation' => $request->motif_consultation,
            'poids' => $request->poids,
            'taille' => $request->taille,
            'temperature' => $request->temperature,
            'tension' => $request->tension,
            'pouls' => $request->pouls,
            'diagnostic' => $request->diagnostic,
            'date_consultation' => $date_consultation,
            'heure_consultation' => $heure_consultation,
        ]);        

        return redirect()->back()->with('success', 'Consultation enregistrée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
