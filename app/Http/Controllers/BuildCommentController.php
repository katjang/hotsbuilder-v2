<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class BuildCommentController extends Controller
{
    function store(Build $build, Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $comment = new Comment;
        $comment->body = $request->get('body');
        $comment->user()->associate(Auth::user());
        $build->comments()->save($comment);

        return redirect()->back()->with("message", "Comment has been added.");
    }
}
