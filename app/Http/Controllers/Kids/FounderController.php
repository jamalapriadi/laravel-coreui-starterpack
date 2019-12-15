<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kids\Founder;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\Rules\ImageValidation;

class FounderController extends Controller
{
    public function index(Request $request)
    {
        $model=Founder::select('*');
        
        if($request->has('q')){
            $model=$model->where('name','like','%'.$request->input('q').'%');
        }

        $model=$model->paginate(25);

        return $model;
    }

    public function store(Request $request)
    {
        $rules=[
            'name'=>'required',
            'desc'=>'required',
            'file'=>['nullable',new ImageValidation]
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'validasi gagal',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            if($request->has('kode') && $request->input('kode')!=""){
                $kd=$request->input('kode');
                $model=Founder::find($kd);
            }else{
                $model=new Founder;
            }
            
            $model->name=$request->input('name');
            $model->description=$request->input('desc');
            $model->author=auth()->user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/founder/')){
                    mkdir('uploads/founder/', 0777, TRUE);
                }
                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/founder/').$filename);
                $model->images=$filename;
            }

            $model->save();

            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil disimpan',
                'error'=>''
            );
        }

        return $data;
    }

    public function show(Request $request, $id)
    {
        $model=Founder::find($id);

        return $model;
    }

    public function destroy(Request $request, $id)
    {
        $model=Founder::find($id);


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
}
