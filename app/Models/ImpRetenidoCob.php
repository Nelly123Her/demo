<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpRetenidoCob extends Model
{
    protected $table = 'impretenidocob';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [
      
        'id',
		'uuid',
		'idventa',
		'idproducto',
		'base',
		'impuesto',
	 	'tipofactor',
		'tasaocuota',
		'importe'];

	// Define any relationships if necessary
	// For example, if this model relates to a Venta model:
	// public function venta()
	// {
	//     return $this->belongsTo(Venta::class, 'idventa');
	// }
	
	// You can also define other methods or scopes as needed
}
