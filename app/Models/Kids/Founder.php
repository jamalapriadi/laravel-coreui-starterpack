<?php

namespace App\Models\Kids;

use Illuminate\Database\Eloquent\Model;

class Founder extends Model
{
    protected $table="founder";
    protected $primaryKey="id";

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute(){
        $url = asset('uploads/founder/'.$this->images);

        return $url;
    }
}
