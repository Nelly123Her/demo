<?php

namespace App\Http\Controllers\Ventas;

use App\DataTables\NotasDeVentaDataTable;
use App\Http\Controllers\Controller;

class NotasDeVentaController extends Controller
{
    public function index(NotasDeVentaDataTable $dataTable)
    {
        return $dataTable->render('ventas.notas-de-venta.index');
    }
}