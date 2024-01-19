<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SocialSeeder::class);
        $this->call(SpeakerSeeder::class);
        $this->call(PassTicketSeeder::class);
        $this->call(SponsorSeeder::class);
    }
}
