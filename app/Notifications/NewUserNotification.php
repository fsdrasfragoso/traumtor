<?php

namespace App\Notifications;

use App\Models\Email;
use App\Notifications\Channels\Ses;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    protected $password;

    public $type = Email::TYPE_WELCOME;

    /**
     * Create a new notification instance.
     *
     * @param string $password
     */
    public function __construct($password)
    {
        $this->queue = 'notifications';
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject('Nova conta criada no painel do '.config('app.name'))
            ->line('Olá, '.$notifiable->name.'!')
            ->line('Seu cadastro foi criado com sucesso. Utilize o e-mail **'.$notifiable->email.'** e a senha **'.$this->password.'** para acessar a sua conta.')
            ->action('Acessar o painel', route('web.admin.login'));
    }
}
