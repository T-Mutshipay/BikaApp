<?php

use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('consultations', ConsultationController::class)->except([
        'store'
    ]);
    Route::post('consultations/{patient_id}', [ConsultationController::class, 'store'])->name('consultations.store');
});