<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Score>
 */
class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
          'score' => $this->faker->numberBetween(0, 100),
          'event_id' => Event::inRandomOrder()->first()->id,
          'team_id' => Event::inRandomOrder()->first()->id,
      ];
    }
}
