<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
   public function CatalogoClientes(Request $Acceso)
    {
       if($Acceso->id>0){
            $obtener = Cliente::where('id', (int)$Acceso->id)
            ->orderBy('id')
            ->get();
       } else {
        $obtener = Cliente::orderBy('id')->get();
       }
       
        return response()->json(['Succes' => true, "Data" => $obtener], 200);
    }
    public function AgregarCliente(Request $Acceso)
     {
          $cliente = new Cliente();
          $cliente->razon=$Acceso->razon;
          $cliente->rfc=$Acceso->rfc; 
          $cliente->domiciliofiscalreceptor = $Acceso->DomicilioFiscalReceptor;
          $cliente->residenciafiscal = $Acceso->ResidenciaFiscal;
          $cliente->numregidtrib = $Acceso->NumRegIdTrib;
          $cliente->regimenfiscalreceptor = $Acceso->RegimenFiscalReceptor;
          $cliente->usocfdi = $Acceso->UsoCFDI;
    
          // Campos adicionales
          $cliente->limitecred = $Acceso->limitecred ?? 0; // Valor por defecto si no se proporciona
          $cliente->diascred = $Acceso->diascred ?? 0; // Valor por defecto si no se proporciona
          $cliente->direccion = $Acceso->direccion ?? ''; // Valor por defecto si no se proporciona
          $cliente->celular = $Acceso->celular ?? ''; // Valor por defecto si no se proporciona
          $cliente->usocfdi = $Acceso->usocfdi ?? ''; // Valor por defecto si no se proporciona
          $cliente->telefono = $Acceso->telefono ?? ''; // Valor por defecto si no se proporciona
          $cliente->email = $Acceso->email ?? ''; // Valor por defecto si no se proporciona
          if (Cliente::where('rfc', $cliente->rfc)->exists()) {
              return response()->json(['Succes' => false, "Data" => "El RFC ya está registrado"], 400);
          } 
          $cliente->save();
    
          return response()->json(['Succes' => true, "Data" => "Cliente creado correctamente"], 200);
     }
    public function ActualizarCliente(Request $Acceso)
    {
        $cliente = Cliente::find($Acceso->id);
        if (!$cliente) {
            return response()->json(['Succes' => false, "Data" => "Cliente no encontrado"], 404);
        }
        
        $cliente->razon = $Acceso->razon;
        $cliente->rfc = $Acceso->rfc; 
        $cliente->domiciliofiscalreceptor = $Acceso->DomicilioFiscalReceptor;
        $cliente->residenciafiscal = $Acceso->ResidenciaFiscal;
        $cliente->numregidtrib = $Acceso->NumRegIdTrib;
        $cliente->regimenfiscalreceptor = $Acceso->RegimenFiscalReceptor;
        $cliente->usocfdi = $Acceso->UsoCFDI;

        // Campos adicionales
        $cliente->limitecred = $Acceso->limitecred ?? 0; // Valor por defecto si no se proporciona
        $cliente->diascred = $Acceso->diascred ?? 0; // Valor por defecto si no se proporciona
        $cliente->direccion = $Acceso->direccion ?? ''; // Valor por defecto si no se proporciona
        $cliente->celular = $Acceso->celular ?? ''; // Valor por defecto si no se proporciona
        $cliente->usocfdi = $Acceso->usocfdi ?? ''; // Valor por defecto si no se proporciona
        $cliente->telefono = $Acceso->telefono ?? ''; // Valor por defecto si no se proporciona
        $cliente->email = $Acceso->email ?? ''; // Valor por defecto si no se proporciona
        
        if (Cliente::where('rfc', $cliente->rfc)->where('id', '!=', $cliente->id)->exists()) {
            return response()->json(['Succes' => false, "Data" => "El RFC ya está registrado"], 400);
        } 
        
        $cliente->save();
        
        return response()->json(['Succes' => true, "Data" => "Cliente actualizado correctamente"], 200);
    }
    public function EliminarCliente(Request $Acceso)
    {
        $cliente = Cliente::find($Acceso->id);
        if (!$cliente) {
            return response()->json(['Succes' => false, "Data" => "Cliente no encontrado"], 404);
        }
        
        $cliente->delete();
        
        return response()->json(['Succes' => true, "Data" => "Cliente eliminado correctamente"], 200);
    }
    public function Buscar(Request $Acceso)
    {
        $buscar = $Acceso->buscar;
        $clientes = Cliente::where('razon', 'LIKE', "%{$buscar}%")
            ->orWhere('rfc', 'LIKE', "%{$buscar}%")
            ->orderBy('id')
            ->get();
        
        return response()->json(['Succes' => true, "Data" => $clientes], 200);
    }
    public function ConsultarIds(Request $Acceso)
    {
        $buscar = $Acceso->ids;
        $clientes = Cliente::whereIn('id', $buscar)
            ->orderBy('id')
            ->get();
        
        return response()->json(['Succes' => true, "Data" => $clientes], 200);
    }
}
