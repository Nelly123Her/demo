<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntradaACajaController extends Controller
{
    //function para registrar una entrada a caja pasando como parametro idcaja, idusuario, efectivo, fecha
    public function registrarEntrada(Request $request)
    {
      
        // Crear una nueva instancia del modelo EntradaACaja
        $entrada = new \App\Models\EntradaACaja();
        $entrada->idcaja = $request->idcaja;
        $entrada->idusuario = $request->idusuario;
        $entrada->idapercierre = $request->idapercierre;
        $entrada->concepto = $request->concepto;
        $entrada->efectivo = $request->efectivo;
        $entrada->fecha = $request->fecha;
        $entrada->status = 1; // 1 para entrada
        
        if ($entrada->save()) {
            return response()->json(['message' => 'Entrada registrada correctamente'], 201);
        } else {
            return response()->json(['message' => 'Error al registrar la entrada'], 500);
        }
    }
    //funcion para elminar una entrada a caja pasando como parametro id
    public function eliminarEntrada(Request $request)
    {
        $entrada = \App\Models\EntradaACaja::find($request->id);

        if (!$entrada) {
            return response()->json(['message' => 'Entrada no encontrada'], 404);
        }

        // Cambiar el status a 0 para indicar que está eliminada
        $entrada->status = 0;

        if ($entrada->save()) {
            return response()->json(['message' => 'Entrada eliminada correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al eliminar la entrada'], 500);
        }
    }
    //funcion para realizar un cambio de entrada pasando como parametro id, idcaja, idusuario, efectivo, fecha
    public function actualizarEntrada(Request $request)
    {
        $entrada = \App\Models\EntradaACaja::find($request->id);

        if (!$entrada) {
            return response()->json(['message' => 'Entrada no encontrada'], 404);
        }

        // Actualizar los campos necesarios
        $entrada->idcaja = $request->idcaja;
        $entrada->idusuario = $request->idusuario;
        $entrada->idapecierre = $request->idapecierre;
        $entrada->concepto = $request->concepto;
        $entrada->efectivo = $request->efectivo;
        $entrada->fecha = $request->fecha;

        if ($entrada->save()) {
            return response()->json(['message' => 'Entrada actualizada correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al actualizar la entrada'], 500);
        }
    }
    //funcion para consultar entradas por idaperturacierre  con status=1
    public function consultarEntradasPorAperturaCierre(Request $request)
    {
        $entradas = \App\Models\EntradaACaja::where('idapecierre', $request->idapecierre)
            ->where('status', 1) // 1 para entradas
            ->get();

        if ($entradas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron entradas'], 404);
        }

        return response()->json($entradas, 200);
    }
    //funcion para consultar entradas por idcaja con status=1
    public function consultarEntradasPorCaja(Request $request)
    {
        $entradas = \App\Models\EntradaACaja::where('idcaja', $request->idcaja)
            ->where('status', 1) // 1 para entradas
            ->get();

        if ($entradas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron entradas'], 404);
        }

        return response()->json($entradas, 200);
    }
    //funcion para consultar entradas por id con status=1
    public function consultarEntradaPorId(Request $request)
    {
        $entrada = \App\Models\EntradaACaja::where('id', $request->id)
            ->where('status', 1) // 1 para entradas
            ->first();

        if (!$entrada) {
            return response()->json(['message' => 'Entrada no encontrada'], 404);
        }

        return response()->json($entrada, 200);
    }

}
