<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Modul extends Model
{
    use Sluggable;

    protected $table="course_modules";

    public function artikel(){
        return $this->hasMany('App\Models\Artikel','course_module_id');
    }

    public function user(){
        return $this->belongsTo('App\User','author');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'modul_name'
            ]
        ];
    }
}
