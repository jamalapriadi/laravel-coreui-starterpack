<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cms\Category;
use App\Models\Cms\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\Rules\ImageValidation;

class PostController extends Controller
{
    public function index(Request $request){
        $post=Post::with(
            [
                'category',
                'subcategory',
                'penulis'
            ]
        )->select('id','heading_title','title','slug','description','updated_at','author','post_type','di_lihat',
        'post_status','featured_image');

        if($request->has('type')){
            $type=$request->input('type');

            $post=$post->where('post_type',$type);
        }else{
            $post=$post->where('post_type','artikel');
        }

        if($request->has('q')){
            $post=$post->where('title','like','%'.$request->input('q').'%');
        }

        $post=$post->paginate(10);

        return $post;
    }

    public function page(){
        return view('backend.page');
    }

    public function create(){
        // $category=Category::select('id','category_name')->get();

        // return view('backend.create_blog')
        //     ->with('category',$category);
    }

    public function create_page()
    {
        // $template=Post::where('post_type','template')->get();

        // return view('backend.create_page')
        //     ->with('template',$template);
    }

    public function store(Request $request){
        $rules=[
            'title'=>'required',
            'teaser'=>'required',
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
            $post->second_title=$request->input('second_title');
            $post->description=$request->input('desc');
            $post->comment='open';
            $post->teaser=$request->input('teaser');


            if($request->has('youtube')){
                $post->featured_youtube=$request->input('youtube');
            }

            if($request->has('facebook')){
                $post->featured_facebook=$request->input('facebook');
            }

            if($request->has('type')){
                $post->post_type="page";
            }else{
                $post->post_type="artikel";
            }
            
            $post->post_status=$request->input('status');
            $post->author=\Auth::user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/artikel/')){
                    mkdir('uploads/artikel/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/artikel/').$filename);
                $post->featured_image=$filename;
            }

            $simpan=$post->save();

            if($simpan){
                if($request->has('categories') && $request->input('categories')!=""){
                    $cat=$request->input('categories');

                    foreach($cat as $row){
                        \DB::table('post_category')
                        ->insert(
                            [
                                'category_id'=>$row['id'],
                                'post_id'=>$post->id,
                                'type'=>'Category'
                            ]
                        );
                    }
                }

                // if($request->has('subcategory') && $request->input('subcategory')!=""){
                //     $subcat=$request->input('subcategory');

                //     \DB::table('post_category')
                //         ->insert(
                //             [
                //                 'category_id'=>$subcat,
                //                 'post_id'=>$post->id,
                //                 'type'=>'Subcategory'
                //             ]
                //         );
                // }

                if($request->has('tags') && $request->input('tags')!=""){
                    $tags=$request->input('tags');
                    if(count($tags)>0){
                        foreach($tags as $key=>$val){
                            \DB::table('post_tags')
                                    ->insert(
                                        [
                                            'post_id'=>$post->id,
                                            'tag_name'=>$val,
                                            'author'=>auth()->user()->id,
                                            'created_at'=>date('Y-m-d H:i:s'),
                                            'updated_at'=>date('Y-m-d H:i:s')
                                        ]
                                    );
                        }
                    }
                }

                /*save related news*/
                if($request->has('relatednews') && $request->input('relatednews')!=""){
                    $related=$request->input('relatednews');

                    if(count($related) > 0){
                        foreach($related as $key=>$val){
                            \DB::Table('post_related')
                                ->insert(
                                    [
                                        'post_id'=>$post->id,
                                        'related_id'=>$val['id']
                                    ]
                                );
                        }
                    }
                }

                if($request->has('images') && $request->input('images')!=""){
                    if(!is_dir('uploads/artikel/')){
                        mkdir('uploads/artikel/', 0777, TRUE);
                    }
    
                    $imageData = $request->input('images');
                    foreach($imageData as $key=>$val){
                        $filename2 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $val['name'];
                        Image::make($val['path'])->save(public_path('uploads/artikel/').$filename2);

                        \DB::table('post_files')
                            ->insert(
                                [
                                    'post_id'=>$post->id,
                                    'type_file'=>'image',
                                    'file'=>$filename2,
                                    'author'=>auth()->user()->id,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s')
                                ]
                            );
                    }
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

    public function show(Request $request,$id)
    {
        $post=Post::with('category','subcategory','tags','related','related.category')->find($id);

        return $post;
    }

    public function edit(Request $request,$id){
        $post=Post::with('category','subcategory','tags','related','related.category')->find($id);
        $category=Category::select('id','category_name')->get();

        return view('backend.edit_post')
            ->with('post',$post)
            ->with('category',$category);
    }

    public function edit_page($id)
    {
        $post=Post::find($id);
        $template=Post::where('post_type','template')->get();

        return view('backend.edit_page')
            ->with('post',$post)
            ->with('template',$template);
    }

    public function update(Request $request,$id){
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
            $post=Post::find($id);
            $post->slug=null;
            $post->title=$request->input('title');
            $post->second_title=$request->input('second_title');
            $post->description=$request->input('desc');
            $post->comment='open';
            $post->teaser=$request->input('teaser');
            $post->post_status=$request->input('status');

            if($request->has('youtube')){
                $post->featured_youtube=$request->input('youtube');
            }

            if($request->has('facebook')){
                $post->featured_facebook=$request->input('facebook');
            }

            if($request->has('type')){
                $post->post_type="page";
            }else{
                $post->post_type="artikel";
            }

            
            $post->author=\Auth::user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/artikel/')){
                    mkdir('uploads/artikel/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/artikel/').$filename);
                $post->featured_image=$filename;
            }

            $simpan=$post->save();

            if($simpan){
                if($request->has('categories') && $request->input('categories')!=""){
                    $cat=$request->input('categories');

                    foreach($cat as $row){
                        //cek 
                        $cekcategory=\DB::table('post_category')
                            ->where('category_id',$row['id'])
                            ->where('post_id',$id)
                            ->where('type','Category')
                            ->count();

                        if($cekcategory == 0){
                            \DB::table('post_category')
                                ->insert(
                                    [
                                        'category_id'=>$row['id'],
                                        'post_id'=>$id,
                                        'type'=>'Category'
                                    ]
                                );
                        }
                    }
                }

                // if($request->has('subcategory')){
                //     $subcat=$request->input('subcategory');

                //     \DB::table('post_category')
                //         ->insert(
                //             [
                //                 'category_id'=>$subcat,
                //                 'post_id'=>$id,
                //                 'type'=>'Subcategory'
                //             ]
                //         );
                // }

                if($request->has('tags') && $request->input('tags')!=""){
                    $tags=$request->input('tags');
                    if(count($tags)>0){
                        foreach($tags as $key=>$val){
                            $cektag=\DB::table('post_tags')
                                ->where('post_id',$id)
                                ->where('tag_name',$val)
                                ->count();

                            if($cektag == 0){
                                \DB::table('post_tags')
                                    ->insert(
                                        [
                                            'post_id'=>$id,
                                            'tag_name'=>$val,
                                            'author'=>auth()->user()->id,
                                            'created_at'=>date('Y-m-d H:i:s'),
                                            'updated_at'=>date('Y-m-d H:i:s')
                                        ]
                                    );
                            }
                        }
                    }
                }

                /*save related news*/
                if($request->has('relatednews') && $request->input('relatednews')!=""){
                    $related=$request->input('relatednews');

                    if(count($related) > 0){
                        foreach($related as $key=>$val){
                            $cekrelated=\DB::Table('post_related')
                                ->where('post_id',$id)
                                ->where('related_id',$val['id'])
                                ->count();

                            if($cekrelated == 0){
                                \DB::Table('post_related')
                                    ->insert(
                                        [
                                            'post_id'=>$id,
                                            'related_id'=>$val['id']
                                        ]
                                    );
                            }
                        }
                    }
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

    public function destroy($id){
        $post=Post::find($id);

        $hapus=$post->delete();

        if($hapus){
            \DB::Table('post_related')
                ->where('post_id',$id)
                ->delete();

            \DB::table('post_tags')
                ->where('post_id',$id)
                ->delete();

            \DB::table('post_category')
                ->where('post_id',$id)
                ->delete();

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

    public function list_data(Request $request){
        $post=Post::with(
            [
                'category',
                'subcategory',
                'penulis'
            ]
        )->select('id','title','slug','description','updated_at','author','post_type','di_lihat',
        'post_status');

        if($request->has('type')){
            $type=$request->input('type');
            $post=$post->where('post_type',$type);
        }else{
            $post=$post->where('post_type','artikel');
        }

        if($request->has('q') && $request->input('q')!=""){
            $post=$post->where('title','like','%'.$request->input('q').'%');
        }

        $post=$post->paginate(15);

        return $post;
    }


    public function embed_youtube($url){
        return $video = \Youtube::getVideoInfo('rie-hPVJ7Sw');
        $urls = "https://www.youtube.com/watch?v=8eK-5ivYb3o";

        //Optional array of website names, if present any websites not in the array will result in false being returned by the parser
        $whitelist = ['YouTube', 'Vimeo'];

        //Optional parameters to be appended to embed
        $params = [
            'autoplay' => 1,
            'loop' => 1
        ];

        //Optional attributes for embed container
        $attributes = [
            'type' => null,
            'class' => 'iframe-class',
            'data-html5-parameter' => true
        ];

        // return \LaravelVideoEmbed::getYoutubeThumbnail($urls);
        return \LaravelVideoEmbed::parse($urls, $whitelist, $params, $attributes);

        // return LaravelVideoEmbed::parse($url, $whitelist);
        // // "<iframe src="https://www.youtube.com/embed/8eK-5ivYb3o?wmode=transparent" type="text/html" width="480" height="295" frameborder="0" allowfullscreen></iframe>"

        // return LaravelVideoEmbed::parse($url);
        // // "<iframe src="https://www.youtube.com/embed/8eK-5ivYb3o?wmode=transparent" type="text/html" width="480" height="295" frameborder="0" allowfullscreen></iframe>"

        // return LaravelVideoEmbed::parse($url, ['Vimeo']);
        // // false

        // return LaravelVideoEmbed::parse($url, $whitelist, $params, $attributes)
        // //<iframe src="https://www.youtube.com/embed/8eK-5ivYb3o?wmode=transparent&amp;autoplay=1&amp;loop=1" type="" width="480" height="295" frameborder="0" allowfullscreen class="iframe-class" data-html5-parameter></iframe>

        // return LaravelVideoEmbed::getYoutubeThumbnail($url)
        // //https://<youtube image thumbnail with max resolution>. usage: <img src="{{ LaravelVideoEmbed::getYoutubeThumbnail($url) }}"> 
    }

    public function subscribe(Request $request)
    {
        $post=\App\Models\Cms\Subscribe::select('*');

        if($request->has('q')){
            $post=$post->where('first_name','like','%'.$request->input('q').'%');
        }

        $post=$post->paginate(10);

        return $post;
    }

    public function subscribe_delete(Request $request, $id)
    {
        $post=\App\Models\Cms\Subscribe::find($id);

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

    public function messages(Request $request)
    {
        $post=\App\Models\Cms\Message::select('*');

        if($request->has('q')){
            $post=$post->where('first_name','like','%'.$request->input('q').'%');
        }

        $post=$post->paginate(10);

        return $post;
    }

    public function message_delete(Request $request,$id)
    {
        $post=\App\Models\Cms\Message::find($id);

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