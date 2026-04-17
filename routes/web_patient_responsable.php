<?php

use App\Http\Controllers\PatientResponsableController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('patient_responsables',PatientResponsableController::class);
});