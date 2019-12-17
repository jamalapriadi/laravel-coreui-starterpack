<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cms\Category;
use App\Models\Cms\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\Rules\ImageValidation;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function index(Request $request){
        $post=Post::with(
            [
                'category',
                'subcategory',
                'penulis'
            ]
        )->select('id','heading_title','title','slug','description','updated_at','author','post_type','di_lihat',
        'post_status');

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

    public function store(Request $request){
        $rules=[
            'title'=>'required',
            'page_type'=>'required',
            'template'=>'required',
            'menu'=>'required|unique:posts,menu_id',
            'file'=>['nullable',new ImageValidation]
        ];

        $pesan=[
            'menu.unique'=>'This Menu has already Page'
        ];

        $validasi=\Validator::make($request->all(),$rules,$pesan);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi Error',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $page_type=$request->input('page_type');

            $post=new Post;
            $post->heading_title=$request->input('heading_title');
            $post->title=$request->input('title');
            $post->second_title=$request->input('second_title');
            $post->menu_id=$request->input('menu');
            $post->page_type=$page_type;
            $post->post_type="page";
            $post->post_template=$request->input('template');

            if($request->has('sidebar_layout')){
                $post->sidebar_layout=$request->input('sidebar_layout');
            }
            
            if($request->has('sidebar_content')){
                $post->sidebar_content=$request->input('sidebar_content');
            }

            if($page_type == "url"){
                $post->page_url=$request->input('url');
            }

            if($page_type == "text"){
                $post->description=$request->input('desc');
                $post->comment='open';
                $post->teaser=$request->input('teaser');
            }

            if($page_type == "component" || $page_type == "text and component"){
                $post->description=$request->input('desc');
                $post->comment='open';
                $post->component_name=$request->input('component');
            }

            if($request->has('youtube')){
                $post->featured_youtube=$request->input('youtube');
            }

            if($request->has('facebook')){
                $post->featured_facebook=$request->input('facebook');
            }
            
            $post->post_status=$request->input('status');
            $post->author=\Auth::user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/page/')){
                    mkdir('uploads/page/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/page/').$filename);
                $post->featured_image=$filename;
            }

            $simpan=$post->save();

            if($simpan){

                if($request->has('slider')){
                    $slider=$request->input('slider');
    
                    foreach($slider as $key=>$val){
                        if(!is_dir('uploads/file/')){
                            mkdir('uploads/file/', 0777, TRUE);
                        }
        
                        $imageData = $val['file'];
                        $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                        Image::make($val['file'])->save(public_path('uploads/file/').$filename);
                        // $post->featured_image=$filename;
    
                        // $user->roles()->attach($roleId, ['expires' => $expires]);
    
                        \App\Models\Cms\Postfile::insert(
                            [
                                'post_id'=>$post->id,
                                'type_file'=>'image',
                                'title'=>$val['title'],
                                'file'=>$filename,
                                'author'=>auth()->user()->id
                            ]
                        );
                    }
                }

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

                if($request->has('images') && $request->input('images')!=""){
                    if(!is_dir('uploads/page/')){
                        mkdir('uploads/page/', 0777, TRUE);
                    }
    
                    $imageData = $request->input('images');
                    foreach($imageData as $key=>$val){
                        $filename2 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $val['name'];
                        Image::make($val['path'])->save(public_path('uploads/page/').$filename2);

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
        $post=Post::with('category','subcategory','tags','related','related.category','files')->find($id);

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
        $post=Post::findOrFail($id);

        $rules=[
            'title'=>'required',
            'page_type'=>'required',
            'template'=>'required',
            'menu'=>'required',
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
            $page_type=$request->input('page_type');

            $post->title=$request->input('title');
            $post->heading_title=$request->input('heading_title');
            $post->second_title=$request->input('second_title');
            $post->menu_id=$request->input('menu');
            $post->page_type=$page_type;
            $post->post_type="page";
            $post->post_template=$request->input('template');

            if($request->has('sidebar_layout')){
                $post->sidebar_layout=$request->input('sidebar_layout');
            }
            
            if($request->has('sidebar_content')){
                $post->sidebar_content=$request->input('sidebar_content');
            }

            if($page_type == "text"){
                $post->description=$request->input('desc');
                $post->comment='open';
                $post->teaser=$request->input('teaser');
            }

            if($page_type == "component" || $page_type == "text and component"){
                $post->description=$request->input('desc');
                $post->comment='open';
                $post->component_name=$request->input('component');
            }

            if($page_type == "url"){
                $post->page_url=$request->input('url');
            }

            if($request->has('youtube')){
                $post->featured_youtube=$request->input('youtube');
            }

            if($request->has('facebook')){
                $post->featured_facebook=$request->input('facebook');
            }
            
            $post->post_status=$request->input('status');
            $post->author=\Auth::user()->id;

            if($request->has('file') && $request->input('file')!=""){
                if(!is_dir('uploads/page/')){
                    mkdir('uploads/page/', 0777, TRUE);
                }

                $imageData = $request->input('file');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('file'))->save(public_path('uploads/page/').$filename);
                $post->featured_image=$filename;
            }

            $simpan=$post->save();

            if($simpan){

                if($request->has('slider')){
                    $slider=$request->input('slider');
    
                    foreach($slider as $key=>$val){
                        if($val['status'] == 'new'){
                            if(!is_dir('uploads/file/')){
                                mkdir('uploads/file/', 0777, TRUE);
                            }
            
                            $imageData = $val['file'];
                            $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                            Image::make($val['file'])->save(public_path('uploads/file/').$filename);
                            // $post->featured_image=$filename;
        
                            // $user->roles()->attach($roleId, ['expires' => $expires]);
        
                            \App\Models\Cms\Postfile::insert(
                                [
                                    'post_id'=>$post->id,
                                    'type_file'=>'image',
                                    'title'=>$val['title'],
                                    'file'=>$filename,
                                    'author'=>auth()->user()->id
                                ]
                            );
                        }
                    }
                }

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

                if($request->has('images') && $request->input('images')!=""){
                    if(!is_dir('uploads/page/')){
                        mkdir('uploads/page/', 0777, TRUE);
                    }
    
                    $imageData = $request->input('images');
                    foreach($imageData as $key=>$val){
                        $filename2 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $val['name'];
                        Image::make($val['path'])->save(public_path('uploads/page/').$filename2);

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

    public function delete_post_file(Request $request,$id)
    {
        $model=\App\Models\Cms\Postfile::find($id);

        $hapus=$model->delete();

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