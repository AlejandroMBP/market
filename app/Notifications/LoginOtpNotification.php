<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginOtpNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly string $code)
    {

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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Codigo OTP de acceso')
            ->greeting('Verificacion de acceso')
            ->line('Usa este codigo para completar tu inicio de sesion:')
            ->line($this->code)
            //->action('Notification Action', url('/'))
            ->line('El codigo vence en '.config('two_factor.expires_minutes'). 'minutos.');
    }

}
