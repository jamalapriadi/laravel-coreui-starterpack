<?php
namespace App\Models\Cms;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table="fasilitas";

    public function instansi(){
        return $this->belongsTo('App\Models\Instansi','instansi_id');
    }

    protected $appends = [
        'icon_url'
    ];

    public function getIconUrlAttribute(){
        $url = asset('uploads/fasilitas/'.$this->icon);

        return $url;
    }
}