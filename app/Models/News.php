<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
        'picture',
    ];
    
    public function tags(){
        return $this->belongsTo('App\Models\Tag');
    }
}
