<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlayerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Ruta por defecto de Sanctum (opcional, puedes dejarla o quitarla)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas del desafío
Route::prefix('player')->group(function () {
    Route::get('/', [PlayerController::class, 'index']);          // Listar jugadores
    Route::post('/', [PlayerController::class, 'store']);         // Crear jugador
    Route::put('/{player}', [PlayerController::class, 'update']); // Actualizar jugador
    Route::delete('/{player}', [PlayerController::class, 'destroy']) // Eliminar jugador
        ->middleware('auth.bearer');
});

Route::post('/team/process', [PlayerController::class, 'processTeam']); // Seleccionar equipo