<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePiezaRequest;
use App\Http\Requests\UpdatePiezaRequest;
use App\Models\Bloque;
use App\Models\Pieza;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PiezaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Pieza::query()->with('bloque.proyecto');

        if ($request->filled('proyecto_id')) {
            $query->whereHas('bloque', function ($bloqueQuery) use ($request) {
                $bloqueQuery->where('proyecto_id', $request->integer('proyecto_id'));
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->string('estado')->toString());
        }

        $piezas = $query->paginate(15);

        return response()->json($piezas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePiezaRequest $request, Bloque $bloque): JsonResponse
    {
        $data = $request->validated();

        $pieza = $bloque->piezas()->create($data);

        return response()->json($pieza, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pieza $pieza): JsonResponse
    {
        return response()->json($pieza->load('bloque.proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePiezaRequest $request, Pieza $pieza): JsonResponse
    {
        $data = $request->validated();

        if (array_key_exists('peso_real', $data) || array_key_exists('peso_teorico', $data)) {
            $pesoReal = $data['peso_real'] ?? $pieza->peso_real;
            $pesoTeorico = $data['peso_teorico'] ?? $pieza->peso_teorico;
            if ($pesoReal !== null && $pesoTeorico !== null) {
                $data['diferencia_peso'] = $pesoReal - $pesoTeorico;
            }
        }

        $pieza->update($data);

        return response()->json($pieza);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pieza $pieza): JsonResponse
    {
        $pieza->delete();

        return response()->json([
            'message' => 'Pieza eliminada correctamente.',
        ]);
    }
}
