<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Cms\Instansi;

class WebController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function simpan_info(Request $request){
        $rules=[
            'nama_instansi'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'erros'=>$validasi->errors()->all()
            );
        }else{
            $newinfo=new Instansi;
            $newinfo->nama_instansi=$request->input('nama_instansi');
            $newinfo->nama_lengkap_instansi=$request->input('nama_lengkap_instansi');
            $newinfo->teaser=$request->input('teaser');
            $newinfo->tagline=$request->input('tagline');
            $newinfo->tentang=$request->input('tentang');
            $newinfo->alamat=$request->input('alamat');
            $newinfo->visi=$request->input('visi');
            $newinfo->misi=$request->input('misi');
            $newinfo->telp=$request->input('telp');
            $newinfo->email=$request->input('email');
            $newinfo->fax=$request->input('fax');
            $newinfo->website=$request->input('website');
            $newinfo->lat=$request->input('lat');
            $newinfo->lng=$request->input('lng');

            if($request->has('logo') && $request->input('logo')!=""){
                if(!is_dir('uploads/info/')){
                    mkdir('uploads/info/', 0777, TRUE);
                }
                $imageData = $request->input('logo');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('logo'))->save(public_path('uploads/info/').$filename);
                $newinfo->logo=$filename;
            }

            $simpan=$newinfo->save();

            if($simpan){
                \Artisan::call('db:seed');

                $data=array(
                    'success'=>true,
                    'pesan'=>'Data berhasil disimpan',
                    'errors'=>array()
                );
            }else{
                $data=array(
                    'success'=>false,
                    'pesan'=>'Data gagal disimpan',
                    'errors'=>array()
                );
            }
        }

        return response()->json($data);
    }
}
