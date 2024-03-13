<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Request\StoreCommentRequest;
use App\Models\Build;

class BuildRatingController extends Controller
{
    public function store(StoreCommentRequest $request, Build $build)
    {
        $this->validate($request, [
            'rating' => 'required|integer|min:1|max:5'
        ]);
        $build->ratings()->syncWithoutDetaching([Auth::id() => ['rating' => $request->get('rating')]]);
    }
}
