<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Map;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maps = [
            "Alterac Pass",
            "Battlefield of Eternity",
            "Blackheart's Bay",
            "Braxis Holdout",
            "Cursed Hollow",
            "Dragon Shire",
            "Garden of Terror",
            "Hanamura Temple",
            "Haunted Mines",
            "Infernal Shrines",
            "Sky Temple",
            "Tomb of the Spider Queen",
            "Towers of Doom",
            "Volskaya Foundry",
            "Warhead Junction"
        ];

        foreach($maps as $map){
            $tmap = [];
            $tmap['image'] = 'img/maps/'. strtolower(str_replace(' ', '-', $map)) . '.jpg';
            $tmap['name'] = $map;
            Map::create($tmap);
        }
    }
}
