<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Build;
use App\Models\User;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('id', '>', 1)->get();

        $builds = Build::all();

        foreach($users as $user){
            foreach($builds as $build){
                if(rand(1,3) == 1){
                    $build->ratings()->syncWithoutDetaching([$user->id => ['rating' => rand(1,5)]]);
                }
            }
        }
    }
}
