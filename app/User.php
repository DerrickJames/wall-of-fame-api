<?php

namespace App;

use Fame\Traits\UuidModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use UuidModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'status', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
