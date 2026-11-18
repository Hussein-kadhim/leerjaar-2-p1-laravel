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

    // Overzicht Magazijn Jamin 
    Route::get('/magazijn', [MagazijnController::class, 'index'])->name('magazijn.index');

    // Detailscherm Leveringsinformatie
    Route::get('/levering/{productId}', [LeveringController::class, 'show'])->name('levering.show');

    // Detailscherm Allergeneninformatie 
    Route::get('/allergeen/{productId}', [AllergeenController::class, 'show'])->name('allergeen.show');

    // Overzicht Leveranciers
    Route::get('/leverancier', [LeverancierController::class, 'index'])->name('leverancier.index');

    // Detailscherm Geleverde Producten
    Route::get('/leverancier/{leverancierId}/producten', [LeverancierController::class, 'producten'])->name('leverancier.producten');

    // Detailscherm Levering Product
    Route::get('/levering/{leverancierId}/{productId}/create', [LeveringController::class, 'create'])->name('levering.create');
    Route::post('/levering/{leverancierId}/{productId}', [LeveringController::class, 'store'])->name('levering.store');

    // BE-Opdracht 03: Wijzigen Leveranciers
    Route::get('/leverancier/wijzigen', [LeverancierController::class, 'wijzigenIndex'])->name('leverancier.wijzigen');
    Route::get('/leverancier/{leverancierId}/details', [LeverancierController::class, 'details'])->name('leverancier.details');
    Route::get('/leverancier/{leverancierId}/edit', [LeverancierController::class, 'edit'])->name('leverancier.edit');
    Route::post('/leverancier/{leverancierId}/update', [LeverancierController::class, 'update'])->name('leverancier.update');
});

require __DIR__.'/auth.php';
