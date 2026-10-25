<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Validation\ValidationException;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('nom')->get();

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(RoomRequest $request)
    {
        Room::create($request->validated());

        return redirect()->route('rooms.index')->with('success', 'Chambre ajoutée avec succès.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(RoomRequest $request, Room $room)
    {
        $data = $request->validated();

        if ($data['capacite'] < $room->occupation()) {
            throw ValidationException::withMessages([
                'capacite' => "Impossible : {$room->occupation()} patient(s) occupent actuellement cette chambre.",
            ]);
        }

        $room->update($data);
        $room->refreshDisponibilite();

        return redirect()->route('rooms.index')->with('success', 'Chambre mise à jour avec succès.');
    }

    public function destroy(Room $room)
    {
        // La suppression en cascade effacerait l'historique des hospitalisations.
        if ($room->hospitalisations()->exists()) {
            return redirect()->route('rooms.index')
                ->with('error', 'Cette chambre a un historique d\'hospitalisations et ne peut pas être supprimée.');
        }

        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Chambre supprimée avec succès.');
    }
}
