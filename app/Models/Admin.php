<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin'; // 管理者用ガードを指定

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 
    ];
}
