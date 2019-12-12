<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\Sosmed;
use App\Models\Cms\Instansi;

class SosmedController extends Controller
{
    public function index(Request $request)
    {
        $model=Instansi::with('sosmed')->first();

        return $model;
    }

    public function store(Request $request)
    {
        $rules=[
            'sosmed'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'message'=>'Validasi errors',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $model=Sosmed::all();
            $instansi=Instansi::first();

            $sosmed=$request->input('sosmed');

            $list=array();
            foreach($sosmed as $key=>$val)
            {   
                $list[$key]=array(
                    'social_media_url'=>$val
                );
            }
            $instansi->sosmed()->sync($list);

            $data=array(
                'success'=>true,
                'message'=>'Data has been saved',
                'errors'=>array()
            );
        }

        return $data;
    }

    public function list_sosmed(Request $request)
    {
        $model=Sosmed::all();

        return $model;
    }
}
