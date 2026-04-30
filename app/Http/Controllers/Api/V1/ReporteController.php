<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Pieza;
use App\Models\Proyecto;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function pendientesPorProyecto(): JsonResponse
    {
        $totales = Proyecto::query()
            ->withCount([
                'piezas as piezas_pendientes' => function ($query) {
                    $query->where('estado', 'pendiente');
                },
            ])
            ->get();

        return response()->json($totales);
    }

    public function totalesPorEstado(): JsonResponse
    {
        $totales = Pieza::query()
            ->select('estado', DB::raw('count(*) as total'))
            ->groupBy('estado')
            ->get();

        return response()->json($totales);
    }
}
