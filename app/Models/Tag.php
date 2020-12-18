<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Video;

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

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
