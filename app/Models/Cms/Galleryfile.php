<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Galleryfile extends Model
{
    protected $table="gallery_file"; 

    protected $fillable=[
        'file_type',
        'file',
        'title',
        'sortir',
        'author'
    ];

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute(){
        $url = asset('uploads/gallery/'.$this->gallery_id.'/'.$this->file);

        return $url;
    }

    public function gallery()
    {
        return $this->belongsTo('App\Models\Cms\Gallery','gallery_id');
    }
}
