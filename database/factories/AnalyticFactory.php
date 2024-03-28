<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Analytic>
 */
class AnalyticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->text(50);

        return [
            'team_id' => Team::factory()->create(),
            'title' => $title,
            'script_content' => '<script type="text/javascript">console.log("testing")</script>',
        ];
    }
}
