<?php

namespace App\Listeners;

use App\Events\PedidoWebCreated;
use App\Models\User;
use App\Notifications\NewPedidoNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPedidoNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PedidoWebCreated  $event
     * @return void
     */
    public function handle(PedidoWebCreated $event)
    {
        // Enviar notificación a los usuarios administrativos (ejemplo)
        $administrators = User::where('role', 'admin')->get();

        foreach ($administrators as $admin) {
            $admin->notify(new NewPedidoNotification($event->pedido));
        }
    }
}
