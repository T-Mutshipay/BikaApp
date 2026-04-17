<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu', function(){
    return view('menu');
})->middleware(['auth','verified'])->name('menu');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/web_room.php';
require __DIR__.'/web_users.php';
require __DIR__.'/web_service.php';
require __DIR__.'/web_facture.php';
require __DiR__.'/web_patient.php';
require __DIR__.'/web_consultation.php';
require __DIR__.'/web_departement.php';
require __DIR__.'/web_hospitalisation.php';
require __DIR__.'/web_patient_responsable.php';
