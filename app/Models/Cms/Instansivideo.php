<?php
namespace App\Models\Cms;
use Illuminate\Database\Eloquent\Model;

class Instansivideo extends Model
{
    protected $table="instansi_video";

    public function instansi(){
        return $this->belongsTo('App\Models\Instansi','instansi_id');
    }
}