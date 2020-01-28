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
        'image_url',
        'gallery_name'
    ];

    public function getImageUrlAttribute(){
        $url = asset('uploads/gallery/'.$this->file);

        return $url;
    }

    public function getGalleryNameAttribute(){
        return $this->gallery->name;
    }

    public function gallery()
    {
        return $this->belongsTo('App\Models\Cms\Gallery','gallery_id');
    }
}
