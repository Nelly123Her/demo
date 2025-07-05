<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistroCaja extends Model
{
    use HasFactory;
    protected $table = 'registro_caja'; 

    protected $fillable = [
        'fecha_apertura',
        'fecha_cierre',
        'efectivo',
        'tc_dolar',
        'estado',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'fecha_apertura' => 'datetime',
        'fecha_cierre'   => 'datetime',
    ];
}