<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    public function create(User $user, Comment $comment) 
    {
        return true;
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id === (int)$comment->user_id || $user->role == UserRole::MODERATOR;
    }
}
