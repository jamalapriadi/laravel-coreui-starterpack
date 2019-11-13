<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Artikel extends Model
{
    use Sluggable;

    protected $table="course_artikel";

    public function modul(){
        return $this->belongsTo('App\Models\Modul','course_module_id');
    }

    public function user(){
        return $this->belongsTo('App\User','author');
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