<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Symfony\Component\Clock\now;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    protected $genders = ['male', 'female', 'other'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement($this->genders);
        $nameByGender = $gender == 'other' ? 'female' : $gender;

        return [
            'first_name' => fake('es')->firstName($nameByGender),
            'last_name' => fake('es')->lastName($nameByGender),
            'gender' => $gender,
            'birthdate' => fake()->dateTimeBetween('-50 years', '-15 years')
                                 ->format('Y-m-d'),
        ];
    }
}
