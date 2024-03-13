<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hero;
use App\Models\Map;
use App\Models\Build;

class UserFavoriteController extends Controller
{
    function index(Request $request)
    {
        $heroArray = Hero::selectArray();
        $mapArray = Map::selectArray();

        $builds = Auth::user()
            ->favorites()
            ->filter($request)
            ->groupBy('favorites.user_id')
            ->withRating()
            ->with('user', 'hero')
            ->paginate(20);

        Build::addFilterParameters($request, $builds);
    }

    function store(Build $build)
    {
        Auth::user()->favorites()->syncWithoutDetaching($build); //prevents duplicates
    }

    function destroy(Build $build)
    {
        Auth::user()->favorites()->detach($build);
    }
}
