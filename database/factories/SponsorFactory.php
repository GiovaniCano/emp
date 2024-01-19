<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'sponsorship_id' => $this->faker->,
            'name' => $this->faker->name(),
            'image' => $this->faker->unique()->randomNumber(8).'.jpg',
            'email' => $this->faker->companyEmail(),
            'phone' => $this->faker->e164PhoneNumber(),
            'company' => $this->faker->company(),
            // 'amount' => $this->faker->randomFloat(2,10,50),
        ];
    }
}
