<?php

namespace App\Repositories;

use App\Models\Webhook;

class WebhookRepository extends CrudRepository
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Webhook::class;    
}
