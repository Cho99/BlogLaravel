<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'id',
        'title',
        'content',
        'picture',
    ];

    //protected $dateFormat = 'd-m-Y';

    public function admin() {
        return $this->belongsTo('App\Models\Admin','user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsTo('App\Models\Tag','tag_id','id');
    }
}
