<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kids\Jabatan;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $jabatan=Jabatan::select('*');
        
        if($request->has('q')){
            $jabatan=$jabatan->where('name','like','%'.$request->input('q').'%');
        }

        $jabatan=$jabatan->paginate(25);

        return $jabatan;
    }

    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|max:191'
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
                $jabatan=Jabatan::find($kd);
            }else{
                $jabatan=new Jabatan;
            }
            
            $jabatan->name=$request->input('name');

            $jabatan->save();

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
        $jabatan=Jabatan::find($id);

        return $jabatan;
    }

    public function destroy(Request $request, $id)
    {
        $jabatan=Jabatan::find($id);


        $hapus=$jabatan->delete();

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

    public function list_jabatan(){
        $jabatan=Jabatan::all();

        return $jabatan;
    }
}
