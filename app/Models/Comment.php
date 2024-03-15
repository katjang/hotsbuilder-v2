<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Commentable;

class Comment extends Model
{
    use Commentable;
    
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
