<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
    use Sluggable;

    protected $table="tags";

    public function post(){
        return $this->belongsToMany('App\Models\Post','post_tags','tag_id','post_id');
    }

    public function getTotalPostAttribute()
    {
        return $this->belongsToMany('App\Models\Post','post_tags','tag_id','post_id')->count();
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
