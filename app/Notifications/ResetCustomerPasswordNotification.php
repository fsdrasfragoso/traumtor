<?php

namespace App\Notifications;

use App\Models\Email;
use App\Notifications\Channels\Ses;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetFootballerPasswordNotification extends ResetPassword implements ShouldQueue
{
    use Queueable;

    public $type = Email::TYPE_PASSWORD_RECOVERY;

    /**
     * ResetFootballerPasswordNotification constructor.
     */
    public function __construct(string $token)
    {
        parent::__construct($token);

        $this->queue = 'notifications';
    }

    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     *
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage())
            ->subject(__('Link de recuperação de senha'))
            ->line(__('Você está recebendo esse e-mail porque nós recebemos uma solicitação de recuperação de senha para a sua conta.'))
            ->action(__('Alterar Senha'), url(config('app.url').route('web.frontend.password.reset', $this->token, false)))
            ->line(__('Se você não solicitou a recuperação de senha, nenhuma outra ação é necessária.'));
    }
}
