<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaACaja extends Model
{
    protected $table = 'entradacaja';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [
        'id',
        'idcaja',
        'idusuario',
        'idapecierre',
        'concepto',
        'efectivo',
        'fecha',
        'status'
    ];
}
