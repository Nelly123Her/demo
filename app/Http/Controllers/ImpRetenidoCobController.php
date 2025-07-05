<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImpRetenidoCob;

class ImpRetenidoCobController extends Controller
{
   //funcion para registrar un impuesto retenido cobrado
   public function registrarImpuestoRetenidoCobrado(Request $request)
   {
       // Crear una nueva instancia del modelo ImpuestoRetenidoCobrado       
       $impuesto = new ImpRetenidoCob();
       $impuesto->uuid = $request->uuid;
       $impuesto->idventa = $request->idventa;
       $impuesto->idproducto = $request->idproducto;
       $impuesto->base = $request->base;
       $impuesto->impuesto = $request->impuesto;
       $impuesto->tipofactor = $request->tipofactor;
       $impuesto->tasaocuota = $request->tasaocuota;
       $impuesto->importe = $request->importe;
       
       if ($impuesto->save()) {
           return response()->json(['message' => 'Impuesto retenido cobrado registrado correctamente'], 201);
       } else {
           return response()->json(['message' => 'Error al registrar el impuesto retenido cobrado'], 500);
       }
   }
    //funcion para eliminar un impuesto retenido cobrado pasando como parametro id
    public function eliminarImpuestoRetenidoCobrado(Request $request)
    {
        $impuesto = ImpRetenidoCob::find($request->id);

        if (!$impuesto) {
            return response()->json(['message' => 'Impuesto retenido cobrado no encontrado'], 404);
        }

        // Cambiar el status a 0 para indicar que está eliminado
        $impuesto->status = 0;

        if ($impuesto->save()) {
            return response()->json(['message' => 'Impuesto retenido cobrado eliminado correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al eliminar el impuesto retenido cobrado'], 500);
        }
    }
}
