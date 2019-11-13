<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cms\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index(){
        \DB::statement(\DB::raw('set @rownum=0'));

        $modul=Modul::select('id','modul_name','slug','description','updated_at','author',
        'level','cover_image',
        \DB::raw('@rownum := @rownum + 1 AS no'));

        return \DataTables::of($modul)
            ->addColumn('detail',function($q){
                $html="";
                $html.='<a href="#" class="text-default display-inline-block">
                        <span class="text-semibold">'.$q->modul_name.'</span>
                        <span class="display-block text-muted">'.$q->description.'</span>
                </a>';

                return $html;
            })
            ->addCOlumn('action',function($q){
                $html="<div class='btn-group'>
                    <a class='btn btn-success btn-sm' href='".\URL::to('xxx-dashboard/modul/'.$q->id.'/artikel')."'><i class='icon-gear'></i></a>
                    <a class='btn btn-warning btn-sm editmodul' kode='".$q->id."'><i class='icon-pencil'></i></a>
                    <a class='btn btn-danger btn-sm hapusmodul' kode='".$q->id."'><i class='icon-trash'></i></a>
                </div>";

                return $html;
            })
            ->addColumn('last_update',function($q){
                return date('d M Y H:i:s',strtotime($q->updated_at));
            })
            ->rawColumns(['detail','action'])
            ->make(true);
    }

    public function store(Request $request){
        $rules=[
            'name'=>'required',
            'desc'=>'required',
            'level'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'error'=>$validasi->errors()->all()
            );
        }else{
            $modul=new Modul;
            $modul->modul_name=$request->input('name');
            $modul->description=$request->input('desc');
            $modul->level=$request->input('level');
            $modul->author=\Auth::user()->id;

            if($request->hasFile('file')){
                if(!is_dir('uploads/modul/')){
                    mkdir('uploads/modul/', 0777, TRUE);
                }

                $file=$request->file('file');
                $filename=str_random(5).'-'.$file->getClientOriginalName();
                $filename=$file->getClientOriginalName();
                $destinationPath="uploads/modul/";

                if($file->move($destinationPath,$filename)){
                    $modul->cover_image=$filename;
                }
            }

            $simpan=$modul->save();

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
        $modul=Modul::find($id);

        return $modul;
    }

    public function update(Request $request,$id){
        $rules=[
            'name'=>'required',
            'desc'=>'required',
            'level'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'error'=>$validasi->errors()->all()
            );
        }else{
            $modul=Modul::find($id);
            $modul->slug=null;
            $modul->modul_name=$request->input('name');
            $modul->description=$request->input('desc');
            $modul->level=$request->input('level');
            $modul->author=\Auth::user()->id;

            if($request->hasFile('file')){
                if(!is_dir('uploads/modul/')){
                    mkdir('uploads/modul/', 0777, TRUE);
                }

                $file=$request->file('file');
                $filename=str_random(5).'-'.$file->getClientOriginalName();
                $filename=$file->getClientOriginalName();
                $destinationPath="uploads/modul/";

                if($file->move($destinationPath,$filename)){
                    $modul->cover_image=$filename;
                }
            }

            $simpan=$modul->save();

            if($simpan){
                $data=array(
                    'success'=>true,
                    'pesan'=>'Data berhasil diupdate',
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

    public function destroy($id){
        $modul=Modul::find($id);

        $hapus=$modul->delete();

        if($hapus){
            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil dihapus',
                'error'=>''
            );
        }else{
            $data=array(
                'success'=>false,
                'pesan'=>'Data gagal dihapus',
                'error'=>''
            );
        }

        return $data;
    }

    public function artikel($id){
        $modul=Modul::with('user','artikel','artikel.user')->find($id);

        return view('backend.artikel')
            ->with('id',$id)
            ->with('modul',$modul);
    }

    public function add_new_artikel($id){
        $modul=Modul::with('user','artikel','artikel.user')->find($id);

        return view('backend.add_new_artikel')
            ->with('id',$id)
            ->with('modul',$modul);
    }
}