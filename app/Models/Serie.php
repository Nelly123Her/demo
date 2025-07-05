<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'series';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [
      
        'id',
        'nombre',//serie
        //'folio',
        'descripcion',
        'logo',
        'lugarexpedicion',
        'status' //Activo ->1    Eliminado->0

    ];
}
