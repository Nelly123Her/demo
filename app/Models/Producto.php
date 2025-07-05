<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
     protected $table = 'productos';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [
      
      'id',
      'idcategoria',
      'claveprodserv',
      'codigo',
      'descripcion',
      'claveunidad',
      'precio',
      'precompra',
      'preciomayoreo',
      'utilidad',	
      'fraccionarancelaria',
      'invmin',
      'invmax',
      'existencia',
      'arancel',
      'tipo',
      'imagen',
      'status' //Activo ->1    Eliminado->0

    ];
}
