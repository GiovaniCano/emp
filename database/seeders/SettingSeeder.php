<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create(['key' => 'site_name', 'value' => config('app.name')]);
        Setting::create(['key' => 'email', 'value' => null]);
        Setting::create(['key' => 'phone', 'value' => null]);
        
        Setting::create(['key' => 'hero_image', 'value' => 'sdasdasd.jpg']);

        Setting::factory(1, ['key' => 'images_gallery_1', 'value' => 'images'])->has(Image::factory(8))->create();
        Setting::factory(1, ['key' => 'images_gallery_2', 'value' => 'images'])->has(Image::factory(8))->create();
    }
}
