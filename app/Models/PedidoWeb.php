<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\PedidoWebCreated;

class PedidoWeb extends Model
{
    use HasFactory;

    protected $table = 'pedido_web';
    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'ubicacion',
        'referencia_ubicacion',
        'telefono_referencia',
        'tiempo_demora',
        'nota',
        'pedido',
        'pedido_estado',
        'id_factura',
        'id_delivery',
        'user_id',
    ];

    protected $dispatchesEvents = [
        'created' => PedidoWebCreated::class,
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'id_delivery');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}