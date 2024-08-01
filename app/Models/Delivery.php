<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliverys';
    protected $primaryKey = 'id_delivery';

    protected $fillable = [
        'nombre_apellido',
        'placa',
        'telefono',
        'ci',
    ];

    public function pedidoWebs()
    {
        return $this->hasMany(PedidoWeb::class, 'id_delivery');
    }
}