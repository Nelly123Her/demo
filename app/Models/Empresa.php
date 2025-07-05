<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $filetable = [
        'id',
        'nombre',
        'razon',
        'rfc',
        'calle',
        'numext',
        'numint',
        'colonia',
        'localidad',
        'referencia',
        'municipio',
        'estado',
        'cpostal',        
        'pais',
        'direccion',
        'direccion2',
        'telefono',
        'email',
        'regimen',
        'numcert',
        'certcsd',
        'keycsd',
        'clavecsd',
        'fechacsd',
        'cancelar_cfdi',
        'pac',
        'usuario',
        'clave',	
        'timbrar_cfdi',
        'compexporta',
        'status'//Activo ->1    Eliminado->0
    ];
}
