<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\Post;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class CalendarController extends Controller
{
    public function index(Request $request){
        $post=Post::with(
            [
                'category',
                'subcategory',
                'penulis',
                'files'
            ]
        )->where('post_type','calendar')
        ->select(
            'id',
            'title',
            'slug',
            'description',
            'updated_at',
            'author',
            'post_type',
            'di_lihat',
            'post_status',
            'lokasi',
            'jam_mulai',
            'jam_selesai',
            'tanggal',
            'featured_image'
        )->whereHas('files');

        if($request->has('q')){
            $post=$post->where('title','like','%'.$request->input('q').'%');
        }

        $post=$post->paginate(10);

        return $post;
    }

    public function store(Request $request){
        $rules=[
            'title'=>'required|max:125',
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
            if($request->has('kode') && $request->input('kode')!=""){
                $kd=$request->input('kode');
                $post=Post::find($kd);
            }else{
                $post=new Post;
            }
            
            $post->title=$request->input('title');
            $post->description=$request->input('desc');
            $post->comment='open';
            $post->post_status='publish';
            $post->post_type='calendar';


            if($request->has('youtube')){
                $post->featured_youtube=$request->input('youtube');
            }

            if($request->has('facebook')){
                $post->featured_facebook=$request->input('facebook');
            }
            
            $post->author=\Auth::user()->id;

            $simpan=$post->save();

            if($simpan){
                if($request->hasFile('file')){
                    if(!is_dir('uploads/file/')){
                        mkdir('uploads/file/', 0777, TRUE);
                    }
    
                    $imageData = $request->file('file');
                    $fileName = time().'.'.$request->file->getClientOriginalExtension();

                    if($imageData->move(public_path()."/uploads/file/",$fileName)){
                        \DB::table('post_files')
                            ->where('post_id',$post->id)
                            ->delete();

                        \DB::table('post_files')
                            ->insert(
                                [
                                    'post_id'=>$post->id,
                                    'type_file'=>'file',
                                    'file'=>$fileName,
                                    'author'=>auth()->user()->id,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s')
                                ]
                            );
                    }
                }
            }

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

    public function update(Request $request,$id){
        $rules=[
            'title'=>'required|max:125',
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
            $post->comment=$request->input('comment');
            $post->post_type='calendar';


            if($request->has('youtube')){
                $post->featured_youtube=$request->input('youtube');
            }

            if($request->has('facebook')){
                $post->featured_facebook=$request->input('facebook');
            }
            
            $post->post_status=$request->input('status');
            $post->author=\Auth::user()->id;

            if($request->hasFile('file')){
                if(!is_dir('uploads/file/')){
                    mkdir('uploads/file/', 0777, TRUE);
                }

                $imageData = $request->file('file');
                $fileName = time().'.'.$request->file->getClientOriginalExtension();

                if($imageData->move(public_path()."/uploads/file/",$fileName)){
                    \DB::table('post_files')
                        ->where('post_id',$post->id)
                        ->delete();


                    \DB::table('post_files')
                        ->insert(
                            [
                                'post_id'=>$post->id,
                                'type_file'=>'file',
                                'file'=>$fileName,
                                'author'=>auth()->user()->id,
                                'created_at'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s')
                            ]
                        );
                }

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
}
