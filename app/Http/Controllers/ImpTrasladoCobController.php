<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpTrasladoCobController extends Controller
{
      //funcion para registrar un impuesto trasladado cobrado
    public function registrarImpuestoTrasladadoCobrado(Request $request)
    {
        // Crear una nueva instancia del modelo ImpTrasladoCob
        $impuesto = new \App\Models\ImpTrasladoCob();
        $impuesto->uuid = $request->uuid;
        $impuesto->idventa = $request->idventa;
        $impuesto->idservicio = $request->idservicio;
        $impuesto->idproducto = $request->idproducto;
        $impuesto->base = $request->base;
        $impuesto->impuesto = $request->impuesto;
        $impuesto->tipofactor = $request->tipofactor;
        $impuesto->tasaocuota = $request->tasaocuota;
        $impuesto->importe = $request->importe;

        if ($impuesto->save()) {
            return response()->json(['message' => 'Impuesto trasladado cobrado registrado correctamente'], 201);
        } else {
            return response()->json(['message' => 'Error al registrar el impuesto trasladado cobrado'], 500);
        }
    }
    //funcion para eliminar un impuesto trasladado cobrado pasando como parametro id
    public function eliminarImpuestoTrasladadoCobrado(Request $request)
    {
        $impuesto = \App\Models\ImpTrasladoCob::find($request->id);

        if (!$impuesto) {
            return response()->json(['message' => 'Impuesto trasladado cobrado no encontrado'], 404);
        }

        // Cambiar el status a 0 para indicar que está eliminado
        $impuesto->status = 0;

        if ($impuesto->save()) {
            return response()->json(['message' => 'Impuesto trasladado cobrado eliminado correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al eliminar el impuesto trasladado cobrado'], 500);
        }
    }
    //funcion para obtener los impuestos trasladados cobrados de una venta
    public function obtenerImpuestosTrasladadosCobrado(Request $request)
    {
        $idventa = $request->idventa;

        // Obtener los impuestos trasladados cobrados de la venta
        $impuestos = \App\Models\ImpTrasladoCob::where('idventa', $idventa)
            ->where('status', 1) // Asegurarse de que solo se obtienen los activos
            ->get();

        if ($impuestos->isEmpty()) {
            return response()->json(['message' => 'No se encontraron impuestos trasladados cobrados para esta venta'], 404);
        }

        return response()->json($impuestos, 200);
    }
    //funcion para obtener un impuesto trasladado cobrado por id
    public function obtenerImpuestoTrasladadoCobradoPorId(Request $request)
    {
        $id = $request->id;

        // Obtener el impuesto trasladado cobrado por id
        $impuesto = \App\Models\ImpTrasladoCob::find($id);

        if (!$impuesto || $impuesto->status == 0) {
            return response()->json(['message' => 'Impuesto trasladado cobrado no encontrado'], 404);
        }

        return response()->json($impuesto, 200);
    }
    //funcion para actualizar un impuesto trasladado cobrado
    public function actualizarImpuestoTrasladadoCobrado(Request $request)
    {
        $impuesto = \App\Models\ImpTrasladoCob::find($request->id);

        if (!$impuesto) {
            return response()->json(['message' => 'Impuesto trasladado cobrado no encontrado'], 404);
        }

        // Actualizar los campos necesarios
        $impuesto->uuid = $request->uuid;
        $impuesto->idventa = $request->idventa;
        $impuesto->idservicio = $request->idservicio;
        $impuesto->idproducto = $request->idproducto;
        $impuesto->base = $request->base;
        $impuesto->impuesto = $request->impuesto;
        $impuesto->tipofactor = $request->tipofactor;
        $impuesto->tasaocuota = $request->tasaocuota;
        $impuesto->importe = $request->importe;

        if ($impuesto->save()) {
            return response()->json(['message' => 'Impuesto trasladado cobrado actualizado correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al actualizar el impuesto trasladado cobrado'], 500);
        }
    }
    


}
