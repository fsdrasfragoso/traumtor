<?php

namespace App\Http\Controllers\Admin;

use App\Models\Webhook;
use App\Repositories\WebhookRepository;

class WebhookController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Webhook::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = WebhookRepository::class;
}
