<?php

namespace App\Models\Kids;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table="jabatan";
    protected $primaryKey="id";

    public function posisi(){
        return $this->belongsToMany('App\Models\Kids\Posisi','jabatan_has_position','jabatan_id','position_id');
    }
}
