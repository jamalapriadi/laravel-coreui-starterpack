<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Comment extends Model
{
    protected $table="post_comments";

    protected $dates = ['created_at', 'updated_at'];

    public function parent()
    {
        return $this->belongsTo('\App\Models\Cms\Comment','parent_id');
    }

    public function child()
    {
        return $this->hasMany('\App\Models\Cms\Comment', 'parent_id');
    }
}