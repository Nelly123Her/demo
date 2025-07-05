<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie; // Assuming you have a Serie model

class SerieController extends Controller
{
    public function Nuevo(Request $request)
    {
        $serie = new Serie();
        $serie->nombre = $request->nombre;       
        $serie->descripcion = $request->descripcion;        
        $serie->logo = $request->logo; // Assuming logo is a string or path
        $serie->lugarexpedicion = $request->lugarexpedicion;
        
        $serie->save();
        return response()->json(['success' => true, 'data' => 'Serie created successfully'], 200);
    }
    public function actualizar(Request $request)
    {
        $serie = Serie::find($request->id);
        if (!$serie) {
            return response()->json(['success' => false, 'data' => 'Serie not found'], 404);
        }

        $serie->nombre = $request->nombre;
        $serie->descripcion = $request->descripcion;
        $serie->folio = $request->folio;
        $serie->logo = $request->logo; // Assuming logo is a string or path
        $serie->lugarexpedicion = $request->lugarexpedicion;

        $serie->save();
        return response()->json(['success' => true, 'data' => 'Serie updated successfully'], 200);
    }
    public function eliminar(Request $request)
    {
        $serie = Serie::find($request->id);
        if (!$serie) {
            return response()->json(['success' => false, 'data' => 'Serie not found'], 404);
        }
        $serie->delete();
        return response()->json(['success' => true, 'data' => 'Serie deleted successfully'], 200);
    }
    public function Catalogo(Request $request)
    {
        if ($request->has('id')) {
            $serie = Serie::find($request->id);
            if (!$serie) {
                return response()->json(['success' => false, 'data' => 'Serie not found'], 404);
            }
            return response()->json(['success' => true, 'data' => $serie], 200);
        } else {
            $series = Serie::all();
            if ($series->isEmpty()) {
                return response()->json(['success' => false, 'data' => 'No series found'], 404);
            }
            return response()->json(['success' => true, 'data' => $series], 200);
        }
    }   
}
