<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Competition;
use App\Models\Event;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // STUDENTS SEEDING 
        User::factory(1)->create();

        // COMPETITION SEEDING
        // Competition::factory(3)->create();

        // EVENT SEEDING
        // Event::factory(15)->create();

        // TEAM SEEDING
        // Team::factory(9)->create();

        // SCORE SEEDING
        // Score::factory(9)->create();
    }
}
