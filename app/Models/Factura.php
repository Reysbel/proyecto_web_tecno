<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas'; // Nombre correcto de la tabla

    protected $primaryKey = 'id_factura';

    protected $fillable = [
        'user_id',
        'id_cliente',
        'id_lcliente',
        'nit',
        'fecha',
        'hora',
        'sub_total',
        'descuento',
        'total_factura',
        'tipo_cliente',
        'metodo_pago',
        'estado_factura',
        'pedido_estado',
        'listo',
    ];

    /**
     * Obtener el vendedor asociado con la factura.
     */
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtener el cliente asociado con la factura.
     */
    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }

    /**
     * Obtener el cliente local asociado con la factura.
     */
    public function lcliente()
    {
        return $this->belongsTo(LCliente::class, 'id_lcliente');
    }

    /**
     * Obtener los detalles de la factura.
     */
    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'id_factura');
    }

    /**
     * Obtener el pedido web asociado con la factura.
     */
    public function pedidoWeb()
    {
        return $this->hasOne(PedidoWeb::class, 'id_factura');
    }

 
}
