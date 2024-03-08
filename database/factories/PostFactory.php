<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->title();

        return [
            'user_id' => User::factory()->create(),
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->text(800),
            'published_at' => Carbon::now()->toDateTimeString(),
            'status' => StatusEnum::DRAFT,
        ];
    }

    public function statusDraft(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => StatusEnum::DRAFT,
            ];
        });
    }

    public function statusPublished(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => StatusEnum::PUBLISHED,
            ];
        });
    }

    public function statusArchived(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => StatusEnum::ARCHIVED,
            ];
        });
    }

    public function publishedAtInFuture(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => Carbon::tomorrow(),
            ];
        });
    }

    public function publishedAtInPast(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => Carbon::yesterday(),
            ];
        });
    }
}
