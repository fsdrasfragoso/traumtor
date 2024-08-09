<?php

namespace App\Http\Requests\WebService\Ses;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebhookRequest extends FormRequest
{
    /**
     * Authorizes request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->input('webhook_secret') == config('services.ses.webhook.secret');
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
     * @throws \Exception
     */
    public function handle()
    {
        try {
            if (!$body = $this->getRawBody()) {
                throw new \Exception('Empty post body!');
            }

            if (!$decoded = json_decode($body)) {
                throw new \Exception('Unable to decode JSON from post body!');
            }

            reset($decoded);
            $event = current($decoded); // get first attribute from array, e.g.: event.

            return $event;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
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
