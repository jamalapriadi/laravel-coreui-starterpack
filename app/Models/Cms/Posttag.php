<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
class Posttag extends Model
{
    protected $table="post_tags";

    public function tagnya(){
        return $this->belongsTo('App\Models\Cms\Tag','tag_id','id');
    }
}
