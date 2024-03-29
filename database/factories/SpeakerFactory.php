<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speaker>
 */
class SpeakerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'image' => $this->faker->unique()->randomNumber(8).'.jpg'  ,
            'role' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'country' => $this->faker->country(),
        ];
    }
}
