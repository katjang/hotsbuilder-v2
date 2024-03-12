<?php

namespace App\Models;

use ReflectionClass;

class UserRole extends Model
{
    const NORMAL = 1;
    const MODERATOR = 2;

    static function getRoles() {
        $oClass = new ReflectionClass(__CLASS__);
        return array_flip($oClass->getConstants());
    }
}
