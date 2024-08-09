<?php

namespace App\Services;

use Carbon\Carbon;
use App\Jobs\Webhook\ProcessWebhook;
use App\Models\Email;
use App\Models\EmailActivity;
use App\Models\Webhook;
use App\Repositories\EmailActivityRepository;
use App\Repositories\WebhookRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SesService
{
    /**
     * @param $data
     */
    public function createWebhook($data)
    {
        $body = data_get($data, 'body');
        $message = data_get(json_decode($body), 'Message');
        $mail = data_get(json_decode($message), 'mail');

        $attributes = [];
        $attributes['payment_gateway'] = 'ses';
        $attributes['type'] = Str::lower(data_get(json_decode($message), 'notificationType'));
        $attributes['data'] = $data;
        $attributes['checksum'] = md5(json_encode($data));
        $attributes['reference_type'] = 'message';
        $attributes['reference_id'] = data_get($mail, 'messageId');

        /** @var Webhook $webhook */
        $webhook = (new WebhookRepository())->create($attributes);

        dispatch(new ProcessWebhook($webhook));

        return $webhook;
    }

    public function processWebhook(Webhook $webhook)
    {
        if (!$webhook->processed) {
            $type = Str::camel($webhook->type);

            if (method_exists($this, $type)) {
                $this->{$type}($webhook);
            }

            $webhook->processed = true;
            $webhook->save();
        }
    }

    public function delivery(Webhook $webhook)
    {
        $email = Email::where('message_id', data_get($webhook, 'reference_id'))->first();

        if (!$email) {
            logger()->error('E-mail com message_id = '. data_get($webhook, 'reference_id') .' não encontrado.');
            return;
        }

        $attributes = [];
        $attributes['email_id'] = $email->id;
        $attributes['activity'] = EmailActivity::ACTIVITY_DELIVERY;
        $attributes['meta'] = json_encode(data_get($webhook, 'data'));

        (new EmailActivityRepository())->create($attributes);

        $email->status = Email::STATUS_DELIVERED;
        $email->save();
    }

    public function complaint(Webhook $webhook)
    {
        $email = Email::where('message_id', data_get($webhook, 'reference_id'))->first();

        if (!$email) {
            logger()->error('E-mail com message_id = '. data_get($webhook, 'reference_id') .' não encontrado.');
            return;
        }

        $attributes = [];
        $attributes['email_id'] = $email->id;
        $attributes['activity'] = EmailActivity::ACTIVITY_COMPLAINT;
        $attributes['meta'] = json_encode(data_get($webhook, 'data'));

        (new EmailActivityRepository())->create($attributes);
    }

    public function bounce(Webhook $webhook)
    {
        $email = Email::where('message_id', data_get($webhook, 'reference_id'))->first();

        if (!$email) {
            logger()->error('E-mail com message_id = '. data_get($webhook, 'reference_id') .' não encontrado.');
            return;
        }

        $attributes = [];
        $attributes['email_id'] = $email->id;
        $attributes['activity'] = EmailActivity::ACTIVITY_BOUNCE;
        $attributes['meta'] = json_encode(data_get($webhook, 'data'));

        (new EmailActivityRepository())->create($attributes);

        $email->status = Email::STATUS_REJECTED;
        $email->save();
    }
}
