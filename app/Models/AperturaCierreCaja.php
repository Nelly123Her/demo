<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AperturaCierreCaja extends Model
{
    protected $table = 'aperturacierrecaja';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';    
    protected $fillable = [
        'id',
        'idcaja',
        'idusuario',
        'fechaapertura',
        'fechacierre',
        'efectivo',
        'cobradoefectivo',
        'cobradotarjeta',
        'pagoproveedores',
        'salidaefectivo',
        'efectivoencaja',
        'folioinicial',
        'foliofin',
        'tcdolar',
        'status'
    ];
}
