<?php

namespace App\Notifications;

use App\Models\Email;
use App\Models\Setting;
use App\Notifications\Channels\Ses;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FootballerWelcomeEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var object
     */
    public $settings;

    public $type = Email::TYPE_WELCOME;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->queue = 'notifications';
        $this->settings = (new Setting())
            ->where('meta_key', 'frontend')
            ->first();
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
        $mailPage = insertVariables(
            [
                'name' => data_get($notifiable, 'name'),
                'first_name' => data_get($notifiable, 'first_name'),
                'last_name' => data_get($notifiable, 'last_name'),
            ],
            $this->settings->meta_value['welcome_mail'],
        );

        return (new MailMessage())
            ->subject('Parabéns, seu cadastro na Inv Pro foi concluído com sucesso!')
            ->view('vendor.mail.html.welcome_message', [
                'emailPage' => $mailPage,
            ]);
    }
}
