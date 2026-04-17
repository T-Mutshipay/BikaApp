<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Hospitalisation;
use App\Models\Patient;
use App\Models\PatientResponsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{
    public function index()
{
    $user = Auth::user();
    $patient = PatientResponsable::where('user_id', $user->id)->first();

    if ($patient && $patient->patient_id) {
        $patient_id = $patient->patient_id;
        $hospitalisations = Hospitalisation::where('patient_id', $patient_id)->get();
        $hospitalisationsCount = $hospitalisations->count();
        $nonHospitalisesCount = Examen::where('patient_id', $patient_id)->count() - $hospitalisationsCount;
    } else {
        $hospitalisationsCount = 0;
        $nonHospitalisesCount = 0;
    }

    $lastLogin = $user->last_login_at ?? now()->subDays(1);
    $newPatients = PatientResponsable::where('created_at', '>', $lastLogin)->get();
    $patientsCount = PatientResponsable::count();

    return view('dashboard', compact('patient', 'hospitalisationsCount', 'nonHospitalisesCount', 'patientsCount', 'newPatients'));
}

}
