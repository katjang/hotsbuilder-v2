<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    protected $guarded = [];

    function builds(){
        return $this->belongsToMany(Build::class);
    }
}
