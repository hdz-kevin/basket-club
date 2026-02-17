<?php

namespace Database\Factories;

use App\Enums\BloodType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'medical_public_id' => fake()->md5(),
            'blood_type' => fake()->randomElement(BloodType::values()),
            'allergies' => fake()->sentence(6),
            'injuries' => fake()->sentence(12),
        ];
    }
}
