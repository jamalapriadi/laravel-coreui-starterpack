<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\Carousel;
use App\Models\Cms\Carouseloverlay;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class CarouselController extends Controller
{
    public function index(Request $request){
        $model=Carousel::select('*');

        if($request->has('q')){
            $model=$model->where('caption','like','%'.$request->input('q').'%');
        }

        $model=$model->paginate(10);

        return $model;
    }

    public function store(Request $request){
        $rules=[
            'caption'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi Error',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            if($request->has('kode') && $request->input('kode')!=""){
                $kd=$request->input('kode');
                $model=Carousel::find($kd);
            }else{
                $model=new Carousel;
            }

            
            $model->caption=$request->input('caption');
            $model->text=$request->input('text');

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/carousel/')){
                    mkdir('uploads/carousel/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/carousel/').$filename);
                $model->image=$filename;
            }

            $simpan=$model->save();

            if($simpan){

                $data=array(
                    'success'=>true,
                    'pesan'=>'Data berhasil disimpan',
                    'error'=>''
                );
            }else{
                $data=array(
                    'success'=>false,
                    'pesan'=>'Data gagal disimpan',
                    'error'=>''
                );
            }
        }

        return $data;
    }

    public function show($id){
        $model=Carousel::find($id);

        return $model;
    }

    public function destroy($id)
    {
        $model=Carousel::find($id);


        $hapus=$model->delete();

        if($hapus){
            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil dihapus',
                'error'=>''
            );
        }elsE{
            $data=array(
                'success'=>false,
                'pesan'=>'Data gagal dihapus',
                'error'=>''
            );
        }

        return $data;
    }

    public function overlay(Request $request)
    {
        $model=Carouseloverlay::first();

        return $model;
    }

    public function store_overlay(Request $request)
    {
        $rules=[
            'desc'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'message'=>'Validasi errors',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            if($request->has('kode') && $request->input('kode')!=""){
                $kd=$request->input('kode');

                $model=Carouseloverlay::find($kd);
            }else{
                $model=new Carouseloverlay;
            }

            $model->text=$request->input('desc');
            $model->save();

            $data=array(
                'success'=>true,
                'message'=>'Data has been saved',
                'errors'=>array()
            );
        }

        return $data;
    }
}