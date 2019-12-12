<?php
namespace App\Models\Cms;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $table="carousel";

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute(){
        $url = asset('uploads/carousel/'.$this->image);

        return $url;
    }
}