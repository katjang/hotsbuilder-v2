<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    protected $guarded = ['user_id', 'hero_id'];
    protected $with = ['talents'];
    // protected $appends = ['is_favorite'];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function users()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    function hero()
    {
        return $this->belongsTo(Hero::class);
    }

    function talents()
    {
        return $this->belongsToMany(Talent::class)->withPivot('note')->orderBy('level');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function ratings()
    {
        return $this->belongsToMany(User::class, 'ratings')->withPivot('rating');
    }

    public function maps()
    {
        return $this->belongsToMany(Map::class);
    }
}
