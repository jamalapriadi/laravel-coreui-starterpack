<?php

namespace App\Models\Kids;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table="pengurus";
    protected $primaryKey="id";

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute(){
        $url = asset('uploads/pengurus/'.$this->images);

        return $url;
    }

    public function posisi(){
        return $this->belongsToMany('App\Models\Kids\Posisi','pengurus_has_posisi','pengurus_id','position_id')
            ->withPivot(
                [
                    'pengurus_id',
                    'position_id',
                    'tgl_menjabat',
                    'active'
                ]
            );
    }
}
