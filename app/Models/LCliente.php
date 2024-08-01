<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LCliente extends Model
{
    use HasFactory;

    protected $table = 'lclientes'; // Nombre correcto de la tabla

    protected $primaryKey = 'id_lcliente';

    protected $fillable = [
        'nombre',
        'celular',
        'correo',
    ];

    /**
     * Obtener las facturas asociadas con el cliente local.
     */
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'id_lcliente');
    }
}
