<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetVenta extends Controller
{
    //Funcion para agregar un detalle a una venta
    public function agregarDetalle(Request $request)
    {
        $detVenta = new \App\Models\DetVenta();
        $detVenta->idventa = $request->idventa;
        $detVenta->idproducto = $request->idproducto;
        $detVenta->codigo = $request->codigo;
        $detVenta->descripcion = $request->descripcion;
        $detVenta->cantidad = $request->cantidad;
        $detVenta->precio = $request->precio;
        $detVenta->precioantes = $request->precioantes;
        $detVenta->descuento = $request->descuento;
        $detVenta->importe = $request->importe;
        $detVenta->importeantes = $request->importeantes;
        $detVenta->ClaveProdServ = $request->ClaveProdServ;
        $detVenta->NoIdentificacion = $request->NoIdentificacion;
        $detVenta->ClaveUnidad = $request->ClaveUnidad;
        $detVenta->Unidad = $request->Unidad;
        $detVenta->ObjetoImp = $request->ObjetoImp;
        $detVenta->save();
        // Retornar una respuesta JSON indicando éxito  
        if (!$detVenta) {
            return response()->json(['success' => false, 'message' => 'Error al agregar el detalle'], 500);
        }
        // Si todo sale bien, retornar una respuesta de éxito        
        return response()->json(['success' => true, 'message' => 'Detalle agregado correctamente']);
    }
    //Funcion para actualizar un detalle de venta
    public function actualizarDetalle(Request $request)
    {
        $detVenta = \App\Models\DetVenta::find($request->id);
        if (!$detVenta) {
            return response()->json(['success' => false, 'message' => 'Detalle no encontrado'], 404);
        }
        
        $detVenta->idventa = $request->idventa;
        $detVenta->idproducto = $request->idproducto;
        $detVenta->codigo = $request->codigo;
        $detVenta->descripcion = $request->descripcion;
        $detVenta->cantidad = $request->cantidad;
        $detVenta->precio = $request->precio;
        $detVenta->precioantes = $request->precioantes;
        $detVenta->descuento = $request->descuento;
        $detVenta->importe = $request->importe;
        $detVenta->importeantes = $request->importeantes;
        $detVenta->ClaveProdServ = $request->ClaveProdServ;
        $detVenta->NoIdentificacion = $request->NoIdentificacion;
        $detVenta->ClaveUnidad = $request->ClaveUnidad;
        $detVenta->Unidad = $request->Unidad;
        $detVenta->ObjetoImp = $request->ObjetoImp;

        // Guardar los cambios
        $detVenta->save();
        
        return response()->json(['success' => true, 'message' => 'Detalle actualizado correctamente']);
    }
    //Funcion para eliminar un detalle de venta
    public function eliminarDetalle(Request $request)
    {
        $detVenta = \App\Models\DetVenta::find($request->id);
        if (!$detVenta) {
            return response()->json(['success' => false, 'message' => 'Detalle no encontrado'], 404);
        }
        
        $detVenta->delete();
        
        return response()->json(['success' => true, 'message' => 'Detalle eliminado correctamente']);
    }
    //funcion para consultar un detalle de venta
    public function consultarDetalle(Request $request)
    {
        $detVenta = \App\Models\DetVenta::find($request->id);
        if (!$detVenta) {
            return response()->json(['success' => false, 'message' => 'Detalle no encontrado'], 404);
        }
        
        return response()->json(['success' => true, 'data' => $detVenta]);
    }
    //funcion para consultar un detalle de venta por id de venta
    public function consultarDetallesPorVenta(Request $request)
    {
        $detVentas = \App\Models\DetVenta::where('idventa', $request->idventa)->get();
        if ($detVentas->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No se encontraron detalles para esta venta'], 404);
        }
        
        return response()->json(['success' => true, 'data' => $detVentas]);
    }
    //Funcion para descontar un detalle de venta
    public function descontarDetalle(Request $request)
    {
        $detVenta = \App\Models\DetVenta::find($request->id);
        if (!$detVenta) {
            return response()->json(['success' => false, 'message' => 'Detalle no encontrado'], 404);
        }
        
        // Descontar la cantidad del detalle
        $detVenta->cantidad -= $request->cantidad;
        if ($detVenta->cantidad < 0) {
            return response()->json(['success' => false, 'message' => 'Cantidad no puede ser negativa'], 400);
        }
        
        // Guardar los cambios
        $detVenta->save();
        
        return response()->json(['success' => true, 'message' => 'Detalle descontado correctamente']);
    }
    //Funcion para agregar un cantidad mas de un producto registrado en un detalle de venta
    public function agregarCantidadDetalle(Request $request)
    {
        $detVenta = \App\Models\DetVenta::find($request->id);
        if (!$detVenta) {
            return response()->json(['success' => false, 'message' => 'Detalle no encontrado'], 404);
        }        
        // Aumentar la cantidad del detalle
        $detVenta->cantidad += $request->cantidad;
        
        // Guardar los cambios
        $detVenta->save();
        
        return response()->json(['success' => true, 'message' => 'Cantidad agregada correctamente al detalle']);
    }
    //funcion para descontar de inventario un producto de un detalle de venta
    public function descontarInventario(Request $request)
    {
        $detVenta = \App\Models\DetVenta::find($request->id);
        if (!$detVenta) {
            return response()->json(['success' => false, 'message' => 'Detalle no encontrado'], 404);
        }
        
        // Lógica para descontar del inventario
        $producto = \App\Models\Producto::find($detVenta->idproducto);
        if (!$producto) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
        }
        
        $producto->cantidad -= $detVenta->cantidad;
        if ($producto->cantidad < 0) {
            return response()->json(['success' => false, 'message' => 'Cantidad en inventario insuficiente'], 400);
        }
        
        // Guardar los cambios
        $producto->save();
        
        return response()->json(['success' => true, 'message' => 'Inventario descontado correctamente']);
    }
}
