<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Headline extends Model
{
    protected $table="post_headline";

    protected $dates = ['created_at', 'updated_at','deleted_at'];

    public function post()
    {
        return $this->belongsTo('App\Models\Cms\Post','post_id');
    }
}