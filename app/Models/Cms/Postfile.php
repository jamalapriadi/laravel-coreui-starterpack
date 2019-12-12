<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
class Postfile extends Model
{
    protected $table="post_files";

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute(){
        $url = asset('uploads/file/'.$this->file);

        return $url;
    }
}
