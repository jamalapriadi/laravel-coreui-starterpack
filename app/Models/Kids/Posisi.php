<?php

namespace App\Models\Kids;

use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    protected $table="position";
    protected $primaryKey="id";

    public function jabatan(){
        return $this->belongsToMany('App\Models\Kids\Jabatan','jabatan_has_position','position_id','jabatan_id');
    }
}
