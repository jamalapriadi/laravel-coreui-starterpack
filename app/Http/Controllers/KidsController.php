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

    public function list_gallery_file(Request $request)
    {
        if($request->ajax()){
            $model=\App\Models\Cms\Galleryfile::select('*');

            if($request->has('kode')){
                $model=$model->where('gallery_id',$request->input('kode'));
            }

            return $model->limit(6)->get();
        }

        return abort(404);
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