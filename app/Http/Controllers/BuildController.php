<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BuildService;
use App\Models\Build;

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
        $build = Build::where('id', $build->id)
            ->with('comments.comments.comments.comments.comments')
            ->withRating()
            ->first();

        $hero = $build->hero;
        $hero->talents = $hero->talents->groupBy('level');

        $build->talents = $build->talents->groupBy('level');
    }

    function store(SaveBuild $request)
    {
        $build = new Build;
        $build->hero_id = $request->hero_id;
        $this->buildService->saveBuild($request, $build, Auth::user());
        return redirect()->route('build.show', $build)->with("message", "Build has been created");
    }

    function destroy(Build $build)
    {
        $this->buildService->deleteBuild($build);
        return redirect()->route('user.builds', Auth::user())->with("message", "Build has been deleted");
    }

    function update(Build $build, SaveBuild $request)
    {
        $this->buildService->saveBuild($request, $build, Auth::user());
        return redirect()->route('build.show', $build)->with("message", "Build has been updated");
    }
}
