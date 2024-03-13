<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class HeroController extends Controller
{
    function index(Request $request)
    {
        $heroes = Hero::filter($request)->get();
        return $heroes;
    }

    function show(Hero $hero)
    {
        $builds = $hero->builds()
            ->with('hero', 'user')
            ->withRating()
            ->orderBy('avg_rating', 'desc')
            ->limit(5)
            ->get();
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function($query, $search){
            return $query->where('name', 'LIKE', "%{$search}%");
        });
    }

    public function scopeFilterRole($query, $roles)
    {
        return $query->when($roles, function($query, $roles){
            $roles = array_map('ucwords', $roles);
            return $query->whereIn('role', $roles);
        });
    }

    public function scopeFilter($query, $request)
    {
        $roles = array_keys($request->only('assassin', 'specialist', 'warrior', 'support'));

        return $query->search($request->get('search'))->filterRole($roles);
    }

    static function selectArray()
    {
        $heroArray = Hero::orderBy('name')->get()->pluck('name', 'id');
        $heroArray->prepend('Any', 0);

        return $heroArray;
    }
}
