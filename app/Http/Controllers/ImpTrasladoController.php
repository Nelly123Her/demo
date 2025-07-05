<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpTrasladoController extends Controller
{
    //funcion para registrar un nuevo traslado
    public function store(Request $request)
    {
        $traslado = new \App\Models\ImpTraslado();
        $traslado->clave = $request->input('clave');
        $traslado->tipofactor = $request->input('tipofactor');
        $traslado->tasaocuota = $request->input('tasaocuota');
        $traslado->activo = $request->input('activo');
        $traslado->status = $request->input('status');
        
        if ($traslado->save()) {
            return response()->json(['message' => 'Traslado registrado exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al registrar el traslado'], 500);
        }
    }
    //funcion para eliminar un registro de traslado
    public function eliminar($id)
    {
        $traslado = \App\Models\ImpTraslado::find($id);
        
        if (!$traslado) {
            return response()->json(['message' => 'Traslado no encontrado'], 404);
        }

        // Cambiar el estado a eliminado
        $traslado->status = 0; // Asumiendo que 0 es el estado de eliminado
        if ($traslado->save()) {
            return response()->json(['message' => 'Traslado eliminado exitosamente'], 200);
        } else {
            return response()->json(['message' => 'Error al eliminar el traslado'], 500);
        }
    }
    //funcion para realziar un cambio de registro de traslado
    public function Actualizar(Request $request, $id)
    {
        $traslado = \App\Models\ImpTraslado::find($id);
        
        if (!$traslado) {
            return response()->json(['message' => 'Traslado no encontrado'], 404);
        }

        $traslado->clave = $request->input('clave', $traslado->clave);
        $traslado->tipofactor = $request->input('tipofactor', $traslado->tipofactor);
        $traslado->tasaocuota = $request->input('tasaocuota', $traslado->tasaocuota);
        $traslado->activo = $request->input('activo', $traslado->activo);
        $traslado->status = $request->input('status', $traslado->status);

        if ($traslado->save()) {
            return response()->json(['message' => 'Traslado actualizado exitosamente'], 200);
        } else {
            return response()->json(['message' => 'Error al actualizar el traslado'], 500);
        }
    }
}
