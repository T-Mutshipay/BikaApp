<?php

namespace App\Http\Controllers;

use App\Http\Requests\HospitalisationRequest;
use App\Models\Hospitalisation;
use App\Models\Patient;
use App\Models\Room;
use App\Models\Service;
use App\Services\HospitalisationService;
use Illuminate\Http\Request;

class HospitalisationController extends Controller
{
    public function __construct(private HospitalisationService $hospitalisations)
    {
    }

    public function index(Request $request)
    {
        $service = $request->filled('service') ? Service::findOrFail($request->integer('service')) : null;

        $hospitalisations = Hospitalisation::with(['patient', 'room', 'service'])
            ->when($service, fn ($q) => $q->where('service_id', $service->id))
            ->latest('date_admission')
            ->get();

        return view('hospitalisations.index', compact('hospitalisations', 'service'));
    }

    public function create(Request $request)
    {
        return view('hospitalisations.create', [
            'patients' => Patient::orderBy('nom')->orderBy('prenom')->get(),
            'rooms' => Room::where('disponibilite', true)->orderBy('nom')->get(),
            'services' => Service::orderBy('nom')->get(),
            'serviceId' => $request->integer('service') ?: null,
        ]);
    }

    public function store(HospitalisationRequest $request)
    {
        $hospitalisation = $this->hospitalisations->admettre($request->validated());

        return redirect()
            ->route('hospitalisations.index', ['service' => $hospitalisation->service_id])
            ->with('success', 'Hospitalisation enregistrée avec succès.');
    }

    public function show(Hospitalisation $hospitalisation)
    {
        $hospitalisation->load(['patient', 'room', 'service']);

        return view('hospitalisations.show', compact('hospitalisation'));
    }

    public function edit(Hospitalisation $hospitalisation)
    {
        return view('hospitalisations.edit', [
            'hospitalisation' => $hospitalisation,
            'patients' => Patient::orderBy('nom')->orderBy('prenom')->get(),
            'rooms' => Room::where('disponibilite', true)
                ->orWhere('id', $hospitalisation->room_id)
                ->orderBy('nom')
                ->get(),
            'services' => Service::orderBy('nom')->get(),
        ]);
    }

    public function update(HospitalisationRequest $request, Hospitalisation $hospitalisation)
    {
        $this->hospitalisations->modifier($hospitalisation, $request->validated());

        return redirect()
            ->route('hospitalisations.index', ['service' => $hospitalisation->service_id])
            ->with('success', 'Hospitalisation mise à jour avec succès.');
    }

    public function destroy(Hospitalisation $hospitalisation)
    {
        $serviceId = $hospitalisation->service_id;
        $this->hospitalisations->supprimer($hospitalisation);

        return redirect()
            ->route('hospitalisations.index', ['service' => $serviceId])
            ->with('success', 'Hospitalisation supprimée avec succès.');
    }
}
