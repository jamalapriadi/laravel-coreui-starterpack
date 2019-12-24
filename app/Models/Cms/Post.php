<?php

namespace App\Models\Cms;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;

    protected $table="posts";

    protected $dates = ['created_at', 'updated_at'];

    protected $appends = [
        'feature_image_url',
        'tanggal_indo',
        'hari_indo'
    ];

    public function getFeatureImageUrlAttribute(){
        $url = asset('uploads/'.$this->post_type.'/'.$this->featured_image);

        return $url;
    }

    public function getTanggalIndoAttribute(){
        if($this->tanggal !=null){
            return date('d M Y',strtotime($this->tanggal));
        }else{
            return "-";
        }
    }

    public function getHariIndoAttribute(){
        $hari = date ("D", strtotime($this->tanggal));
 
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
    
            case 'Mon':			
                $hari_ini = "Senin";
            break;
    
            case 'Tue':
                $hari_ini = "Selasa";
            break;
    
            case 'Wed':
                $hari_ini = "Rabu";
            break;
    
            case 'Thu':
                $hari_ini = "Kamis";
            break;
    
            case 'Fri':
                $hari_ini = "Jumat";
            break;
    
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak di ketahui";		
            break;
        }
    
        return $hari_ini;
    }

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
