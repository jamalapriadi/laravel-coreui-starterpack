<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Cms\Headline;
use App\Models\Cms\Post;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class TestimoniController extends Controller
{   
    public function index(Request $request)
    {
        $post=Post::where('post_type','testimoni')
            ->select('id','title','description','featured_image');

        if($request->has('q')){
            $post=$post->where('title','like','%'.$request->input('q').'%');
        }

        $post=$post->paginate(10);

        return $post;
    }

    public function store(Request $request)
    {
        $rules=[
            'title'=>'required',
            'desc'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi errors',
            );
        }else{
            $post=new Post;
            $post->title=$request->input('title');
            $post->description=$request->input('desc');
            $post->comment='close';
            $post->post_type="testimoni";
            $post->author=\Auth::user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/testimoni/')){
                    mkdir('uploads/testimoni/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/testimoni/').$filename);
                $post->featured_image=$filename;
            }

            $simpan=$post->save();

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

    public function show($id)
    {
        $post=Post::find($id);

        return $post;
    }

    public function update(Request $request,$id)
    {
        $rules=[
            'title'=>'required',
            'desc'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi errors',
            );
        }else{
            $post=Post::find($id);
            $post->title=$request->input('title');
            $post->description=$request->input('desc');
            $post->comment='close';
            $post->post_type="testimoni";
            $post->author=\Auth::user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/testimoni/')){
                    mkdir('uploads/testimoni/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/testimoni/').$filename);
                $post->featured_image=$filename;
            }

            $simpan=$post->save();

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

    public function destroy($id)
    {
        $post=Post::find($id);

        $hapus=$post->delete();

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