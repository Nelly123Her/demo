<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplementoPago extends Model
{
    use HasFactory;

    protected $table = 'complemento_pago'; // ✅ override Laravel’s plural default

    protected $fillable = [
        'serie_folio',
        'fecha_hora',
        'cliente',
        'subtotal',
        'total',
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
        'pdf'          => 'boolean',
        'xml'          => 'boolean',
    ];
}