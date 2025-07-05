<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //funcuon para agregar una categoria
    public function agregarCategoria(Request $request)
    {
        $categoria = new \App\Models\Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        return response()->json(['success' => true, 'message' => 'Categoría agregada correctamente'], 200);
    }
    //funcion para actualizar una categoria
    public function actualizarCategoria(Request $request)
    {
        $categoria = \App\Models\Categoria::find($request->id);
        if (!$categoria) {
            return response()->json(['success' => false, 'message' => 'Categoría no encontrada'], 404);
        }

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        return response()->json(['success' => true, 'message' => 'Categoría actualizada correctamente'], 200);
    }
    //funcion para eliminar una categoria
    public function eliminarCategoria(Request $request)
    {
        $categoria = \App\Models\Categoria::find($request->id);
        if (!$categoria) {
            return response()->json(['success' => false, 'message' => 'Categoría no encontrada'], 404);
        }

        $categoria->delete();
        return response()->json(['success' => true, 'message' => 'Categoría eliminada correctamente'], 200);
    }
    //funcion para obtener todas las categorias y si se envia un id traerá una categoria especifica
    public function obtenerCategorias(Request $request)
    {
        if ($request->has('id')) {
            $categoria = \App\Models\Categoria::find($request->id);
            if (!$categoria) {
                return response()->json(['success' => false, 'message' => 'Categoría no encontrada'], 404);
            }
            return response()->json(['success' => true, 'data' => $categoria], 200);
        } else {
            $categorias = \App\Models\Categoria::all();
            return response()->json(['success' => true, 'data' => $categorias], 200);
        }
    }
    //funcion para consultar categoria por paralabra nombre
    public function consultarCategoriaPorNombre(Request $request)
    {
        $nombre = $request->input('nombre');
        if (!$nombre) {
            return response()->json(['success' => false, 'message' => 'El nombre es requerido'], 400);
        }

        $categorias = \App\Models\Categoria::where('nombre', 'like', '%' . $nombre . '%')->get();
        if ($categorias->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No se encontraron categorías con ese nombre'], 404);
        }

        return response()->json(['success' => true, 'data' => $categorias], 200);
    }
}
