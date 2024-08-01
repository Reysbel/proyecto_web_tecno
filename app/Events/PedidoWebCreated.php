<?php

namespace App\Events;

use App\Models\PedidoWeb;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PedidoWebCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pedido;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\PedidoWeb  $pedido
     * @return void
     */
    public function __construct(PedidoWeb $pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('pedidos');
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id_pedido' => $this->pedido->id_pedido,
            'ubicacion' => $this->pedido->ubicacion,
            'referencia_ubicacion' => $this->pedido->referencia_ubicacion,
            'telefono_referencia' => $this->pedido->telefono_referencia,
            'tiempo_demora' => $this->pedido->tiempo_demora,
            'nota' => $this->pedido->nota,
            'pedido' => $this->pedido->pedido,
            'pedido_estado' => $this->pedido->pedido_estado,
            'id_factura' => $this->pedido->id_factura,
            'id_delivery' => $this->pedido->id_delivery,
            'user_id' => $this->pedido->user_id,
            'created_at' => $this->pedido->created_at,
        ];
    }
}
