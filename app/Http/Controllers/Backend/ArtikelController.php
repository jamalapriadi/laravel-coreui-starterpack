<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cms\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $category=Artikel::select(
            'id',
            'slug',
            'title',
            'topik',
            'teaser',
            'description',
            'featured_youtube',
            'featured_facebook',
            'featured_image',
            'comment',
            'post_status',
            'post_type',
            'post_template',
            'author',
            'like_count',
            'di_lihat',
            'menu_order',
            'created_at',
            'updated_at'
        );

        if($request->has('course')){
            $category=$category->where('course_module_id',$request->course);
        }

        if($request->has('q')){
            $category=$category->where('title','like','%'.$request->input('q').'%');
        }

        $category=$category->orderBy('updated_at','desc')->paginate(25);

        return $category;
    }

    public function store(Request $request){
        $rules=[
            'course'=>'required',
            'type'=>'required',
            'title'=>'required',
            'tanggal'=>'required',
            'desc'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'error'=>$validasi->errors()->all()
            );
        }else{
            $artikel=new Artikel;
            $artikel->type_artikel=$request->input('type');
            $artikel->course_module_id=$request->input('course');
            $artikel->title=$request->input('title');
            $artikel->date_release=date('Y-m-d',strtotime($request->input('tanggal')));
            $artikel->author=auth()->user()->id;
            // $artikel->like_count=0;
            // $artikel->di_lihat=0;
            
            $type=$request->input('type');
            switch($type){
                case "artikel":
                        $artikel->description=$request->input('desc');
                    break;
                case "video":
                        $artikel->description=$request->input('desc');
                    break;

                default:

                    break;
            }

            $simpan=$artikel->save();

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
        $artikel=Artikel::find($id);

        return $artikel;
    }

    public function update(Request $request,$id){
        $rules=[
            'type'=>'required',
            'title'=>'required',
            'tanggal'=>'required',
            'desc'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'error'=>$validasi->errors()->all()
            );
        }else{
            $artikel=Artikel::find($id);
            $artikel->type_artikel=$request->input('type');
            $artikel->title=$request->input('title');
            $artikel->date_release=date('Y-m-d',strtotime($request->input('tanggal')));
            $artikel->author=auth()->user()->id;
            
            $type=$request->input('type');
            switch($type){
                case "artikel":
                        $artikel->description=$request->input('desc');
                    break;
                case "video":
                        $artikel->description=$request->input('desc');
                    break;

                default:

                    break;
            }

            $simpan=$artikel->save();

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
        $artikel=Artikel::find($id);

        $hapus=$artikel->delete();

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
}