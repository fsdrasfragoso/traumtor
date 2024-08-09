<?php

namespace App\Repositories;

use App\Models\Period;

class PeriodRepository extends CrudRepository
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Period::class;

    /**
     * Find or create period.
     *
     * @param int   $subscriptionId
     * @param mixed $attributes
     *
     * @return Period
     *
     * @throws \Exception
     */
    public function findOrCreatePeriod($subscriptionId, $cycle, $attributes)
    {
        /** @var Period $period */
        $period = Period::query()
            ->where('subscription_id', $subscriptionId)
            ->where('cycle', $cycle)
            ->first();

        if (!$period) {
            $attributes['subscription_id'] = $subscriptionId;
            $attributes['cycle'] = $cycle;

            if (!data_get($attributes, 'created_at')) {
                $attributes['created_at'] = now();
            }

            if (!data_get($attributes, 'updated_at')) {
                $attributes['updated_at'] = now();
            }

            $this->createOnConflict($attributes);

            /** @var Period $period */
            $period = Period::query()
                ->where('subscription_id', $subscriptionId)
                ->where('cycle', $cycle)
                ->first();
        }

        return $period;
    }
}
