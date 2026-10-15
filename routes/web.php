<?php

use App\Http\Controllers\AllergeenController;
use App\Http\Controllers\LeveringController;
use App\Http\Controllers\LeverancierController;
use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $rol = Auth::user()->role;

    return view('dashboard', [
        'rol' => $rol,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Overzicht Magazijn Jamin (Wireframe 1)
    Route::get('/magazijn', [MagazijnController::class, 'index'])->name('magazijn.index');

    // User Story 1: Detailscherm Leveringsinformatie (Wireframe 2)
    Route::get('/levering/{productId}', [LeveringController::class, 'show'])->name('levering.show');

    // User Story 2: Detailscherm Allergeneninformatie (Wireframe 3)
    Route::get('/allergeen/{productId}', [AllergeenController::class, 'show'])->name('allergeen.show');

    // BE-Opdracht 02 - User Story 1: Overzicht Leveranciers (Wireframe 1)
    Route::get('/leverancier', [LeverancierController::class, 'index'])->name('leverancier.index');

    // BE-Opdracht 02 - User Story 1: Detailscherm Geleverde Producten (Wireframe 2 & Wireframe 3)
    Route::get('/leverancier/{leverancierId}/producten', [LeverancierController::class, 'producten'])->name('leverancier.producten');

    // BE-Opdracht 02 - User Story 2: Detailscherm Levering Product (Wireframe 4)
    Route::get('/levering/{leverancierId}/{productId}/create', [LeveringController::class, 'create'])->name('levering.create');
    Route::post('/levering/{leverancierId}/{productId}', [LeveringController::class, 'store'])->name('levering.store');
});

require __DIR__.'/auth.php';
