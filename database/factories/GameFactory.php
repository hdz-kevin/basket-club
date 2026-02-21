<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_home' => $this->faker->boolean(chanceOfGettingTrue: 60),
            'score' => $this->faker->numberBetween(0, 100),
            'opposing_team_name' => $this->faker->company(),
            'opposing_team_score' => $this->faker->numberBetween(0, 100),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'team_id' => Team::factory(),
        ];
    }
}
