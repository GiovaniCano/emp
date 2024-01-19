<?php

namespace Database\Seeders;

use App\Models\Pass;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PassTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pass::factory(3)->has(Ticket::factory(120))->create();
    }
}
