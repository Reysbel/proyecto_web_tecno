<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'encargado',
        'editorial',
        'ci',
        'telefono',
        'correo',
        'direccion',
        'estado'
    ];
}
