<?php

use App\Http\Controllers\HospitalisationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('hospitalisations',HospitalisationController::class);
});