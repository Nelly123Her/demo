<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas'; // or 'factura' if your table is singular

    protected $fillable = [
        'serie_folio',
        'fecha_hora',
        'cliente',
        'subtotal',
        'total',
        'pagado',
        'folio_fiscal',
        'metodo_pago',
        'estado',
        'pdf',
        'xml',
    ];

    protected $casts = [
        'fecha_hora'   => 'datetime',
        'subtotal'     => 'float',
        'total'        => 'float',
        'pagado'       => 'float',
        'pdf'          => 'boolean',
        'xml'          => 'boolean',
    ];
}