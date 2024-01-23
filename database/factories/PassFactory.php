<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pass>
 */
class PassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $benefits = [];
        for ($i=0; $i < 6; $i++) { 
            $benefits[] = implode(' ', $this->faker->words(4));
        }

        return [
            'name' => implode(' ', $this->faker->words(2)),
            'benefits' => $benefits,
            'quantity' => 300,
            'price' => $this->faker->randomFloat(2,10,50),
        ];
    }
}
