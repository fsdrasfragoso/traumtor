<?php

namespace App\Repositories;

use App\Models\FootballMatch;
use App\Repositories\Concerns\WithSelectOptions;
use Illuminate\Support\Carbon;
class FootballMatchRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = FootballMatch::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'local_name'; // Substitua 'local_name' pelo nome da coluna principal do modelo FootballMatch
    }

    /**
     * Handles model before store.
     *
     * @param array $attributes
     *
     * @return array $attributes
     */
    public function beforeStore($attributes)
    {
        $daysOfWeekMap = [
            'sunday' => Carbon::SUNDAY,
            'monday' => Carbon::MONDAY,
            'tuesday' => Carbon::TUESDAY,
            'wednesday' => Carbon::WEDNESDAY,
            'thursday' => Carbon::THURSDAY,
            'friday' => Carbon::FRIDAY,
            'saturday' => Carbon::SATURDAY,
        ];

        $day = $attributes['day'];
        $startTime = $attributes['start_time'];
        $groupModalityScheduleId = $attributes['group_modality_schedule_id'];

        $date = Carbon::now();
        $currentDateTime = $date->copy()->setTimeFromTimeString($startTime)->second(0);

        if ($date->dayOfWeek === $daysOfWeekMap[$day] && $currentDateTime->greaterThanOrEqualTo($date)) {
            $matchDateTime = $currentDateTime;
        } else {
            $matchDateTime = $date->next($daysOfWeekMap[$day])->setTimeFromTimeString($startTime)->second(0);
        }

       
        if ($this->matchExistsForScheduleAndTime($groupModalityScheduleId, $matchDateTime->format('Y-m-d'), $matchDateTime->format('H:i:s'))) 
        {
            $matchDateTime = $matchDateTime->addWeek()->next(Carbon::MONDAY)->setTimeFromTimeString($startTime);

        }

        $attributes['match_datetime'] = $matchDateTime->format('Y-m-d H:i:s');

        return $attributes;
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
        $footballes = $this->getFootballByGroupId($attributes['group_id']);         
            
        foreach ($footballes as $footballe) 
        {
            
            $resource->footballers()->create([
                'football_match_id' => $resource->id,
                'footballer_id' => $footballe,
                'is_present' => 0,                
            ]);
        }     

        return $resource;
    }


    /**
     * Return the footballer IDs by group ID.
     *
     * @param int $id
     * @return array
     */
    public function getFootballByGroupId($id)
    {        
        return $this->newQuery()
            ->from('group_footballer')
            ->select('footballer_id')
            ->where('group_id', $id)->pluck('footballer_id')->toArray();         
    }

    /**
     * Check if a match already exists for the given schedule ID, date, and time.
     *
     * @param int $groupModalityScheduleId
     * @param string $date
     * @param string $time
     * @return bool
     */
    public function matchExistsForScheduleAndTime($groupModalityScheduleId, $date, $time)
    {
        return $this->newQuery()
            ->where('group_modality_schedule_id', $groupModalityScheduleId)
            ->whereDate('match_datetime', $date)
            ->whereTime('match_datetime', $time)
            ->exists();
    }

}
