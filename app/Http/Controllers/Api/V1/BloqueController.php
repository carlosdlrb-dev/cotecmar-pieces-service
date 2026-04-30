<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBloqueRequest;
use App\Http\Requests\UpdateBloqueRequest;
use App\Models\Bloque;
use App\Models\Proyecto;
use Illuminate\Http\JsonResponse;

class BloqueController extends Controller
{
    /**
     * Display all bloques with optional filtering by proyecto.
     */
    public function indexAll(): JsonResponse
    {
        $query = Bloque::with('proyecto');

        // Filtrar por proyecto si se proporciona el parámetro
        if (request()->has('proyecto_id')) {
            $query->where('proyecto_id', request()->get('proyecto_id'));
        }

        $bloques = $query->paginate(15);

        return response()->json($bloques);
    }

    /**
     * Display a listing of the resource by project.
     */
    public function index(Proyecto $proyecto): JsonResponse
    {
        $bloques = $proyecto->bloques()->paginate(15);

        return response()->json($bloques);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBloqueRequest $request, Proyecto $proyecto): JsonResponse
    {
        $bloque = $proyecto->bloques()->create($request->validated());

        return response()->json($bloque, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bloque $bloque): JsonResponse
    {
        return response()->json($bloque);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBloqueRequest $request, Bloque $bloque): JsonResponse
    {
        $bloque->update($request->validated());

        return response()->json($bloque);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bloque $bloque): JsonResponse
    {
        $bloque->delete();

        return response()->json([
            'message' => 'Bloque eliminado correctamente.',
        ]);
    }
}
