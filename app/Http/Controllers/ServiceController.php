<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        // 404 si le département est absent ou inexistant.
        $departement = Departement::findOrFail($request->integer('departement'));
        $services = $departement->services()->orderBy('nom')->get();

        return view('services.index', compact('services', 'departement'));
    }
}
