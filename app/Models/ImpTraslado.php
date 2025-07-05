<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpTraslado extends Model
{
     protected $table = 'inmptraslado';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [
      
    'id',
	'clave',
	'tipofactor', 
	'tasaocuota',//0% - 100%
	'activo',//0% - 100%
	'status' ]; //Activo ->1    Eliminado->0
}
