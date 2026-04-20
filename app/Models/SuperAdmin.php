<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class SuperAdmin extends Authenticatable
{
    protected $fillable = [
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}