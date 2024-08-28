<?php

namespace App\Repositories;

use App\Libraries\Viacep\AddressRepository as ViacepRepository;
use App\Models\Address;
use App\Models\Footballer;
use App\Models\Subscription;
use App\Repositories\Concerns\WithFiles;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Concerns\WithSelectOptions;

class FootballerRepository extends CrudRepository
{
    use WithFiles;
    use WithSelectOptions;



    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Footballer::class;

    /**
     * Apply filters.
     *
     * @param Builder $query
     * @param array   $params
     *
     * @return Builder
     */
    public function applyFilter($query, $params)
    {
        return $query->select('footballers.*')
            ->groupBy('footballers.id');
    }

    /**
     * Filter attributes.
     *
     * @param array $attributes
     *
     * @return array
     */
    public function filterAttributes($attributes)
    {
        if (is_null(data_get($attributes, 'name'))) {
            unset($attributes['name']);
        } else {
            $attributes['name'] = capitalize($attributes['name']);
        }

        if (is_null(data_get($attributes, 'email'))) {
            unset($attributes['email']);
        } else {
            $attributes['email'] = strtolower($attributes['email']);
        }

        if (is_null(data_get($attributes, 'password'))) {
            unset($attributes['password']);
        } else {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        return $attributes;
    }

    public function checkIfZipcodeExists($address)
    {
        $viacep = null;
    
        try {
            $viacep = (new ViacepRepository())->find($address->zip_code);
        } catch (\Exception $e) { }

        return $address;
    }

    /**
     * Handles model after save.
     *
     * @param Footballer $resource
     * @param array    $attributes
     *
     * @return Footballer
     */
    public function afterSave($resource, $attributes, $action = null)
    {
        $resource->modalities()->sync(data_get($attributes, 'modalities', []));
        $resource->positions()->sync(data_get($attributes, 'positions', []));
        
        $this->saveAddress($resource, $attributes);

        return $resource;
    }

    /**
     * Handles model after store.
     *
     * @param Footballer $resource
     * @param array    $attributes
     *
     * @return Footballer
     */
    public function afterStore($resource, $attributes)
    {
        return $this->afterSave($resource, $attributes, 'created');
    }

    /**
     * Call after update footballer.
     *
     * @param Footballer $resource
     * @param array    $attributes
     *
     * @return Footballer
     */
    public function afterUpdate($resource, $attributes)
    {
        return $this->afterSave($resource, $attributes, 'updated');
    }

    /**
     * Update footballer image collection.
     *
     * @param Footballer $resource
     * @param string   $avatar
     *
     * @return Footballer
     */
    public function updateAvatar($resource, $avatar)
    {
        $this->addBase64FileToCollection($resource, 'avatar', $avatar);
        
        return $resource;
    }

    /**
     * Save address.
     *
     * @param Footballer $footballer
     * @param array    $attributes
     *
     * @return Address
     */
    public function saveAddress($footballer, $attributes)
    {
        $address = $footballer->address ?: new Address();

        /** @var Address $address */
        $address = $this->fill($address, $attributes, true);
        $address->footballer_id = $footballer->getKey();
        $address->save();

        $this->checkIfZipcodeExists($address);

        return $address;
    }

     /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'name';
    }

    /**
     * Return the footballer IDs by group ID.
     *
     * @param int $id
     * @return array
     */
    public function getFootballersByGroupId($id)
    {        
        return $this->newQuery()
            ->from('group_footballer')
            ->select('footballer_id')
            ->where('group_id', $id)->pluck('footballer_id')->toArray();         
    }
}
