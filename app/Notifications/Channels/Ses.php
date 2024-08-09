<?php

namespace App\Notifications\Channels;

use App\Models\Email;
use App\Models\EmailActivity;
use App\Repositories\EmailActivityRepository;
use App\Repositories\EmailRepository;
use Aws\Credentials\Credentials;
use Aws\Exception\AwsException;
use Aws\Ses\SesClient;
use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class Ses
{
    private $char_set = 'UTF-8';
    private $client;
    private $html;
    private $to;
    private $plaintext;
    private $response;
    private $sender;
    private $subject;
    private $request;
    private $notifiable;
    private $notification;
    private $email;
    private $replyTo;

    /**
     * Send the given notification.
     *
     * @param $notifiable
     *
     * @throws Exception
     */
    public function send($notifiable, Notification $notification)
    {
        if (config('app.env') === 'local' || config('app.env') === 'staging') {
            return true;
        }

        /* @noinspection PhpUndefinedMethodInspection */
        $this->authenticate();

        $message = $notification->toSes($notifiable);
        $this->notifiable = $notifiable;
        $this->notification = $notification;
        $this->html = $message->render();
        $this->subject = $message->subject;
        $this->to = data_get($notifiable, 'routes.mail') ?? (isset($notifiable->name) ? $notifiable->name.'<'.$notifiable->email.'>' : $notifiable->email);
        $this->replyTo = data_get($message->replyTo, '0') ? [data_get($message->replyTo, '0.1').' <'.data_get($message->replyTo, '0.0').'>'] : [$this->sender];

        $this->sendData();
    }

    /**
     * Authenticate to ses.
     */
    public function authenticate()
    {
        $this->client = new SesClient([
            'credentials' => new Credentials(
                config('services.ses.key'),
                config('services.ses.secret')
            ),
            'version' => '2010-12-01',
            'region' => config('services.ses.region'),
        ]);
        $this->sender = config('mail.from.name').'<'.config('mail.from.address').'>';
    }

    private function validate()
    {
        if (!$this->html) {
            throw new \Exception('Html is missing and is a required parameter');
        }

        if (!$this->subject) {
            throw new \Exception('Subject is missing and is a required parameter');
        }

        if (!$this->to) {
            throw new \Exception('Recipent is missing and is a required parameter');
        }
    }

    private function createEmail($status)
    {
        if (get_class($this->notifiable) == 'Illuminate\Notifications\AnonymousNotifiable') {
            return $this;
        }

        try {
            $emailAttributes = [];
            $emailAttributes['notifiable_id'] = $this->notifiable->id;
            $emailAttributes['notifiable_type'] = get_class($this->notifiable);
            $emailAttributes['type'] = data_get($this->notification, 'type');
            $emailAttributes['reference_id'] = data_get($this->notification, 'resource') ? data_get($this->notification, 'resource.id') : null;
            $emailAttributes['reference_type'] = data_get($this->notification, 'resource') ? get_class(data_get($this->notification, 'resource')) : null;
            $emailAttributes['title'] = $this->subject;
            $emailAttributes['html'] = $this->html;
            $emailAttributes['message_id'] = $this->messageId();
            $emailAttributes['status'] = $status;

            $email = (new EmailRepository())->create($emailAttributes);

            $emailActivityAttributes = [];
            $emailActivityAttributes['email_id'] = $email->id;
            $emailActivityAttributes['activity'] = EmailActivity::ACTIVITY_SEND;
            $emailActivityAttributes['meta'] = $this->response;

            (new EmailActivityRepository())->create($emailActivityAttributes);
        } catch(\Exception $e) {
            logger()->error("Error email on database insertion: " . $e->getMessage());
            throw $e;
        }

        return $this;
    }

    /**
     * Send ses e-mail.
     *
     * @return bool
     *
     * @throws Exception
     */
    private function sendData()
    {
        $this->validate();

        try {
            $response = $this->client->sendEmail($this->request());
            $this->response = json_encode($response->toArray());
            $this->createEmail(Email::STATUS_SENT);
        } catch (AwsException $e) {
            $this->response = json_encode($e->toArray());
            $this->createEmail(Email::STATUS_FAIL);
        }

        return $this;
    }

    private function request()
    {
        $this->request = [
            'ReplyToAddresses' => $this->replyTo,
            'Source' => $this->sender,
            'Message' => [
                'Body' => [
                    'Html' => [
                        'Charset' => $this->char_set,
                        'Data' => $this->html,
                    ],
                ],
                'Subject' => [
                    'Charset' => $this->char_set,
                    'Data' => $this->subject,
                ],
            ],
        ];

        data_set($this->request, 'Destination', [
            'ToAddresses' => [$this->to],
        ]);

        if ($this->plaintext) {
            data_set($this->request, 'Message.Body.Text', [
                'Charset' => $this->char_set,
                'Data' => $this->plaintext,
            ]);
        }

        return $this->request;
    }

    private function response()
    {
        return $this->response;
    }

    private function messageId()
    {
        return data_get(json_decode($this->response), 'MessageId');
    }
}
