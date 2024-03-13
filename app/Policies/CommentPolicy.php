<?php

namespace App\Policies;

use App\Models\User;

class CommentPolicy
{
    public function remove(User $user, Comment $comment)
    {
        return $user->id === (int)$comment->user_id || $user->role == UserRole::MODERATOR;
    }
}
