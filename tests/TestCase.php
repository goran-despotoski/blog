<?php

namespace Tests;

use App\Models\Team;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Config;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $team = Team::factory()->create([
            'name' => 'Default Team'
        ]);
        config(['app.current_team_id' => $team->id]);
    }
}
