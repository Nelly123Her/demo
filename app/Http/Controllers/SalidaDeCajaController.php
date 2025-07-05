<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalidaDeCajaController extends Controller
{
    //funcion para registrar una salida de caja pasando como parametro idcaja, idusuario, efectivo, fecha
    public function registrarSalida(Request $request)
    {
        // Crear una nueva instancia del modelo SalidaDeCaja
        $salida = new \App\Models\SalidaDeCaja();
        $salida->idcaja = $request->idcaja;
        $salida->idusuario = $request->idusuario;
        $salida->idapecierre = $request->idapecierre;
        $salida->concepto = $request->concepto;
        $salida->efectivo = $request->efectivo;
        $salida->fecha = $request->fecha;
        $salida->status = 1; // 1 para salida
        
        if ($salida->save()) {
            return response()->json(['message' => 'Salida registrada correctamente'], 201);
        } else {
            return response()->json(['message' => 'Error al registrar la salida'], 500);
        }
    }
    //funcion para eliminar una salida de caja pasando como parametro id
    public function eliminarSalida(Request $request)
    {
        $salida = \App\Models\SalidaDeCaja::find($request->id);

        if (!$salida) {
            return response()->json(['message' => 'Salida no encontrada'], 404);
        }

        // Cambiar el status a 0 para indicar que está eliminada
        $salida->status = 0;

        if ($salida->save()) {
            return response()->json(['message' => 'Salida eliminada correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al eliminar la salida'], 500);
        }
    }
    //funcion para realizar un cambio de salida pasando como parametro id, idcaja, idusuario, efectivo, fecha
    public function actualizarSalida(Request $request)
    {
        $salida = \App\Models\SalidaDeCaja::find($request->id);

        if (!$salida) {
            return response()->json(['message' => 'Salida no encontrada'], 404);
        }

        // Actualizar los campos necesarios
        $salida->idcaja = $request->idcaja;
        $salida->idusuario = $request->idusuario;
        $salida->idapecierre = $request->idapecierre;
        $salida->concepto = $request->concepto;
        $salida->efectivo = $request->efectivo;
        $salida->fecha = $request->fecha;

        if ($salida->save()) {
            return response()->json(['message' => 'Salida actualizada correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al actualizar la salida'], 500);
        }
    }
    //funcion para obtener las salidas de cada pasando como parametreo idcajja, idapercierre, status = 1
    public function obtenerSalidas(Request $request)
    {
        $salidas = \App\Models\SalidaDeCaja::where('idcaja', $request->idcaja)
            ->where('idapecierre', $request->idapecierre)
            ->where('status', 1)
            ->get();

        if ($salidas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron salidas'], 404);
        }

        return response()->json($salidas, 200);
    }
}
