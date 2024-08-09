<?php

namespace App\Libraries\Viacep;

use GuzzleHttp\Exception\ClientException;
use App\Models\Address;

class AddressRepository extends CrudRepository
{
    /**
     * Type of the resource to manage.
     *
     * @var string
    */
    protected $resourceType = Address::class;

    public function client()
    {
        return app()->make(Client::class);
    }

    public function find($zipCode)
    {
        $cep = trim(str_replace(['.', '-', ' '], '', $zipCode));

        try {
            $response = $this->client()->get("{$cep}/json");

            if(!$response || data_get($response, 'erro')) {
                return null;
            }

            $address = [
                'zip_code' => data_get($response, 'cep'),
                'street' => data_get($response, 'logradouro'),
                'neighborhood' => data_get($response, 'bairro'),
                'complement' => data_get($response, 'complemento'),
                'state' => data_get($response, 'uf'),
                'city' => data_get($response, 'localidade'),
                'city_code' => data_get($response, 'ibge'),
            ];

            return new Address($address);
        } catch (ClientException $e) {
            logger()->error($e->getResponse()->getBody());
            throw $e;
        }
    }
}
