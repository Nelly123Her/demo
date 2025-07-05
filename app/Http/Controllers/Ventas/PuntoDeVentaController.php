<?php

namespace App\Http\Controllers\Ventas;

use App\DataTables\PuntoDeVentaDataTable;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PuntoVenta;

class PuntoDeVentaController extends Controller
{
    public function index(PuntoDeVentaDataTable $dataTable)
    {
        return $dataTable->render('ventas.punto-de-venta.index');
    }

    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $puntoVenta = PuntoVenta::findOrFail($id);

        $path = $request->file('imagen')->store('punto_ventas', 'public');
        $puntoVenta->imagen_url = $path;
        $puntoVenta->save();

        return response()->json(['success' => true, 'message' => 'Image uploaded successfully.']);
    }
}