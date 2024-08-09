<?php

namespace App\Http\Requests\WebService\Asaas;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebhookRequest extends FormRequest
{
    /**
     * Authorizes request
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->header('asaas-access-token') == config('services.asaas.webhook.secret');
    }

    public function rules()
    {
        return [];
    }

    /**
     * @var string
     */
    public $file = 'php://input';

    /**
     * @return mixed
     * @throws \Vindi\Exceptions\WebhookHandleException
     */
    public function handle()
    {
        try {
            if (! $body = $this->getRawBody()) {
                throw new \Exception('Empty post body!');
            }

            if (! $decoded = json_decode($body)) {
                throw new \Exception('Unable to decode JSON from post body!');
            }

            reset($decoded);
            $event = current($decoded); // get first attribute from array, e.g.: event.

            return $event;
        } catch (\Exception $e) {
            throw new WebhookHandleException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @return string
     */
    public function getRawBody()
    {
        return file_get_contents('php://input');
    }
}