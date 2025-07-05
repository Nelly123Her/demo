<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [
        'id',
        'idserie',
        'idapecierre',
        'idservicio',
        'idfactura',
        'idusuario',
        'idcliente',
        'cliente',
        'razon',        
        'folio',	 
        'fecha',
        'efectivo',
        'cambio',
        'pagado',
        'moneda',
        'formapago',	
        'subtotal',
        'iva',
        'total',
        'observacion',
        'impobs',
        'status'
    ];

    


}
