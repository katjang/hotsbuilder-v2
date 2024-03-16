<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BuildService;
use App\Models\Build;
use App\Models\Hero;
use App\Models\Map;
use Inertia\Inertia;

class BuildController extends Controller
{
    function __construct(BuildService $buildService)
    {
        $this->buildService = $buildService;
    }

    function index(Request $request){

        $heroArray = Hero::selectArray();
        $mapArray = Map::selectArray();

        $builds = Build::filter($request)
            ->with('hero', 'user', 'maps')
            ->withRating()
            ->orderBy('avg_rating', 'desc')
            ->paginate(20);

        Build::addFilterParameters($request, $builds);

        return $builds;
    }

    function create(Hero $hero)
    {
        $hero->talents = $hero->talents->groupBy('level');
        $maps = Map::all();
    }

    function edit(Build $build){
        $hero = $build->hero()->with('abilities')->first();
        $hero->talents = $hero->talents()->orderBy('id')->get()->groupBy('level');
        $build->talents = $build->talents->groupBy('level');
        $maps = Map::all();

    }

    function show(Build $build)
    {
        $build = Build::where('builds.id', $build->id)
            ->with('comments.comments.comments.comments.comments', 'maps')
            ->withRating()
            ->first();

        $hero = Hero::where('id', $build->hero_id)->with('abilities')->first();
        $hero->talents = $hero->groupped_talents;

        return Inertia::render('Build/Show', [
            'build' => $build,
            'hero' => $hero,
        ]);
    }

    function store(SaveBuild $request)
    {
        $build = new Build;
        $build->hero_id = $request->hero_id;
        $this->buildService->saveBuild($request, $build, Auth::user());
    }

    function destroy(Build $build)
    {
        $this->buildService->deleteBuild($build);
    }

    function update(Build $build, SaveBuild $request)
    {
        $this->buildService->saveBuild($request, $build, Auth::user());
    }
}
