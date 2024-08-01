<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $table = 'detalle_facturas';

    protected $fillable = [
        'id_factura',
        'id_producto',
        'cantidad',
        'total',
    ];

    /**
     * Get the invoice associated with the detail.
     */
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }

    /**
     * Get the product associated with the detail.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
