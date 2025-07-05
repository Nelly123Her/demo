<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpRetenidoController extends Controller
{
    //funcion para dar de alta un impuesto retenido
    public function registrarImpuestoRetenido(Request $request)
    {
        // Crear una nueva instancia del modelo ImpRetenido
        $impuesto = new \App\Models\ImpRetenido();
        $impuesto->clave = $request->clave;
        $impuesto->tipofactor = $request->tipofactor;
        $impuesto->tasaocuota = $request->tasaocuota;
        $impuesto->activo = $request->activo;

        if ($impuesto->save()) {
            return response()->json(['message' => 'Impuesto retenido registrado correctamente'], 201);
        } else {
            return response()->json(['message' => 'Error al registrar el impuesto retenido'], 500);
        }
    }
    //funcion para actualizar un impuesto retenido
    public function actualizarImpuestoRetenido(Request $request, $id)
    {
        // Buscar el impuesto retenido por su ID
        $impuesto = \App\Models\ImpRetenido::find($id);
        if (!$impuesto) {
            return response()->json(['message' => 'Impuesto retenido no encontrado'], 404);
        }

        // Actualizar los campos del impuesto retenido
        $impuesto->clave = $request->clave ?? $impuesto->clave;
        $impuesto->tipofactor = $request->tipofactor ?? $impuesto->tipofactor;
        $impuesto->tasaocuota = $request->tasaocuota ?? $impuesto->tasaocuota;
        $impuesto->activo = $request->activo ?? $impuesto->activo;

        if ($impuesto->save()) {
            return response()->json(['message' => 'Impuesto retenido actualizado correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al actualizar el impuesto retenido'], 500);
        }
    }
}
