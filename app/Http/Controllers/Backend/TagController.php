<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cms\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request){
        \DB::statement(\DB::raw('set @rownum=0'));

        $tag=Tag::select(
            'id',
            'title',
            \DB::raw('@rownum := @rownum + 1 AS no')
        );

        return \DataTables::of($tag)
            ->addCOlumn('action',function($q){
                $html="<div class='btn-group'>
                    <a class='btn btn-warning btn-sm editcategory' kode='".$q->id."'><i class='icon-pencil'></i></a>
                    <a class='btn btn-danger btn-sm hapuscategory' kode='".$q->id."'><i class='icon-trash'></i></a>
                </div>";

                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request){
        $rules=['title'=>'required'];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $tag=new Tag;
            $tag->title=$request->input('title');
            $tag->save();

            $alldata=Tag::select(
                'id',
                'title as text'
            )->get();

            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil disimpan',
                'error'=>'',
                'data'=>$alldata
            );
        }

        return $data;
    }

    public function show($id){
        $tag=Tag::find($id);

        return $tag;
    }

    public function update(Request $request,$id){
        $rules=['title'=>'required'];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $tag=Tag::find($id);
            $tag->title=$request->input('title');
            $tag->save();

            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil disimpan',
                'error'=>''
            );
        }

        return $data;
    }

    public function destroy($id){
        $tag=Tag::find($id);

        $hapus=$tag->delete();

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

    public function list_tag(Request $request){
        $tag=Tag::select(
            'id',
            'title as text'
        );

        if($request->has('q')){
            $tag=$tag->where('title','like','%'.$request->input('q').'%');
        }

        if($request->has('page_limit')){
            $pagelimit=$request->input('page_limit');
        }else{
            $pagelimit=10;
        }

        return $tag->paginate($pagelimit);
    }

    public function list_tags(Request $request){
        $tag=Tag::select(
            'id',
            'title as text'
        )->get();

        $jumlah=count($tag)-1;
        $lis='';

        foreach($tag as $key=>$row){
            if($key == $jumlah){
                $lis.=$row->text;
            }else{
                $lis.=$row->text.",";
            }
        }

        $data=array(
            1=> 'Web Development',
            2=> 'PHP',
            3=> 'JavaScript',
        );

        
        return $data;

        return (string)$lis;
    }
}