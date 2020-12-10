<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Admin extends Authenticatable
{
    use Notifiable;
    //
    protected $fillable = [
        'email', 'author_name' ,'password', 'level'    
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function news() {
        return $this->hasMany('App\Models\News');
    }
}
