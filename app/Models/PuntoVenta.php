<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoVenta extends Model
{
    use HasFactory;

    protected $table = 'punto_ventas'; // Ensure this matches your migration

    protected $fillable = [
        'numero',         // NO (line number)
        'codigo',         // Código de producto
        'descripcion',    // Descripción del producto
        'precio_venta',   // Precio por unidad
        'cantidad',       // Cantidad vendida
        'importe',        // Subtotal = precio_venta * cantidad
        'imagen_url',     // URL de la imagen (nullable)
        'folio_venta',    // Agrupador de líneas por nota o venta (opcional)
    ];

    /**
     * Automatically calculate 'importe' if not given
     */
    protected static function booted()
    {
        static::creating(function ($venta) {
            if (is_null($venta->importe)) {
                $venta->importe = $venta->precio_venta * $venta->cantidad;
            }
        });
    }
}