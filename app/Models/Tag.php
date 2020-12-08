<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
        'id',
        'name',
        'parent_id',
        'status'
    ];

    public function news() {
        return $this->hasMany('App\Models\News');
    }
}
