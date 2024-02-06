<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatrullaController;

use App\Http\Controllers\IncidenteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Rutas para mostrar todos los incidentes, crear un nuevo incidente, almacenar un nuevo incidente
Route::get('/incidentes', [IncidenteController::class, 'index'])->name('incidentes.index');
Route::get('/incidentes/create', [IncidenteController::class, 'create'])->name('incidentes.create');
Route::post('/incidentes', [IncidenteController::class, 'store'])->name('incidentes.store');

// Rutas para mostrar un incidente específico, editar un incidente, actualizar un incidente existente
Route::get('/incidentes/{incidente}', [IncidenteController::class, 'show'])->name('incidentes.show');
Route::get('/incidentes/{incidente}/edit', [IncidenteController::class, 'edit'])->name('incidentes.edit');
Route::put('/incidentes/{incidente}', [IncidenteController::class, 'update'])->name('incidentes.update');

// Ruta para eliminar un incidente
Route::delete('/incidentes/{incidente}', [IncidenteController::class, 'destroy'])->name('incidentes.destroy');

Route::get('/patrulla/create', [PatrullaController::class, 'create'])->name('patrulla.create');
Route::get('/patrulla/edit/{id}', [PatrullaController::class, 'edit'])->name('patrulla.edit');
Route::put('/patrulla/{matricula}', [PatrullaController::class, 'update'])->name('patrulla.update');
Route::get('/patrulla/showAll', [PatrullaController::class, 'index'])->name('patrulla.show');
Route::post('/patrulla', [PatrullaController::class, 'store'])->name('patrulla.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';