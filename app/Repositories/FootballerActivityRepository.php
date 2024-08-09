<?php

namespace App\Repositories;

use App\Models\FootballerActivity;
use App\Repositories\Concerns\WithTimestamps;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Concerns\WithSelectOptions;

class FootballerActivityRepository extends CrudRepository
{

    use WithTimestamps;
    use WithSelectOptions;


    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = FootballerActivity::class;


    /**
     * Apply filters
     *
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function applyFilter($query, $params)
    {
        $footballer_name = data_get($params, 'q.footballer.name');
        $footballer_email = data_get($params, 'q.footballer.email');
        $footballer_document = data_get($params, 'q.footballer.document');
        $calls_today = data_get($params, 'calls_today');

        return $query->select('footballer_activities.*')
            ->leftJoin('footballers', 'footballers.id', '=', 'footballer_activities.footballer_id')
            ->leftJoin('profiles', 'footballers.id', '=', 'profiles.footballer_id')
            ->when($footballer_name, function ($query) use ($footballer_name) {
                $query->where('footballers.name', 'ilike', "%$footballer_name%");
            })
            ->when($footballer_email, function ($query) use ($footballer_email) {
                $query->where('footballers.email', 'ilike', "%$footballer_email%");
            })
            ->when($footballer_document, function ($query) use ($footballer_document) {
                $query->where('profiles.document', 'ilike', "%$footballer_document%");
            })
            ->when(!user()->isSuper(), function ($query) {
                $query->where('footballer_activities.user_id', user()->id);
            })
            ->when($calls_today, function ($query) {
                $query->whereDate('footballer_activities.call_in', '=', Carbon::today());
            });
    }

    /**
     * Filter attributes
     *
     * @param array $attributes
     * @return array
     */
    public function filterAttributes($attributes)
    {
        $attributes = $this->filterTimestampAttributes($attributes, ['called_at', 'call_in']);

        $financial_assets = data_get($attributes, 'financial_assets');
        $footballer_profile = data_get($attributes, 'footballer_profile');
        $footballer_style = data_get($attributes, 'footballer_style');

        $attributes['financial_assets'] = $financial_assets ?
            array_filter($financial_assets, function ($item) {
                return $item;
            }) : [];

        $attributes['footballer_profile'] = $footballer_profile ?
            array_filter($footballer_profile, function ($item) {
                return $item;
            }) : [];

        $attributes['footballer_style'] = $footballer_style ?
            array_filter($footballer_style, function ($item) {
                return $item;
            }) : [];

        return $attributes;
    }


    /**
     * Handles model after save.
     *
     * @param FootballerActivity $resource
     * @param array $attributes
     * @return FootballerActivity
     */
    public function afterSave($resource, $attributes)
    {
        $resource->offeredProducts()->sync(data_get($attributes, 'activity_products', []));
        $resource->dontLikeProducts()->sync(data_get($attributes, 'activity_dont_like', []));

        return $resource;
    }

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'email';
    }


}
