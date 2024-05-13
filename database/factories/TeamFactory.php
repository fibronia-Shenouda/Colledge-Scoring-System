<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'team_name' => $this->faker->name(),	
          'member1' => $this->faker->name(),	
          'member2' => $this->faker->name(),	
          'member3' => $this->faker->name(),	
          'member4' => $this->faker->name(),	
          'member5' => $this->faker->name(),					
        ];
    }
}
