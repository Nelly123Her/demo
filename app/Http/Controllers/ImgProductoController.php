<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImgProductoController extends Controller
{
    //funcion para dar de alta una imagen de producto
    public function store(Request $request)
    {
        // Procesar la imagen
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = $file->store('imagenes_productos', 'public');

            // Guardar en la base de datos
            $imgProducto = new \App\Models\ImgProducto();
            $imgProducto->idproducto = $request->input('idproducto');
            $imgProducto->imagen = $path;            
            $imgProducto->save();

            return response()->json(['message' => 'Imagen guardada exitosamente'], 201);
        }

        return response()->json(['message' => 'No se ha subido ninguna imagen'], 400);
    }
    //funcion para obtener todas las imagenes de un producto
    public function index($idproducto)
    {
        $imagenes = \App\Models\ImgProducto::where('idproducto', $idproducto)->get();

        if ($imagenes->isEmpty()) {
            return response()->json(['message' => 'No se encontraron imágenes para este producto'], 404);
        }

        return response()->json($imagenes, 200);
    }
    //funcion para eliminar una imagen de un producto
    public function destroy($id)
    {
        $imgProducto = \App\Models\ImgProducto::find($id);

        if (!$imgProducto) {
            return response()->json(['message' => 'Imagen no encontrada'], 404);
        }

        // Eliminar el archivo de imagen del almacenamiento
        if (Storage::disk('public')->exists($imgProducto->imagen)) {
            Storage::disk('public')->delete($imgProducto->imagen);
        }

        // Eliminar el registro de la base de datos
        $imgProducto->delete();

        return response()->json(['message' => 'Imagen eliminada exitosamente'], 200);
    }
}
