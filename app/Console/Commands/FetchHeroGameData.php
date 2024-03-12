<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB;

use App\Models\Ability;
use App\Models\Hero;
use App\Models\Talent;

class FetchHeroGameData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotsapi:fetch-hero-gamedata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches and populates all the hero game data into our own DB';

    private $cloneDir = "./tmp/heroes-talents";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $this->fetchHeroes();
        list($heroes, $abilities, $talents) = $this->processHeroFiles();

        $this->info('FetchTalents: Saving heroes data...');
        Hero::upsert($heroes, ['id']);
        Ability::upsert($abilities, ['hero_id', 'title']);
        Talent::upsert($talents, ['hero_id', 'name']);

        $this->info('FetchTalents: Finished');
    }

    private function fetchHeroes() {
        $this->info('FetchTalents: Cloning heroes data from Github...');

        $process = new Process(["rm", "-rf", $this->cloneDir]);
        $process->run();

        $process = new Process(["git", "clone", "--depth", 1, "https://github.com/heroespatchnotes/heroes-talents.git", $this->cloneDir]);
        if (0 !== $process->run()) {
            throw new ProcessFailedException($process);
        }
    }

    private function processHeroFiles() {
        $this->info('FetchTalents: Processing heroes data...');
        $files = array_diff(scandir($this->cloneDir . '/hero'), array('.', '..'));

        $heroes = [];
        $abilities = [];
        $talents = [];
        foreach ($files as $file) {
            $content = file_get_contents("$this->cloneDir" . '/hero/' . $file);
            $data = json_decode($content);

            $heroes[] = [
                'id' => $data->id,
                'name' => $data->name,
                'short_name' => $data->shortName,
                'role' => $data->role,
                'type' => $data->type,
                'release_date' => $data->releaseDate,
                'release_patch' => $data->releasePatch,
                'attribute_id' => $data->attributeId,
                'icon' => $data->icon,
            ];

            foreach ($data->abilities as $owner => $abilityArray) {
                foreach ($abilityArray as $ability) {
                    $abilities[] = [
                        'hero_id' => $data->id,
                        'name' => isset($ability->abilityId) ? preg_replace('/^.*\|/', '', $ability->abilityId) : null,
                        'title' => $ability->name,
                        'description' => $ability->description,
                        'hotkey' => $ability->hotkey ?? null,
                        'cooldown' => $ability->cooldown ?? null,
                        'mana_cost' => isset($ability->manaCost) ? preg_replace('/ per second/', '', $ability->manaCost) : null,
                        'trait' => $ability->trait ?? false,
                        'icon' => $ability->icon,
                    ];
                }
            }

            foreach ($data->talents as $level => $talentArray) {
                foreach ($talentArray as $talent) {
                    $talents[] = [
                        'hero_id' => $data->id,
                        'name' => $talent->name,
                        'description' => $talent->description,
                        'icon' => $talent->icon,
                        'ability' => isset($talent->abilityId) ? preg_replace('/^.*\|/', '', $talent->abilityId) : null,
                        'sort' => $talent->sort,
                        'level' => $level,
                        'cooldown' => $talent->cooldown ?? null,
                        'mana_cost' => $talent->mana_cost ?? null,
                    ];
                }
            }
        }

        return array($heroes, $abilities, $talents);
    }
}
