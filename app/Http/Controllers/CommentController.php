<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Request\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    function store(StoreCommentRequest $comment, Request $request)
    {
        $nComment = new Comment;
        $nComment->body = $request->get('body');
        $nComment->user()->associate(Auth::user());
        $comment->comments()->save($nComment);

        if(!$comment->has_comment){
            $comment->has_comment = true;
            $comment->save();
        }
    }

    function destroy(Comment $comment)
    {
        $comment->body = null;
        $comment->save();
    }

    function show(Comment $comment)
    {
        // for some reason "Comment::where('id', $comment->id)" is neccesairy,
        // just $comment->with... returns all comments as well as Comment::find($build->id)->with...,
        // which is kinda odd... (one extra query :( i could change route to commentId, but i want to keep the routes consistant)
        $comment = Comment::where('id', $comment->id)->with('comments.comments.comments.comments')->get();
        return $comment;
    }
}
