<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kids\Posisi;

class PosisiController extends Controller
{
    public function index(Request $request)
    {
        $model=Posisi::with('jabatan');
        
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
            'jabatan'=>'required'
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
                $model=Posisi::find($kd);
            }else{
                $model=new Posisi;
            }
            
            $model->name=$request->input('name');

            $simpan=$model->save();

            if($simpan){
                if($request->has('jabatan')){
                    $model->jabatan()->sync($request->input('jabatan'));
                }
            }

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
        $model=Posisi::with('jabatan')->find($id);

        return $model;
    }

    public function destroy(Request $request, $id)
    {
        $model=Posisi::find($id);


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

    public function list_posisi(Request $request)
    {
        $model=Posisi::with('jabatan');

        if($request->has('jabatan')){
            $jabatan=$request->input('jabatan');

            $model=$model->whereHas('jabatan',function($q) use($jabatan){
                $q->where('id',$jabatan);
            });
        }

        return $model->get();
    }
}
