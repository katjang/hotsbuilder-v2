<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserBuildController extends Controller
{
    function index(User $user, Request $request)
    {
        $heroArray = Hero::selectArray();
        $mapArray = Map::selectArray();

        $builds = $user->builds()
            ->filter($request)
            ->with('hero', 'user', 'maps')
            ->withRating()
            ->orderBy('avg_rating', 'desc')
            ->paginate(20);

        Build::addFilterParameters($request, $builds);
    }
}
