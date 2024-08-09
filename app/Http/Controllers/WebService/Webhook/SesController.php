<?php

namespace App\Http\Controllers\WebService\Webhook;

use App\Services\SesService;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebService\Ses\StoreWebhookRequest;
use Illuminate\Http\Response;

class SesController extends Controller
{
    /**
     * Store new ses webhook
     *
     * @param StoreWebhookRequest $request
     * @return Response
     */
    public function store(StoreWebhookRequest $request)
    {
        if($webhook = (new SesService())->createWebhook($request->all())) {
            return response('success', 200);
        }

        return abort(500);
    }
}