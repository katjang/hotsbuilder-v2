<?php

namespace App\Policies;

use App\Models\User;

class BuildPolicy
{
    public function create(User $user)
    {
        return $user->ratedBuilds->count() >= 5 || $user->role == UserRole::MODERATOR;
    }

    public function update(User $user, Build $build)
    {
        return $user->id === (int)$build->user_id;
    }

    public function delete(User $user, Build $build)
    {
        return $user->id === (int)$build->user_id;
    }
}
