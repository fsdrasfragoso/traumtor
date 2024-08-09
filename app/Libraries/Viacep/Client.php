<?php

namespace App\Libraries\Viacep;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private $client;

    public function __construct()
    {
        $this->client = new GuzzleClient([
            'base_uri' => config('services.viacep.url'),
        ]);
    }

    public function __call($method, $args)
    {
        if (count($args) < 1) {
            throw new \InvalidArgumentException(
                'Magic request methods require a URI and optional options array'
            );
        }

        $uri = $args[0];
        $opts = data_get($args, '1', []);

        return $this->request($method, $uri, $opts);
    }

    public function request($method, $uri, $options)
    {
        $response = $this->client->request($method, $uri, $options);

        $jsonResponse = json_decode($response->getBody(), true);
        if (empty($jsonResponse)) {
            return [];
        }

        return $jsonResponse;
    }
}
