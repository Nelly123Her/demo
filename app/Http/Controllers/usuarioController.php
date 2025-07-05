<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;

class usuarioController extends Controller
{
    public function acceso( Request $Acceso){

        $obtener =  usuario::select ('id','nombre','usuario','clave')->get();
        return response()->json(['Succes'=>true, "Data"=>$obtener],200);
    }
    public function Nuevo(Request $Acceso)
    {
        $usuario = new usuario();
        $usuario->nombre = $Acceso->nombre;
        $usuario->usuario = $Acceso->usuario;
        $usuario->grupo = $Acceso->grupo;
        $usuario->bdini = $Acceso->bdini;
        $usuario->multicfdi = $Acceso->multicfdi;        
        $usuario->idserie = $Acceso->idserie;
        $usuario->clave = bcrypt($Acceso->clave); // Asegúrate de encriptar la contraseña
        $usuario->save();

        return response()->json(['Succes' => true, "Data" => "Usuario creado correctamente"], 200);
    }
    public function Actualizar(Request $Acceso)
    {
        $usuario = usuario::find($Acceso->id);
        if (!$usuario) {
            return response()->json(['Succes' => false, "Data" => "Usuario no encontrado"], 404);
        }

        $usuario->nombre = $Acceso->nombre;
        $usuario->usuario = $Acceso->usuario;
        $usuario->grupo = $Acceso->grupo;
        $usuario->bdini = $Acceso->bdini;
        $usuario->multicfdi = $Acceso->multicfdi;
        $usuario->idserie = $Acceso->idserie;
        // Solo actualiza la contraseña si se proporciona
        // Esto es importante para no sobrescribir la contraseña si no se envía un nuevo valor
        if (isset($Acceso->clave) && !empty($Acceso->clave)) {
            $usuario->clave = bcrypt($Acceso->clave); // Asegúrate de encriptar la contraseña
        }
        $usuario->save();
        return response()->json(['Succes' => true, "Data" => "Usuario actualizado correctamente"], 200);
    }
    public function Eliminar(Request $Acceso)
    {
        $usuario = usuario::find($Acceso->id);
        if (!$usuario) {
            return response()->json(['Succes' => false, "Data" => "Usuario no encontrado"], 404);
        }
        $usuario->delete();
        return response()->json(['Succes' => true, "Data" => "Usuario eliminado correctamente"], 200);
    }

}
