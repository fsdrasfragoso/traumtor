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

       
        $date = Carbon::now();

       
        $currentDateTime = $date->copy()->setTimeFromTimeString($startTime)->second(0);

        
        if ($date->dayOfWeek === $daysOfWeekMap[$day] && $currentDateTime->greaterThanOrEqualTo($date)) {
           
            $matchDateTime = $currentDateTime;
        } else {
            
            $matchDateTime = $date->next($daysOfWeekMap[$day])->setTimeFromTimeString($startTime)->second(0);
        }

        
        $attributes['match_datetime'] = $matchDateTime->format('Y-m-d H:i:s');

        return $attributes;
    }
}
