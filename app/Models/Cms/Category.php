<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

    protected $table="categories";

    public function post(){
        return $this->belongsToMany('App\Models\Cms\Post','post_category','category_id','post_id','id','id');
    }

    public function parent(){
        return $this->belongsTo('\App\Models\Cms\Category','parent_id');
    }

    public function childs(){
        return $this->hasMany('App\Models\Cms\Category','parent_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'category_name'
            ]
        ];
    }
}
