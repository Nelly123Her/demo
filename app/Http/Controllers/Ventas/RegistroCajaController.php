<?php

namespace App\Http\Controllers\Ventas;
use App\DataTables\RegistroCajaDataTable;
use App\Http\Controllers\Controller;
use App\Models\RegistroCaja;
use Illuminate\Http\Request;

class RegistroCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(RegistroCajaDataTable $dataTable)
{
  

    return $dataTable->render('ventas.registro-en-caja.index');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ventas.registro-en-caja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $registro = RegistroCaja::create($request->all());
        return redirect()->route('ventas.registro-en-caja.index')
                         ->with('success', 'Registro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RegistroCaja $registro_en_caja)
    {
        return view('ventas.registro-en-caja.show', compact('registro_en_caja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegistroCaja $registro_en_caja)
    {
        return view('ventas.registro-en-caja.edit', compact('registro_en_caja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegistroCaja $registro_en_caja)
    {
        $registro_en_caja->update($request->all());

        return redirect()->route('ventas.registro-en-caja.index')
                         ->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistroCaja $registro_en_caja)
    {
        $registro_en_caja->delete();

        return redirect()->route('ventas.registro-en-caja.index')
                         ->with('success', 'Registro eliminado correctamente.');
    }
}
