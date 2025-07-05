<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;

class VentasIndexController extends Controller
{
    public function index()
    {
        return view('ventas.index'); // You'll need to create this Blade file
    }
}