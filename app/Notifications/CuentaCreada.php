<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CuentaCreada extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
  /*  public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('¡Bienvenido a QUA!')
                    ->line('Gracias por registrarte en nuestra aplicación.')
                    ->action('Iniciar Sesion', url('/'))
                    ->line('¡Esperamos que disfrutes usando nuestra plataforma!');
    }*/
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->view('email.cuentaCreada', ['user' => $notifiable]);
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
