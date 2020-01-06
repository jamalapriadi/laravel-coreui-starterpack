<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\Gallery;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;


class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $model=Gallery::with('file');

        if($request->has('q')){
            $model=$model->where('name','like','%'.$request->input('q').'%');
        }

        $model=$model->orderBy('updated_at','desc')->paginate(25);

        return $model;
    }

    public function store(Request $request)
    {
        $rules=[
            'name'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'message'=>'Validasi errors',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            if($request->has('kode') && $request->input('kode')!=null){
                $kode=$request->input('kode');

                $model= Gallery::find($kode);
            }else{
                $model= new Gallery;
            }
            
            $model->name=$request->input('name');
            $model->description = $request->input('desc');
            $model->author=auth()->user()->id;

            $related=$request->input('related');

            if($related == 'Yes'){
                if($request->has('event') && $request->input('event')!=null){
                    $model->event_id=$request->input('event');
                }
            }
            

            $simpan=$model->save();

            if($simpan)
            {
                $data=array(
                    'success'=>true,
                    'message'=>"Data berhasil disimpan",
                    'errors'=>array()
                );
            }else{
                $data=array(
                    'success'=>false,
                    'message'=>"Data failed to save",
                    'errors'=>array()
                );
            }
        }

        return $data;
    }

    public function detail_gallery($id)
    {
        $model=Gallery::with('file')->find($id);

        return $model;
    }

    public function save_file_gallery(Request $request, $id)
    {
        if($request->hasFile('file')){
            $imageData = $request->file('file');
            $fileName = time().'.'.$request->file->getClientOriginalExtension();

            return $fileName;
        }else{
            return "Tidak ada file";
        }
        
        $model=Gallery::with('file')->find($id);

        $type=$request->input('type');

        if($type == "image"){
            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/gallery/'.$id.'/')){
                    mkdir('uploads/gallery/'.$id.'/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/gallery/'.$id.'/').$filename);
                // $post->featured_image=$filename;

                if($request->has('kode') && $request->input('kode')!=null){
                    \App\Models\Cms\Galleryfile::where('id',$request->input('kode'))
                        ->update(
                            [
                                'file' => $filename,
                                'title'=>$request->input('video_title'),
                                'file_type'=>'image',
                                'author'=>auth()->user()->id
                            ]
                        );
                }else{
                    $model->file()->create([
                        'file' => $filename,
                        'title'=>$request->input('video_title'),
                        'file_type'=>'image',
                        'author'=>auth()->user()->id
                    ]);
                }
                
            }else{
                if($request->has('kode') && $request->input('kode')!=null){
                    \App\Models\Cms\Galleryfile::where('id',$request->input('kode'))
                        ->update(
                            [
                                'title'=>$request->input('video_title'),
                                'file_type'=>'image',
                                'author'=>auth()->user()->id
                            ]
                        );
                }
            }
        }else if($type == "video"){
            $videoId = \Youtube::parseVidFromURL($request->input('video_url'));

            if($request->has('kode') && $request->input('kode')!=null){
                \App\Models\Cms\Galleryfile::where('id',$request->input('kode'))
                    ->update(
                        [
                            'file' => $videoId,
                            'title'=>$request->input('video_title'),
                            'file_type'=>'video',
                            'video_url'=>$request->input('video_url'),
                            'author'=>auth()->user()->id
                        ]
                    );
            }else{
                $model->file()->create([
                    'file' => $videoId,
                    'title'=>$request->input('video_title'),
                    'file_type'=>'video',
                    'video_url'=>$request->input('video_url'),
                    'author'=>auth()->user()->id
                ]);
            }
            
        }else{
            return array(
                'success'=>false,
                'message'=>'Type Not Found'
            );
        }

        return array(
            'success'=>true,
            'message'=>'Data has been saved',
            'errors'=>array()
        );
    }

    public function detele_file_gallery($id)
    {
        $model=\App\Models\Cms\Galleryfile::find($id);

        $hapus=$model->delete();

        if($hapus){
            $data=array(
                'success'=>true,
                'message'=>'Data has been deleted'
            );
        }else{
            $data=array(
                'success'=>false,
                'message'=>'Data failed deleted'
            );
        }

        return $data;
    }
}
