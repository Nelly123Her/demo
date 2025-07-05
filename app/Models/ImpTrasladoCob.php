<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpTrasladoCob extends Model
{
     protected $table = 'imptrasladocob';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [      
        'id',
        'uuid',
        'idventa',
        'idservicio',
        'idproducto',
        'base',
        'impuesto',
        'tipofactor',
        'tasaocuota',
        'importe'
    ];
}
