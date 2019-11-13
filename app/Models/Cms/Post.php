<?php

namespace App\Models\Cms;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;

    protected $table="posts";

    protected $dates = ['created_at', 'updated_at'];

    public function penulis()
    {
        return $this->belongsTo('App\User','author','id')
            ->select(
                [
                    'users.id',
                    'name',
                    'email',
                    'avatar_url'
                ]
            );
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Cms\Comment','post_id');
    }

    public function getTotalCommentsAttribute()
    {
        return $this->hasMany('App\Models\Cms\Comment','post_id')->count();
    }

    public function category(){
        return $this->belongsToMany('App\Models\Cms\Category','post_category','post_id','category_id')
            ->select(
                [
                    'categories.id',
                    'category_name'
                ]
            )->where('type','Category');
    }

    public function subcategory(){
        return $this->belongsToMany('App\Models\Cms\Category','post_category','post_id','category_id')
            ->select(
                [
                    'categories.id',
                    'category_name'
                ]
            )->where('type','Subcategory');
    }

    public function related(){
        return $this->belongsToMany('App\Models\Cms\Post','post_related','post_id','related_id')
            ->withPivot(
                [
                    'post_id',
                    'related_id'
                ]
            );
    }

    public function tags(){
        // return $this->belongsToMany('App\Models\Cms\Tag','post_tags','post_id','tag_name','id','title');
        return $this->hasMany('App\Models\Cms\Posttag','post_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function files(){
        return $this->hasMany('App\Models\Cms\Postfile','post_id');
    }
}
