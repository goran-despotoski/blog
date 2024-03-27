<?php

namespace Feature\Services;

use App\DataTransferObjects\AnalyticDTO;
use App\Models\Analytic;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\AnalyticService;
use Tests\TestCase;

class AnalyticServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_no_analytics_by_team_id_when_db_empty()
    {
        $analyticService = new AnalyticService();

        $analytics = $analyticService->getAnalyticsByTeamId(1);

        $this->assertEquals(0, $analytics->count());
    }

    public function test_get_analytics_by_team_id_when_team_has_analytics()
    {
        $team = Team::factory()->create([
            'name' => 'Default Team'
        ]);
        $analytic = Analytic::factory()->create([
            'team_id' => $team->id
        ]);

        $analyticService = new AnalyticService();

        $analytics = $analyticService->getAnalyticsByTeamId($team->id);
        $this->assertEquals(1, $analytics->count());
    }

    public function test_store()
    {
        $team = Team::factory()->create([
            'name' => 'Default Team'
        ]);
        $analyticService = new AnalyticService();

        $analytics = $analyticService->getAnalyticsByTeamId($team->id);
        $this->assertEquals(0, $analytics->count());

        $analyticDTO = new AnalyticDTO();
        $analyticDTO->team_id = $team->id;
        $analyticDTO->title = 'Some title';
        $analyticDTO->script_content = '<script></script>';

        $analyticService->store($analyticDTO);
        $analytics = $analyticService->getAnalyticsByTeamId($team->id);
        $this->assertEquals(1, $analytics->count());
    }

    public function test_update()
    {
        $team = Team::factory()->create([
            'name' => 'Default Team'
        ]);
        $analyticService = new AnalyticService();

        Analytic::factory()->create([
            'team_id' => $team->id
        ]);
        $analytics = $analyticService->getAnalyticsByTeamId($team->id);
        $this->assertEquals(1, $analytics->count());
        $analytic = $analytics->first();
        $this->assertEquals($team->id, $analytic->team_id);
        $this->assertNotEquals('Some title', $analytic->title);
        $this->assertNotEquals('<script></script>', $analytic->script_content);


        $analyticDTO = new AnalyticDTO();
        $analyticDTO->team_id = $team->id;
        $analyticDTO->title = 'Some title';
        $analyticDTO->script_content = '<script></script>';

        $analyticService->update($analytic, $analyticDTO);
        $analytics = $analyticService->getAnalyticsByTeamId($team->id);
        $analytic = $analytics->first();
        $this->assertEquals($team->id, $analytic->team_id);
        $this->assertEquals('Some title', $analytic->title);
        $this->assertEquals('<script></script>', $analytic->script_content);


    }

    public function test_destroy()
    {
        $team = Team::factory()->create([
            'name' => 'Default Team'
        ]);
        $analyticService = new AnalyticService();
        Analytic::factory()->create([
            'team_id' => $team->id
        ]);

        $analytics = $analyticService->getAnalyticsByTeamId($team->id);
        $this->assertEquals(1, $analytics->count());
        $analytic = $analytics->first();
        $analyticService->destroy($analytic);
        $analytics = $analyticService->getAnalyticsByTeamId($team->id);
        $this->assertEquals(0, $analytics->count());

    }
}
