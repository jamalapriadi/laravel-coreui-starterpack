<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cms\Category;
use App\Models\Cms\Post;
use Illuminate\Http\Request;
use Youtube;

class YoutubeController extends Controller
{
    public function index(){
        return $playlist = Youtube::getPlaylistById('PL590L5WQmH8fJ54F369BLDSqIwcs-TCfs');
        return view('backend.youtube.index');
    }

    public function create(){
        return view('backend.youtube.create');
    }

    public function store(Request $request){
        $rules=[
            'title'=>'required',
            'desc'=>'required',
            'file'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'errors'=>$validasi->errors()->all()
            );
        }else{

        }
    }
}