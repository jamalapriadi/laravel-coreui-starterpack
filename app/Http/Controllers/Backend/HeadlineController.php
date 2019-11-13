<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Cms\Headline;
use App\Models\Cms\Post;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class HeadlineController extends Controller
{
    public function index(Request $request)
    {
        $rules=['type'=>'required'];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi Error',
                'head'=>array()
            );
        }else{
            $type=$request->input('type');

            if($type=="Slide"){
                $head=Headline::with(
                    [
                        'post'
                    ]
                )
                ->where('type_headline','Slide')
                ->paginate(25);
            }else if($type=="Featured"){
                $head=Headline::with(
                    [
                        'post'
                    ]
                )
                ->where('type_headline','Featured')
                ->paginate(25);
            }   

            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil di load',
                'head'=>$head
            );
        }

        return $data;
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
                'pesan'=>'Validasi Error',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $post=new Post;
            $post->title=$request->input('title');
            $post->description=$request->input('desc');
            $post->comment='open';
            $post->topik=$request->input('topik');
            $post->teaser=$request->input('teaser');
            $post->post_status=$request->input('status');
            $post->post_type='Featured';

            if($request->has('youtube')){
                $post->featured_youtube=$request->input('youtube');
            }

            if($request->has('facebook')){
                $post->featured_facebook=$request->input('facebook');
            }

            
            $post->author=\Auth::user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/blog/')){
                    mkdir('uploads/blog/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/blog/').$filename);
                $post->featured_image=$filename;
            }

            $simpan=$post->save();

            if($simpan){
                $headline=new Headline;
                $headline->post_id=$post->id;
                $headline->type_headline=$request->input('type');
                $headline->save();

                $data=array(
                    'success'=>true,
                    'pesan'=>'Data berhasil disimpan',
                    'error'=>array()
                );
            }else{
                $data=array(
                    'success'=>false,
                    'pesan'=>'Data gagal disimpan',
                    'error'=>array()
                );
            }
        }

        return $data;
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
                'pesan'=>'Validasi Error',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $post=Post::find($id);
            $post->title=$request->input('title');
            $post->description=$request->input('desc');
            $post->comment='open';
            $post->topik=$request->input('topik');
            $post->teaser=$request->input('teaser');
            $post->post_status=$request->input('status');
            $post->post_type='Featured';

            if($request->has('youtube')){
                $post->featured_youtube=$request->input('youtube');
            }

            if($request->has('facebook')){
                $post->featured_facebook=$request->input('facebook');
            }

            
            $post->author=\Auth::user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/blog/')){
                    mkdir('uploads/blog/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/blog/').$filename);
                $post->featured_image=$filename;
            }

            $simpan=$post->save();

            if($simpan){
                $data=array(
                    'success'=>true,
                    'pesan'=>'Data berhasil disimpan',
                    'error'=>array()
                );
            }else{
                $data=array(
                    'success'=>false,
                    'pesan'=>'Data gagal disimpan',
                    'error'=>array()
                );
            }
        }

        return $data;
    }

    public function destroy($id)
    {
        $headline=Headline::find($id);

        $hapus=$headline->delete();

        if($hapus)
        {
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

    public function list_headline(Request $request)
    {
        $rules=['type'=>'required'];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $type=$request->input('type');

            $postHead = Headline::pluck('post_id')
                ->where('type_headline',$type)
                ->all();
            $post = \App\Models\Cms\Post::whereNotIn('id', $postHead)
                ->where('post_type','artikel')
                ->get();

            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil diload',
                'errors'=>array(),
                'post'=>$post
            );
        }

        return $data;
    }
}
