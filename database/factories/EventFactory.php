<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'name' => $this->faker->sentence(4),
      'description' => $this->faker->paragraph(6),
      'is_academic'	=> $this->faker->randomElement([0, 1]),
      'competition_id' => Competition::inRandomOrder()->first()->id,	
    ];
  }
}
