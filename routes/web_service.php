<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/services/{departementId}', [ServiceController::class, 'index'])->name('services.index');
    Route::resource('services', ServiceController::class);
});
