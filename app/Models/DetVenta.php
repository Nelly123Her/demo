<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetVenta extends Model
{
    protected $table = 'detventa';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [
      
        'id',
        'idventa',
        'idproducto',
        'codigo',
        'descripcion',
        'cantidad',
        'precio',
        'precioantes',
        'descuento',
        'importe',
        'importeantes',	 
        'ClaveProdServ',
        'NoIdentificacion',
        'ClaveUnidad',
        'Unidad',
        'ObjetoImp'
    ];
}
