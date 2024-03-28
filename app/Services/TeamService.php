<?php

namespace App\Services;

use App\Models\Team;

class TeamService
{
    public function getTeamById(int $teamId)
    {
        return Team::find($teamId);
    }
}
