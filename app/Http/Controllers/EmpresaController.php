<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
  

    public function Actualizar(Request $request)
    {
        // Validate the request data
        $request->validate([           
            'nombre' => 'required|string|max:255',
            'rfc' => 'required|string|max:13',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);
        
        $Empresa = Empresa::find($request->id);
        if (!$Empresa) {
            return response()->json(['success' => false, 'data' => 'Company not found'], 404);
        }
        // Update the company details
        $Empresa->nombre = $request->nombre;
        $Empresa->rfc = $request->rfc;
        $Empresa->direccion = $request->direccion;
        $Empresa->telefono = $request->telefono;
        $Empresa->email = $request->email;
        // Save the updated company
        $Empresa->save();
        return response()->json(['success' => true, 'data' => 'Company updated successfully'], 200);
    }

    public function Catalogo(Request $request)
    {
        // Implement logic to retrieve company catalog
        //select * from empresas where status=1;
        $Obtener = Empresa::where('status', 1)->get();
        if ($Obtener->isEmpty()) {
            return response()->json(['success' => false, 'data' => 'No active companies found'], 404);
        }
        // Return the company catalog
        return response()->json(['success' => true, 'data' => $Obtener], 200);
    }

    
}
