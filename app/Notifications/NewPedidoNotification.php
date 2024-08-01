<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewPedidoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $pedido;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\PedidoWeb  $pedido
     * @return void
     */
    public function __construct($pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Nuevo pedido creado.')
                    ->action('Ver Pedido', url('/pedidos/' . $this->pedido->id_pedido))
                    ->line('Gracias por usar nuestra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id_pedido' => $this->pedido->id_pedido,
            'mensaje' => 'Nuevo pedido creado.',
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id_pedido' => $this->pedido->id_pedido,
            'mensaje' => 'Nuevo pedido creado.',
        ]);
    }
}
