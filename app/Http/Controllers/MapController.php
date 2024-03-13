<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;

class MapController extends Controller
{
    function index()
    {
        $maps = Map::all();
        return $maps;
    }
}
