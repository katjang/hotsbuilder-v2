<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('hotsapi:fetch-hero-gamedata');
        $this->call(MapSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BuildSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(RatingSeeder::class);
    }
}
