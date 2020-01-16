<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kids\Founder;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\Rules\ImageValidation;
use Illuminate\Support\Facades\Storage;

class FounderController extends Controller
{
    public function index(Request $request)
    {
        $model=Founder::select('*');
        
        if($request->has('q')){
            $model=$model->where('name','like','%'.$request->input('q').'%');
        }

        if($request->has('halaman')){
            $halaman=$request->input('halaman');
        }else{
            $halaman=25;
        }

        $model=$model->paginate($halaman);

        return $model;
    }

    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|max:191',
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

            $model->image_width=$request->input('width');
            $model->image_height=$request->input('height');
            $model->image_border_top_left_radius=$request->input('border_radius')['top_left'];
            $model->image_border_top_right_radius=$request->input('border_radius')['top_right'];
            $model->image_border_bottom_left_radius=$request->input('border_radius')['bottom_left'];
            $model->image_border_bottom_right_radius=$request->input('border_radius')['bottom_right'];
            $model->image_alignment=$request->input('alignment');

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
