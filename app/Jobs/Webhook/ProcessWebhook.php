<?php

namespace App\Jobs\Webhook;

use App\Models\Webhook;
use App\Services\AsaasService;
use App\Services\SesService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessWebhook implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * @var Webhook
     */
    public $webhook;

    /**
     * Create a new job instance.
     *
     * @param Webhook $webhook
     */
    public function __construct(Webhook $webhook)
    {
        $this->queue = 'webhooks';

        $this->webhook = $webhook;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $webhook = $this->webhook;

        if($webhook->payment_gateway == 'ses') {
            (new SesService())->processWebhook($webhook);
        } else {
            $paymentGateway = $webhook->paymentGateway();
            $paymentGateway->processWebhook($webhook);
        }
    }

    /**
     * Job tags
     *
     * @return array
     */
    public function tags()
    {
        $tags = [
            'webhook:' . $this->webhook->id,
            $this->webhook->payment_gateway,
            $this->webhook->type
        ];

        if($this->webhook->manual) {
            $tags[] = 'manual';
        }

        return $tags;
    }
}