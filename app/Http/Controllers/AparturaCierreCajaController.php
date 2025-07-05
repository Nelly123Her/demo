<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AparturaCierreCajaController extends Controller
{
    //funcion para registrar una apertura de caja pasando como parametro idcaja, idusuario, fechaapertura, folioinicial, foliofin, tcdolar
    public function registrarApertura(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'idcaja' => 'required|integer',
            'idusuario' => 'required|integer',
            'fechaapertura' => 'required|date',
            'folioinicial' => 'required|integer',
            'foliofin' => 'required|integer',
            'tcdolar' => 'required|numeric',
        ]);

        // Crear una nueva instancia del modelo AperturaCierreCaja
        $apertura = new \App\Models\AperturaCierreCaja();
        $apertura->idcaja = $request->idcaja;
        $apertura->idusuario = $request->idusuario;
        $apertura->fechaapertura = $request->fechaapertura;
        $apertura->folioinicial = $request->folioinicial;
        $apertura->foliofin = $request->foliofin;
        $apertura->tcdolar = $request->tcdolar;
        $apertura->status = 1; // 1 para apertura

        // Guardar la apertura en la base de datos
        if ($apertura->save()) {
            return response()->json(['message' => 'Apertura registrada correctamente'], 201);
        } else {
            return response()->json(['message' => 'Error al registrar la apertura'], 500);
        }
    }
    //funcion para realizar el cierre de cada pasando como parametro el id de la apertura, foliofinal y poner el status a 2 
    public function registrarCierre(Request $request)
    {
        
       // Buscar la apertura por ID
        $apertura = \App\Models\AperturaCierreCaja::find($request->id);
        if (!$apertura) {
            return response()->json(['message' => 'Apertura no encontrada'], 404);
        }

        // Actualizar los campos necesarios para el cierre
        $apertura->fechacierre = $request->fechacierre;
        $apertura->efectivo = $request->efectivo;
        $apertura->cobradoefectivo = $request->cobradoefectivo;
        $apertura->cobradotarjeta = $request->cobradotarjeta;
        $apertura->pagoproveedores = $request->pagoproveedores;
        $apertura->salidaefectivo = $request->salidaefectivo;
        $apertura->efectivoencaja = $request->efectivoencaja;
        $apertura->foliofin = $request->foliofin;
        $apertura->status = 2; // 2 para cierre

        // Guardar el cierre en la base de datos
        if ($apertura->save()) {
            return response()->json(['message' => 'Cierre registrado correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al registrar el cierre'], 500);
        }
    }
    //funcion para actualizar una apertura o cierre de caja pasando como parametro el id, idcaja, idusuario, fechaapertura, fechacierre, efectivo, cobradoefectivo, cobradotarjeta, pagoproveedores, salidaefectivo, efectivoencaja, folioinicial, foliofin, tcdolar y status
    public function actualizarAperturaCierre(Request $request)
    {
        // Buscar la apertura o cierre por ID
        $apertura = \App\Models\AperturaCierreCaja::find($request->id);
        if (!$apertura) {
            return response()->json(['message' => 'Apertura/Cierre no encontrado'], 404);
        }
        // Actualizar los campos necesarios
        $apertura->idcaja = $request->idcaja;
        $apertura->idusuario = $request->idusuario;
        $apertura->fechaapertura = $request->fechaapertura;
        $apertura->fechacierre = $request->fechacierre;
        $apertura->efectivo = $request->efectivo;
        $apertura->cobradoefectivo = $request->cobradoefectivo;
        $apertura->cobradotarjeta = $request->cobradotarjeta;
        $apertura->pagoproveedores = $request->pagoproveedores;
        $apertura->salidaefectivo = $request->salidaefectivo;
        $apertura->efectivoencaja = $request->efectivoencaja;
        $apertura->folioinicial = $request->folioinicial;
        $apertura->foliofin = $request->foliofin;
        $apertura->status= $request->status; // 1 para apertura, 2 para cierre
        // Guardar los cambios en la base de datos
        if ($apertura->save()) {
            return response()->json(['message' => 'Apertura/Cierre actualizado correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al actualizar la apertura/cierre'], 500);
        }
    }   
}