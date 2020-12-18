<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Video extends Model
{
    // 
    public function tags() {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
