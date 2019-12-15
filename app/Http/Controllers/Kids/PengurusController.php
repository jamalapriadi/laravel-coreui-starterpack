<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kids\Pengurus;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\Rules\ImageValidation;

class PengurusController extends Controller
{
    public function index(Request $request)
    {
        $model=Pengurus::with('posisi')->select('*');
        
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
            'email'=>'required',
            'desc'=>'required',
            'posisi'=>'required',
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
                $model=Pengurus::find($kd);
            }else{
                $model=new Pengurus;
            }
            
            $model->name=$request->input('name');
            $model->email=$request->input('email');
            $model->description=$request->input('desc');
            $model->no_hp=$request->input('hp');
            $model->author=auth()->user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/pengurus/')){
                    mkdir('uploads/pengurus/', 0777, TRUE);
                }
                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/pengurus/').$filename);
                $model->images=$filename;
            }

            $simpan=$model->save();

            if($simpan){

                if($request->has('posisi')){
                    $posisi=$request->input('posisi');

                    $model->posisi()->sync(
                        [
                            $model->id => [
                                'position_id'=>$posisi,
                                'tgl_menjabat'=>date('Y-m-d',strtotime($request->input('tgl_menjabat'))),
                                'active'=>'Y'
                            ]
                        ]
                    );
                }

                $data=array(
                    'success'=>true,
                    'pesan'=>'Data berhasil disimpan',
                    'error'=>''
                );
            }else{
                $data=array(
                    'success'=>false,
                    'pesan'=>'Data Gagal Disimpan',
                    'error'=>''
                );
            }
        }

        return $data;
    }

    public function show(Request $request, $id)
    {
        $model=Pengurus::with(
            [
                'posisi',
                'posisi.jabatan'
            ]
        )->find($id);

        return $model;
    }

    public function update(Request $request, $id)
    {
        $rules=[
            'name'=>'required',
            'email'=>'required',
            'desc'=>'required',
            'file'=>'nullable|image|max:1000'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'validasi gagal',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $model=Pengurus::find($id);
            
            $model->name=$request->input('name');
            $model->email=$request->input('email');
            $model->description=$request->input('desc');
            $model->no_hp=$request->input('hp');
            $model->author=auth()->user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/pengurus/')){
                    mkdir('uploads/pengurus/', 0777, TRUE);
                }
                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/pengurus/').$filename);
                $model->images=$filename;
            }

            $simpan=$model->save();

            if($simpan){
                
                if($request->has('posisi_id')){
                    $posisi=$request->input('posisi_id');

                    $model->posisi()->sync(
                        [
                            $model->id => [
                                'position_id'=>$posisi,
                                'tgl_menjabat'=>date('Y-m-d',strtotime($request->input('tgl_menjabat'))),
                                'active'=>'Y'
                            ]
                        ]
                    );
                }

                $data=array(
                    'success'=>true,
                    'pesan'=>'Data berhasil disimpan',
                    'error'=>''
                );
            }else{
                $data=array(
                    'success'=>false,
                    'pesan'=>'Data Gagal Disimpan',
                    'error'=>''
                );
            }
        }

        return $data;
    }

    public function destroy(Request $request, $id)
    {
        $model=Pengurus::find($id);


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
