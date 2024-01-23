<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sponsorship::factory(1, [
            'min_amount' => 100
        ])->has(
            Sponsor::factory(10, [
                'amount' => fake()->randomFloat(2, 100, 499)
            ])
        )->create();

        Sponsorship::factory(1, [
            'min_amount' => 500
        ])->has(
            Sponsor::factory(8, [
                'amount' => fake()->randomFloat(2, 500, 1499)
            ])
        )->create();

        Sponsorship::factory(1, [
            'min_amount' => 1500
        ])->has(
            Sponsor::factory(4, [
                'amount' => fake()->randomFloat(2, 1500, 9999)
            ])
        )->create();
    }
}
