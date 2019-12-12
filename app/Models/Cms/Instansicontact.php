<?php
namespace App\Models\Cms;
use Illuminate\Database\Eloquent\Model;

class Instansicontact extends Model
{
    protected $table="instansi_contact";

    public function instansi(){
        return $this->belongsTo('App\Models\Instansi','instansi_id');
    }
}