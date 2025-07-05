<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\DataTables\ComplementoPagoDataTable;

class ComplementosPagoController extends Controller
{
    public function index(ComplementoPagoDataTable $dataTable)
    {
        return $dataTable->render('ventas.complementos-de-pago.index');
    }
}