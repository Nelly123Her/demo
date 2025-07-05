<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class BitacoraController extends Controller
{
    public function Consulta(Request $Acceso)
    {
       
        //$fecha1 = date('Y-m-d',strtotime($Acceso->fecha1));

        $fecha1 = Carbon::parse($Acceso->fecha1)->format('Y-m-d');

        $fecha2 = Carbon::parse($Acceso->fecha2)->format('Y-m-d');

        //$fecha2 = $Acceso->fecha2;

        error_log("p1:" . $fecha1);
        error_log("p2:" . $fecha2);
        error_log("hhhh");

        /*$obtener = DB::select("SELECT * FROM bitacoras WHERE date(fecha) between ? and  ? ORDER BY id", [$fecha1,$fecha2]);
          return response()->json(['Succes'=>true, "Data"=>$obtener],200);*/

        $obtener = Bitacora::whereBetween('fecha', [$fecha1, $fecha2])
            ->orderBy('id')
            ->get();
        return response()->json(['Succes' => true, "Data2" => $obtener], 200);
    }
}
