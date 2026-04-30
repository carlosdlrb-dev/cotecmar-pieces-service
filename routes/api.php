<?php

use App\Http\Controllers\Api\V1\BloqueController;
use App\Http\Controllers\Api\V1\PiezaController;
use App\Http\Controllers\Api\V1\ProyectoController;
use App\Http\Controllers\Api\V1\ReporteController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('jwt')->group(function () {
    Route::apiResource('proyectos', ProyectoController::class);

    Route::get('bloques', [BloqueController::class, 'indexAll']);
    
    Route::get('proyectos/{proyecto}/bloques', [BloqueController::class, 'index']);
    Route::post('proyectos/{proyecto}/bloques', [BloqueController::class, 'store']);
    
    Route::apiResource('bloques', BloqueController::class)->except(['index', 'store']);

    Route::get('piezas', [PiezaController::class, 'index']);
    Route::post('bloques/{bloque}/piezas', [PiezaController::class, 'store']);
    Route::apiResource('piezas', PiezaController::class)->except(['index', 'store']);

    Route::get('reportes/pendientes-por-proyecto', [ReporteController::class, 'pendientesPorProyecto']);
    Route::get('reportes/totales-por-estado', [ReporteController::class, 'totalesPorEstado']);
});
