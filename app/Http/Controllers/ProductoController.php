<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //Funcion parar crear un producto
    public function crearProducto(Request $request)
    {
        $producto = new \App\Models\Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->codigo = $request->codigo;
        $producto->save();

        return response()->json(['success' => true, 'message' => 'Producto creado correctamente'], 200);
    }
    //Funcion para actualizar un producto
    public function actualizarProducto(Request $request)
    {
        $producto = \App\Models\Producto::find($request->id);
        if (!$producto) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->codigo = $request->codigo;
        $producto->save();

        return response()->json(['success' => true, 'message' => 'Producto actualizado correctamente'], 200);
    }
    //Funcion para eliminar un producto
    public function eliminarProducto(Request $request)
    {
        $producto = \App\Models\Producto::find($request->id);
        if (!$producto) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();
        return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente'], 200);
    }
    //Funcion para obtener todos los productos y si se envia un id traerá un producto especifico
    public function obtenerProductos(Request $request)
    {
        if ($request->has('id')) {
            $producto = \App\Models\Producto::find($request->id);
            if (!$producto) {
                return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
            }
            return response()->json(['success' => true, 'data' => $producto], 200);
        } else {
            $productos = \App\Models\Producto::all();
            return response()->json(['success' => true, 'data' => $productos], 200);
        }
    }
    //funcion para buscar productos por descripcion con status=1 dado una palabra clave
    public function buscarProductosPorDescripcion(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword) {
            return response()->json(['success' => false, 'message' => 'Palabra clave no proporcionada'], 400);
        }

        $productos = \App\Models\Producto::where('descripcion', 'LIKE', '%' . $keyword . '%')
            ->where('status', 1)
            ->get();

        if ($productos->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No se encontraron productos'], 404);
        }

        return response()->json(['success' => true, 'data' => $productos], 200);
    }
    // funcion para consultar varios id de productos con status=1
    public function consultarProductosPorIds(Request $request)
    {
        $ids = $request->input('ids');
        if (!$ids || !is_array($ids)) {
            return response()->json(['success' => false, 'message' => 'IDs no proporcionados o formato incorrecto'], 400);
        }

        $productos = \App\Models\Producto::whereIn('id', $ids)
            ->where('status', 1)
            ->get();

        if ($productos->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No se encontraron productos'], 404);
        }

        return response()->json(['success' => true, 'data' => $productos], 200);
    }
    //function para consultar productos bajos de inventario existencia <= invmin
    public function consultarProductosBajosInventario()
    {
        $productos = \App\Models\Producto::where('existencia', '<=', 'invmin')
            ->where('status', 1)
            ->get();

        if ($productos->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No se encontraron productos bajos de inventario'], 404);
        }

        return response()->json(['success' => true, 'data' => $productos], 200);
    }
    //Funcion para consultar productos sin existencia o con existencia negativa
    public function consultarProductosSinExistencia()
    {
        $productos = \App\Models\Producto::where('existencia', '<=', 0)
            ->where('status', 1)
            ->get();

        if ($productos->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No se encontraron productos sin existencia'], 404);
        }

        return response()->json(['success' => true, 'data' => $productos], 200);
    }

}
