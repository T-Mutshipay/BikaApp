<?php

use App\Http\Controllers\FacturationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('factures',FacturationController::class);
});