<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProyectoRequest;
use App\Http\Requests\UpdateProyectoRequest;
use App\Models\Proyecto;
use Illuminate\Http\JsonResponse;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $proyectos = Proyecto::query()->paginate(15);

        return response()->json($proyectos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProyectoRequest $request): JsonResponse
    {
        $proyecto = Proyecto::create($request->validated());

        return response()->json($proyecto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto): JsonResponse
    {
        return response()->json($proyecto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProyectoRequest $request, Proyecto $proyecto): JsonResponse
    {
        $proyecto->update($request->validated());

        return response()->json($proyecto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto): JsonResponse
    {
        $proyecto->delete();

        return response()->json([
            'message' => 'Proyecto eliminado correctamente.',
        ]);
    }
}
