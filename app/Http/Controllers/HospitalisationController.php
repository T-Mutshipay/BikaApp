<?php

namespace App\Http\Controllers;

use App\Models\Hospitalisation;
use App\Models\Patient;
use App\Models\Room;
use Illuminate\Http\Request;

class HospitalisationController extends Controller
{
    public function index( Request $request)
    {
        // dd($request->all());
        $serviceId = $request->all(['service']);
        
        $hospitalisations = Hospitalisation::where('service_id', $serviceId)->with(['patient', 'room','service'])->get();
        return view('hospitalisations.index', compact('hospitalisations'));
    }

    public function create()
    {
        
        $patients = Patient::all();
        $rooms = Room::where('disponibilite', true)->get();
        return view('hospitalisations.create', compact('patients', 'rooms'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'room_id' => 'required|exists:rooms,id',
            'date_admission' => 'required|date',
            'date_sortie' => 'nullable|date|after_or_equal:date_admission',
        ]);

        $room = Room::find($request->room_id);
        $currentHospitalisations = Hospitalisation::where('room_id', $room->id)->count();

        if ($currentHospitalisations >= $room->capacite) {
            return redirect()->back()->with('error', 'La chambre est pleine et n\'est plus disponible.');
        }

        Hospitalisation::create($request->all());

        $currentHospitalisations++;
        if ($currentHospitalisations >= $room->capacite) {
            $room->update(['disponibilite' => false]);
        }

        return redirect()->route('hospitalisations.index')->with('success', 'Hospitalisation enregistrée avec succès.');
    }
    public function show(Hospitalisation $hospitalisation)
    {
        return view('hospitalisations.show', compact('hospitalisation'));
    }
    public function edit(Hospitalisation $hospitalisation)
    {
        $patients = Patient::all();
        $rooms = Room::where('disponibilite', true)->orWhere('id', $hospitalisation->room_id)->get();
        return view('hospitalisations.edit', compact('hospitalisation', 'patients', 'rooms'));
    }
    public function update(Request $request, Hospitalisation $hospitalisation)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'room_id' => 'required|exists:rooms,id',
            'date_admission' => 'required|date',
            'date_sortie' => 'nullable|date|after_or_equal:date_admission',
        ]);
        $hospitalisation->room->update(['disponibilite' => true]);
        $hospitalisation->update($request->all());
        $hospitalisation->room->update(['disponibilite' => false]);

        return redirect()->route('hospitalisations.index')->with('success', 'Hospitalisation mise à jour avec succès.');
    }
    public function destroy(Hospitalisation $hospitalisation)
    {
        $hospitalisation->room->update(['disponibilite' => true]);

        $hospitalisation->delete();

        return redirect()->route('hospitalisations.index')->with('success', 'Hospitalisation supprimée avec succès.');
    }
}
