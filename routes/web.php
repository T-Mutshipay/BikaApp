<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\FacturationController;
use App\Http\Controllers\HospitalisationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientResponsableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/menu', 'menu')->name('menu');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Patients et consultations
    Route::resource('patients', PatientController::class);
    Route::post('consultations/{patient}', [ConsultationController::class, 'store'])
        ->name('consultations.store');

    // Organisation de l'hôpital
    Route::resource('departements', DepartementController::class);
    Route::resource('services', ServiceController::class)->only(['index']);
    Route::resource('rooms', RoomController::class);

    // Hospitalisations, responsables, facturation
    Route::resource('hospitalisations', HospitalisationController::class);
    Route::resource('patient_responsables', PatientResponsableController::class);
    // Le paramètre doit s'appeler "facturation" pour que le route model binding
    // corresponde au type-hint des méthodes du contrôleur.
    Route::resource('factures', FacturationController::class)
        ->parameters(['factures' => 'facturation'])
        ->except(['create', 'edit']);

    // Utilisateurs (lecture seule pour l'instant, la gestion arrive à l'étape 2)
    Route::resource('users', UserController::class)->only(['index']);
});

require __DIR__.'/auth.php';
