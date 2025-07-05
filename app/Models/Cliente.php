<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
     protected $table = 'clientes';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [      
    'id',
	'nombre',
	'razon',
	'rfc',
	'domiciliofiscalreceptor',
	'residenciafiscal',
	'numregidtrib',
	'regimenfiscalreceptor',
	'usocfdi',
	'limitecred',
	'diascred',
	'direccion',
	'celular',
	'usocfdi',
	'telefono',
	'email',
	'status'
	];
}
