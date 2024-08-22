<?php

namespace App\Repositories;

use App\Models\Group;
use App\Repositories\Concerns\WithSelectOptions;

class GroupRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Group::class;

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
     * Handles model after save.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function afterSave($resource, $attributes)
    {  
        if(!empty(data_get($attributes, 'footballers', [])))
        {
            $resource->footballers()->sync(data_get($attributes, 'footballers', []));  
        }
        
        if(!empty(data_get($attributes, 'schedules', [])))
        {
            $resource->schedules()->delete();      
        
            $schedules = data_get($attributes, 'schedules', []);
            
            foreach ($schedules as $schedule) 
            {
                $resource->schedules()->create([
                    'day' => $schedule['day'],
                    'start_time' => $schedule['startTime'],
                    'closing_time' => $schedule['endTime'],
                    'modality_id' => $schedule['modality_id'],
                ]);
            }            
        }
        
        
        
        return $resource;
    }
}
