<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Cms\Instansi;
use App\Models\Cms\Post;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class KidsController extends Controller
{
    public function list_founder(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Kids\Founder::orderBy('created_at','desc')->get();

            return $model;
        }

        return abort(404);
    }

    public function list_video_profile(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Instansivideo::orderBy('created_at','desc')->get();

            return $model;
        }

        return abort(404);
    }

    public function list_fasilitas(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Fasilitas::all();

            return $model;
        }

        return abort(404);
    }

    public function list_promo(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Post::where('post_type','promo')
                ->get();

            return $model;
        }

        return abort(404);
    }

    public function list_testimoni(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Post::where('post_type','testimoni')
                ->get();

            return $model;
        }

        return abort(404);
    }

    public function latest_news(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Post::where('post_type','artikel')
                ->get();

            return $model;
        }

        return abort(404);
    }

    public function list_event(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Post::where('post_type','event')
                ->get();

            return $model;
        }

        return abort(404);
    }

    public function list_newsletter(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Post::where('post_type','newsletter')
                ->get();

            return $model;
        }

        return abort(404);
    }

    public function list_program(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Post::where('post_type','program')
                ->get();

            return $model;
        }

        return abort(404);
    }

    public function list_gallery(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Gallery::all();

            return $model;
        }

        return abort(404);
    }

    public function list_calendar(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Post::where('post_type','calendar')
                ->with('files')
                ->whereHas('files')
                ->first();

            return $model;
        }

        return abort(404);
    }

    public function list_gallery_file(Request $request)
    {
        if($request->ajax()){
            /** set untuk default gallery */
            $gallery=\App\Models\Cms\Gallery::with(
                [
                    'file',
                    'file.gallery'
                ]
            )
            ->orderBy('id','asc');

            if($request->has('kode') && $request->input('kode')!=""){
                $gallery=$gallery->where('id',$request->input('kode'));
            }

            $gallery=$gallery->get();
    
            $listdefault=array();
            $iddefault=array();
    
            foreach($gallery as $key=>$val){
                $listdefault[]=$val->file[0];
    
                if(count($val->file) > 0){
                    $iddefault[]=$val->file[0]->id;
                }
            }
            /**end set default gallery */

            $model=\App\Models\Cms\Galleryfile::select('*')
                ->whereNotIn('id',$iddefault);

            if($request->has('kode') && $request->input('kode')!=""){
                $model=$model->where('gallery_id',$request->input('kode'));
            }

            if($request->has('per_page')){
                $per_page=$request->input('per_page');
            }else{
                $per_page=6;
            }

            return array(
                'default'=>$listdefault,
                'tambahan'=>$model->get()
            );
        }

        return abort(404);
    }

    public function gallery_file_by_id(Request $request, $id)
    {
        $model=\App\Models\Cms\Galleryfile::where('gallery_id',$id)
            ->get();

        return $model;
    }

    public function upload_file_ckfinder(Request $request)
    {
        if($request->has('upload') && $request->input('upload')!=""){
            if(!is_dir('uploads/blog/')){
                mkdir('uploads/blog/', 0777, TRUE);
            }

            return $imageData = $request->file('file');
            
            $post->featured_image=$filename;
        }
    }
}