<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\Post;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\Rules\ImageValidation;

class NewsletterController extends Controller
{
    public function index(Request $request){
        $post=Post::with(
            [
                'category',
                'subcategory',
                'penulis'
            ]
        )->where('post_type','newsletter')
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
        );

        if($request->has('q')){
            $post=$post->where('title','like','%'.$request->input('q').'%');
        }

        $post=$post->orderBy('updated_at','desc');

        if($request->has('halaman')){
            $halaman=$request->input('halaman');
        }else{
            $halaman=25;
        }

        return $post->paginate($halaman);
    }

    public function store(Request $request){
        $rules=[
            'title'=>'required',
            'desc'=>'required',
            'file'=>['nullable',new ImageValidation]
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
            $post->comment=$request->input('comment');
            $post->post_type='newsletter';


            if($request->has('youtube')){
                $post->featured_youtube=$request->input('youtube');
            }

            if($request->has('facebook')){
                $post->featured_facebook=$request->input('facebook');
            }
            
            $post->post_status=$request->input('status');
            $post->author=\Auth::user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/newsletter/')){
                    mkdir('uploads/newsletter/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/newsletter/').$filename);
                $post->featured_image=$filename;
            }

            $simpan=$post->save();

            if($simpan){

                if($request->has('attachment') && $request->input('attachment')!="")
                {
                    if(!is_dir('uploads/newsletter/')){
                        mkdir('uploads/newsletter/', 0777, TRUE);
                    }

                    $imageData = $request->input('attachment');
                    // $ext_file=$file->getClientOriginalExtension();
                    $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                    // $request->input('attachment')->save(public_path('uploads/newsletter/').$filename);
                    // $file->move(public_path('uploads/newsletter/'),$file->getClientOriginalName());
                    // $post->featured_image=$filename;

                    $post->files()->sync(
                        [
                            $post->id=>[
                                'file'=>$filename,
                                'author'=>auth()->user()->id
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
                    'pesan'=>'Data gagal disimpan',
                    'error'=>''
                );
            }
        }

        return $data;
    }
}
