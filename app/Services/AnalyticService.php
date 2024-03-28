<?php

namespace App\Services;

use App\DataTransferObjects\AnalyticDTO;
use App\Models\Analytic;

class AnalyticService
{

    public function getAnalyticsByTeamId(int $teamId)
    {
        return Analytic::query()->where('team_id', $teamId)->get();
    }

    public function store(AnalyticDTO $analyticDTO): Analytic
    {
        $analytic = new Analytic();
        $analytic->team_id = $analyticDTO->team_id;
        $analytic->title = $analyticDTO->title;
        $analytic->script_content = $analyticDTO->script_content;
        $analytic->save();

        return $analytic;
    }

    public function update(Analytic $analytic, AnalyticDTO $analyticDTO): Analytic
    {
        $analytic->title =  $analyticDTO->title;
        $analytic->script_content = $analyticDTO->script_content;
        $analytic->save();

        return $analytic->refresh();
    }

    public function destroy(Analytic $analytic)
    {
        return Analytic::destroy($analytic->id);
    }
}
