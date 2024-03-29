<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function show(User $user){
        $builds = $user
            ->builds()
            ->with('user', 'hero', 'maps')
            ->withRating()
            ->orderBy('avg_rating', 'desc')
            ->limit(5)
            ->get();
    }
}
