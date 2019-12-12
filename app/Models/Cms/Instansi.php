<?php
namespace App\Models\Cms;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table="instansi";

    public function video(){
        return $this->hasMany('App\Models\Cms\Instansivideo','instansi_id');
    }

    public function kontak(){
        return $this->hasMany('App\Models\Cms\Instansicontact','instansi_id');
    }

    public function menu(){
        return $this->hasMany('App\Models\Cms\Menu','instansi_id')
            ->whereNull('parent_id')
            ->where('active','Y');
    }

    public function sosmed(){
        return $this->belongsToMany('App\Models\Cms\Sosmed','instansi_has_sosmed')
            ->withPivot(
                [
                    'instansi_id',
                    'sosmed_id',
                    'social_media_url'
                ]
            );
    }
}