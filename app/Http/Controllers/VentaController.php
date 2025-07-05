<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    //Funcion para crear una venta
    public function crearVenta(Request $Acceso)
    {        
        $venta = new Venta();
        $venta->idserie = $Acceso->idserie;
        $venta->idapecierre = $Acceso->idapecierre;
        $venta->idservicio = $Acceso->idservicio;
        $venta->idusuario = $Acceso->idusuario;          
        $venta->idcliente = $Acceso->idcliente;
        $venta->folio = $Acceso->folio; // Asegúrate de encriptar la contraseña
        $venta->fecha = $Acceso->fecha;
        $venta->efectivo = $Acceso->efectivo;
        $venta->cambio = $Acceso->cambio;
        $venta->pagado = $Acceso->pagado;
        $venta->moneda = $Acceso->moneda;
        $venta->formapago = $Acceso->formapago;
        $venta->subtotal = $Acceso->subtotal;
        $venta->iva = $Acceso->iva;
        $venta->total = $Acceso->total;
        $venta->observacion = $Acceso->observacion;
        $venta->save();
        return response()->json(['Succes' => true, "Data" => "Venta creado correctamente"], 200);
    }
    // funcion para actualizar una venta
    public function actualizarVenta(Request $Acceso)
    {
        $venta = Venta::find($Acceso->id);
        if (!$venta) {
            return response()->json(['Succes' => false, "Data" => "Venta no encontrada"], 404);
        }

        $venta->idserie = $Acceso->idserie;
        $venta->idapecierre = $Acceso->idapecierre;
        $venta->idservicio = $Acceso->idservicio;
        $venta->idusuario = $Acceso->idusuario;          
        $venta->idcliente = $Acceso->idcliente;
        $venta->folio = $Acceso->folio; // Asegúrate de encriptar la contraseña
        $venta->fecha = $Acceso->fecha;
        $venta->efectivo = $Acceso->efectivo;
        $venta->cambio = $Acceso->cambio;
        $venta->pagado = $Acceso->pagado;
        $venta->moneda = $Acceso->moneda;
        $venta->formapago = $Acceso->formapago;
        $venta->subtotal = $Acceso->subtotal;
        $venta->iva = $Acceso->iva;
        $venta->total = $Acceso->total;
        $venta->observacion = $Acceso->observacion;

        // Guardar los cambios
        $venta->save();
        
        return response()->json(['Succes' => true, "Data" => "Venta actualizada correctamente"], 200);
    }
    // funcion para eliminar una venta
    public function eliminarVenta(Request $Acceso)
    {
        $venta = Venta::find($Acceso->id);
        if (!$venta) {
            return response()->json(['Succes' => false, "Data" => "Venta no encontrada"], 404);
        }
        $venta->delete();
        return response()->json(['Succes' => true, "Data" => "Venta eliminada correctamente"], 200);
    }
    // funcion para consultar una venta
    public function consultarVenta(Request $Acceso)
    {
        $venta = Venta::find($Acceso->id);
        if (!$venta) {
            return response()->json(['Succes' => false, "Data" => "Venta no encontrada"], 404);
        }
        return response()->json(['Succes' => true, "Data" => $venta], 200);
    }
    // funcion para consultar todas las ventas
    public function consultarTodasVentas()
    {
        $ventas = Venta::all();
        if ($ventas->isEmpty()) {
            return response()->json(['Succes' => false, "Data" => "No se encontraron ventas"], 404);
        }
        return response()->json(['Succes' => true, "Data" => $ventas], 200);
    }
    // funcion para consultar ventas por cliente
    public function consultarVentasPorCliente(Request $Acceso)
    {
        $ventas = Venta::where('idcliente', $Acceso->idcliente)->get();
        if ($ventas->isEmpty()) {
            return response()->json(['Succes' => false, "Data" => "No se encontraron ventas para este cliente"], 404);
        }
        return response()->json(['Succes' => true, "Data" => $ventas], 200);
    }
    // funcion para consultar ventas por rango de fechas
    public function consultarVentasPorFecha(Request $Acceso)
    {
        $ventas = Venta::whereBetween('fecha', [$Acceso->fecha_inicio, $Acceso->fecha_fin])->get();
        if ($ventas->isEmpty()) {
            return response()->json(['Succes' => false, "Data" => "No se encontraron ventas en este rango de fechas"], 404);
        }
        return response()->json(['Succes' => true, "Data" => $ventas], 200);
    }
    //funcion para consultar las ventas activas status = 1
    public function consultarVentasActivas()
    {
        $ventas = Venta::where('status', 1)->get();
        if ($ventas->isEmpty()) {
            return response()->json(['Succes' => false, "Data" => "No se encontraron ventas activas"], 404);
        }
        return response()->json(['Succes' => true, "Data" => $ventas], 200);
    }
    //funcion para consultar lo cobrado status=2 con parametros de idusuario, idpaecierre y si se envia la forma de pago
    public function consultarCobrado(Request $Acceso)
    {
        $query = Venta::where('status', 2)
            ->where('idusuario', $Acceso->idusuario)
            ->where('idapecierre', $Acceso->idapecierre);

        if (isset($Acceso->formapago)) {
            $query->where('formapago', $Acceso->formapago);
        }

        $ventas = $query->get();

        if ($ventas->isEmpty()) {
            return response()->json(['Succes' => false, "Data" => "No se encontraron ventas cobradas con los criterios especificados"], 404);
        }
        return response()->json(['Succes' => true, "Data" => $ventas], 200);
    }
    //funcion para consutlar las ventas por cobrar status = 4 da un idcliente
    public function consultarPorCobrar(Request $Acceso)
    {
        $ventas = Venta::where('status', 4)
            ->where('idcliente', $Acceso->idcliente)
            ->get();

        if ($ventas->isEmpty()) {
            return response()->json(['Succes' => false, "Data" => "No se encontraron ventas por cobrar para este cliente"], 404);
        }
        return response()->json(['Succes' => true, "Data" => $ventas], 200);
    }
    //funcion para consultar las ventas por servicio
    public function consultarVentasPorServicio(Request $Acceso)
    {
        $ventas = Venta::where('idservicio', $Acceso->idservicio)->get();
        if ($ventas->isEmpty()) {
            return response()->json(['Succes' => false, "Data" => "No se encontraron ventas para este servicio"], 404);
        }
        return response()->json(['Succes' => true, "Data" => $ventas], 200);
    }
}