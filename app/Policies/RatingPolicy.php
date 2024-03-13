<?php

namespace App\Policies;

use App\Models\User;

class RatingPolicy
{
    public function create(User $user)
    {
        return request('build')->user_id != $user->id;
    }
}
