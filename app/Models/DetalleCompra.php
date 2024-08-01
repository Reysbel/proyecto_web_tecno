<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $table = 'detalle_compras';

    protected $fillable = [
        'cantidad',
        'total',
        'id_producto',
        'id_compra'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }
}
