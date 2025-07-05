<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [
        'id',
        'idserie',
        'nombre',
        'grupo' ,
        'usuario',	
        'clave',
        'bdini',
        'multicfdi',
        'status'
    ];

}
