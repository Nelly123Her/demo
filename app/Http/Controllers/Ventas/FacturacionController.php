<?php

namespace App\Http\Controllers\Ventas;

use App\DataTables\FacturacionDataTable;

class FacturacionController
{
    public function index(FacturacionDataTable $dataTable)
    {
        return $dataTable->render('ventas.facturacion-4-0.index');
    }
}