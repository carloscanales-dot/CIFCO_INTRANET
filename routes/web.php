<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/directorio', [App\Http\Controllers\DirectorioController::class, 'index'])->name('directorio');
    Route::get('/documentos', [App\Http\Controllers\DocumentoController::class, 'index'])->name('documentos');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/sistemas', function () {
        return Inertia::render('Sistemas');
    })->name('sistemas');
});

Route::middleware('auth')->group(function () {
    Route::get('/formatos', function () {
        return Inertia::render('Formatos');
    })->name('formatos');
});


    Route::get('/construccion', function () {
        return Inertia::render('Construccion');
    })->name('construccion');



require __DIR__.'/auth.php';
