<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasDeVenta extends Model
{
    use HasFactory; 
    protected $table = 'notas_de_venta'; 
    protected $fillable = [
        'folio',
        'fecha_hora',
        'cliente',
        'servicio',
        'total',
        'pagado',
        'apertura',
        'factura',
        'estado',
    ];
}