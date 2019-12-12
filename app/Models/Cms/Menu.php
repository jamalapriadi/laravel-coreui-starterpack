<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Menu extends Model
{
    use Sluggable;

    protected $table="menus";

    public function parent(){
        return $this->belongsTo('\App\Models\Cms\Menu','parent_id','id');
    }

    public function child(){
        return $this->hasMany('\App\Models\Cms\Menu','parent_id','id');
    }

    public function page(){
        return $this->hasOne('\App\Models\Cms\Post','menu_id')
            ->whereNotNull('menu_id')
            ->where('post_type','page');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'menu'
            ]
        ];
    }
    
}