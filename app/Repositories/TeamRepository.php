<?php

namespace App\Repositories;

use App\Models\Team;
use App\Repositories\Concerns\WithSelectOptions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TeamRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Team::class;

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
        $footballers = $this->getFootballersWithoutTeam($attributes['football_match_id']);
        $team = new Team();
        $team->name = 'Time Traumtor';
        $team->save();
        foreach($footballers as $footballer)
        {
            DB::table('football_match_players')
                        ->where('football_match_id', $attributes['football_match_id'])
                        ->where('footballer_id', $footballer->id)
                        ->update(['team_id' => $team->id]);            
        }
        return $resource;
    }

    public function beforeStore($attributes)
    {
        $footballMatchId = $attributes['football_match_id'];

        // Calculate the number of available footballers and determine the number of teams
        $availableFootballers = $this->getAvailableFootballersCount($footballMatchId);
        $footballerCountPerTeam = $this->getFootballerCountPerTeam($footballMatchId);

        $numberOfTeams = (int) floor($availableFootballers / $footballerCountPerTeam);

        $attributes['number_of_teams'] = $numberOfTeams;
        $availableGoalkeepers = $this->getAvailableGoalkeepers($footballMatchId, $numberOfTeams);
        unset($attributes['name']);
        $teams = [];

        // Initialize teams with goalkeepers
        foreach ($availableGoalkeepers as $key => $goalkeeper) {
            $teamName = 'Time ' . $goalkeeper->name; 
            $teams[] = [
                'name' => $teamName,
                'football_match_id' => $footballMatchId,
                'footballer_id' => $goalkeeper->id,
                'members' => [$goalkeeper->id] // Start with the goalkeeper
            ];
        }

        while (count($teams) < $numberOfTeams) {
            $footballerIds = array_column($teams, 'footballer_id');
            $goalkeeper = $this->assignGoalkeepersToTeams($attributes['football_match_id'], $footballerIds, 1);
            $teamName = 'Time ' . $goalkeeper->name; 
            $teams[] = [
                'name' => $teamName,
                'football_match_id' => $footballMatchId,
                'footballer_id' => $goalkeeper->id,
                'members' => [$goalkeeper->id] // Start with the goalkeeper
            ];
        }        

        // Assign players to teams
        $footballerCountPerTeam -= 1; // Excluding the goalkeeper
        $footballerIds = array_column($teams, 'footballer_id');
        $rankedPlayersQuery = $this->assignPlayersToTeams($footballMatchId, $footballerIds, $numberOfTeams);

        // Sort the collection by `team_id`
        $rankedPlayersQuery = $rankedPlayersQuery->sortBy('team_id');

        // Distribute players evenly among the teams
        foreach ($rankedPlayersQuery as $player) {
            $i = $player->team_id - 1;
            if (count($teams[$i]['members']) < ($footballerCountPerTeam + 1)) { // +1 to include the goalkeeper
                array_push($teams[$i]['members'], $player->id);
            }
        }

        // Ensure each team has exactly the right number of members, discarding any extras
        foreach ($teams as &$team) {
            if (count($team['members']) > ($footballerCountPerTeam + 1)) { // +1 to include the goalkeeper
                $team['members'] = array_slice($team['members'], 0, ($footballerCountPerTeam + 1));
            }
        }

        $attributes['teams'] = $teams;
        
       
        return $attributes;
    }




    public function assignGoalkeepersToTeams($footballMatchId, array $existingGoalkeeperIds, $limit = 1)
    {

        return $this->newQuery()
            ->from('football_matches as fm')
            ->join('football_match_players as fmp', 'fmp.football_match_id', '=', 'fm.id')
            ->join('group_modality_schedule as gms', 'gms.id', '=', 'fm.group_modality_schedule_id')
            ->join('footballer_position as fp', 'fp.footballer_id', '=', 'fmp.footballer_id')
            ->join('positions as p', function($join) {
                $join->on('p.id', '=', 'fp.position_id')
                     ->on('p.modality_id', '=', 'gms.modality_id');
            })
            ->join('footballers as f', 'f.id', '=', 'fmp.footballer_id')
            ->where('fm.id', $footballMatchId)
            ->whereNull('fmp.team_id')
            ->where('fmp.is_present', 1)            
            ->whereNotIn('f.id', $existingGoalkeeperIds)
            ->select('f.*', 'fmp.id as football_match_player_id')
            ->orderBy('f.overall', 'asc')
            ->limit($limit)
            ->first();

        
    }

    public function getFootballersWithoutTeam($footballMatchId)
    {
        return $this->newQuery()
            ->from('football_match_players as fmp')
            ->join('footballers as f', 'f.id', '=', 'fmp.footballer_id')
            ->where('fmp.football_match_id', $footballMatchId)
            ->where('fmp.is_present', 1)
            ->whereNull('fmp.team_id')
            ->select('f.*')
            ->get();
    }


    protected function getFootballerCountPerTeam($footballMatchId)
    {
        $match = $this->newQuery()
            ->from('football_matches as fm')
            ->join('group_modality_schedule as gms', 'gms.id', '=', 'fm.group_modality_schedule_id')
            ->join('modalities as m', 'm.id', '=', 'gms.modality_id')
            ->select('m.player_count as footballer_count')
            ->where('fm.id', $footballMatchId)
            ->first();

        return $match ? (int) $match->footballer_count : 0;
    }

    protected function getAvailableFootballersCount($footballMatchId)
    {
        $result = $this->newQuery()
            ->from('football_matches as fm')
            ->join('football_match_players as fmp', 'fmp.football_match_id', '=', 'fm.id')
            ->where('fm.id', $footballMatchId)
            ->whereNull('fmp.team_id')
            ->where('fmp.is_present', 1)
            ->selectRaw('COUNT(fmp.footballer_id) as number_of_footballers')
            ->first();

        return $result ? (int) $result->number_of_footballers : 0;
    }

    protected function getAvailableGoalkeepers($footballMatchId,$limit)
    {
        return $this->newQuery()
            ->from('football_matches as fm')
            ->join('football_match_players as fmp', 'fmp.football_match_id', '=', 'fm.id')
            ->join('group_modality_schedule as gms', 'gms.id', '=', 'fm.group_modality_schedule_id')
            ->join('footballer_position as fp', 'fp.footballer_id', '=', 'fmp.footballer_id')
            ->join('positions as p', function($join) {
                $join->on('p.id', '=', 'fp.position_id')
                     ->on('p.modality_id', '=', 'gms.modality_id');
            })
            ->join('footballers as f', 'f.id', '=', 'fmp.footballer_id')
            ->where('fm.id', $footballMatchId)
            ->whereNull('fmp.team_id')
            ->where('p.name', 'LIKE', '%goleiro%')
            ->where('fmp.is_present', 1)
            ->select('f.*', 'fmp.id as football_match_player_id')
            ->limit($limit)
            ->get();
    }

    public function assignPlayersToTeams($footballMatchId, array $existingGoalkeeperIds, $numberOfTeams = 3)
    {
        // Define the subquery that calculates the rank of players based on overall and IMC
        $rankedPlayersQuery = $this->newQuery()
            ->from('footballers as f')
            ->selectRaw('f.*, (f.weight / (f.height * f.height)) AS imc, fmp.football_match_id, ROW_NUMBER() OVER (ORDER BY f.overall ASC, (f.weight / (f.height * f.height)) ASC) AS rnk')
            ->join('football_match_players as fmp', 'fmp.footballer_id', '=', 'f.id')
            ->join('football_matches as fm', 'fm.id', '=', 'fmp.football_match_id')
            ->join('group_modality_schedule as gms', 'gms.id', '=', 'fm.group_modality_schedule_id')
            ->join('positions as p', 'p.id', '=', 'gms.modality_id')
            ->where('fm.id', $footballMatchId)
            ->whereNotIn('f.id', $existingGoalkeeperIds)
            ->whereNull('fmp.team_id')
            ->where('fmp.is_present', 1);

        // Use the subquery to distribute players among teams in a cyclic manner
        return $this->newQuery()
            ->fromSub($rankedPlayersQuery, 'rp')
            ->selectRaw('((rp.rnk - 1) % ?) + 1 AS team_id, rp.id', [$numberOfTeams])
            ->orderBy('rp.rnk')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create($attributes)
    {   
        $attributes = $this->beforeStore($this->createAttributes($attributes));
       
            
        
            // Inserir times na tabela `teams`
            foreach ($attributes['teams'] as $team) {
                $teamModel = new Team();
                $teamModel->name = $team['name'];
                $teamModel->save();
                $attributes['resource'][] = $teamModel;
                // Atualizar `football_match_players` com o ID do time
                foreach ($team['members'] as $memberId) {
                    DB::table('football_match_players')
                        ->where('football_match_id', $team['football_match_id'])
                        ->where('footballer_id', $memberId)
                        ->update(['team_id' => $teamModel->id]);
                }
            
            }       
            
        
            return $this->afterStore($attributes['resource'], $attributes);
       
    }

    


}
