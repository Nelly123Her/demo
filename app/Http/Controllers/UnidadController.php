<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnidadController extends Controller
{
    //funcion para registrar una nueva unidad
    public function Nuevo(Request $request)
    {
        $unidad = new \App\Models\Unidad();
        $unidad->clave = $request->input('clave');
        $unidad->descripcion = $request->input('descripcion');
        $unidad->activo = $request->input('activo');

        if ($unidad->save()) {
            return response()->json(['message' => 'Unidad registrada exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al registrar la unidad'], 500);
        }
    }
    //Funcion modificar para actualizar una unidad
    public function Modificar(Request $request, $id)
    {
        $unidad = \App\Models\Unidad::find($id);
        if (!$unidad) {
            return response()->json(['message' => 'Unidad no encontrada'], 404);
        }

        $unidad->clave = $request->input('clave', $unidad->clave);
        $unidad->descripcion = $request->input('descripcion', $unidad->descripcion);
        $unidad->activo = $request->input('activo', $unidad->activo);

        if ($unidad->save()) {
            return response()->json(['message' => 'Unidad actualizada exitosamente'], 200);
        } else {
            return response()->json(['message' => 'Error al actualizar la unidad'], 500);
        }
    }
    //funcion para eliminar una unidad
    public function Eliminar($id)
    {
        $unidad = \App\Models\Unidad::find($id);
        if (!$unidad) {
            return response()->json(['message' => 'Unidad no encontrada'], 404);
        }

        // Cambiar el estado a eliminado
        $unidad->activo = 0; // Asumiendo que 0 es el estado de eliminado
        if ($unidad->save()) {
            return response()->json(['message' => 'Unidad eliminada exitosamente'], 200);
        } else {
            return response()->json(['message' => 'Error al eliminar la unidad'], 500);
        }
    }
    //funcion para Catalogo para obtener todas las unidades, si se envie el Id debe de conusltar solo esa unidad
    public function Catalogo($id = null)
    {
        if ($id) {
            $unidad = \App\Models\Unidad::find($id);
            if (!$unidad) {
                return response()->json(['message' => 'Unidad no encontrada'], 404);
            }
            return response()->json($unidad, 200);
        } else {
            $unidades = \App\Models\Unidad::where('activo', 1)->get();
            return response()->json($unidades, 200);
        }
    }
    
}
