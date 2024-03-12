<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $guarded = [];

    function abilities()
    {
        return $this->hasMany(Ability::class);
    }

    function talents()
    {
        return $this->hasMany(Talent::class);
    }

    public function builds()
    {
        return $this->hasMany(Build::class);
    }
}
