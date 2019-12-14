<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Cms\Instansi;
use App\Models\Cms\Post;
use App\Models\Cms\Carousel;
use App\Models\Cms\Carouseloverlay;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactUs;

class WebController extends Controller
{
    public function __construct()
    {
        $info=\App\Models\Cms\Instansi::first();

        \View::share('instansi',$info);
    }
    
    public function index(){

        $calendar=\App\Models\Cms\Post::where('post_type','calendar')
                ->with('files')
                ->whereHas('files')
                ->first();

        $overlay=Carouseloverlay::select('text')->first();
        $carousel=Carousel::select('caption','text','image')
            ->where('active','Y')
            ->get();

        return view('web.home')
            ->with('calendar',$calendar)
            ->with('overlay',$overlay)
            ->with('carousel',$carousel);
    }

    public function gallery(Request $request)
    {
        return view('web.gallery');
    }

    public function single_page(Request $request,$slug ='/')
    {
        if($slug=='home'){
            if(\Auth::check()){
                return view('home');
            }else{
                return view('web.404');    
            }
        }

        if($slug=='login'){
            return view('auth.login');
        }

        $page = Post::with('category','tags','tags.tagnya','penulis','comment','comment.child','files')
            ->where('post_type',"page")
            ->whereSlug($slug)
            ->first();

        $program=array();

        if($page->component_name == "program-component"){
            $program=\App\Models\Cms\Post::where('post_type','program')
                ->get();
        }

        $component=array();

        if($page->page_type == "component"){
            if($page->component_name == "founder-component"){
                $component=\App\Models\Kids\Founder::orderBy('created_at','desc')->get();
            }
        }

        if($page == null){
            return abort(404);
        }

        return view('web.single_page')
            ->with('page',$page)
            ->with('program',$program)
            ->with('component', $component);
    }

    public function single_promo(Request $request, $slug='/')
    {
        $page = Post::with('category','tags','tags.tagnya','penulis','comment','comment.child','files')
            ->where('post_type',"promo")
            ->whereSlug($slug)
            ->first();

        if($page == null){
            return abort(404);
        }

        $other=Post::where('slug','<>',$slug)
            ->with('category','tags','tags.tagnya','penulis','comment','comment.child','files')
            ->where('post_type',"promo")
            ->orderBy('created_at','desc')
            ->get();

        return view('web.single_promo')
            ->with('page',$page)
            ->with('other',$other);
    }

    public function single_news(Request $request, $slug='/')
    {
        $page = Post::with('category','tags','tags.tagnya','penulis','comment','comment.child','files')
            ->where('post_type',"artikel")
            ->whereSlug($slug)
            ->first();

        if($page == null){
            return abort(404);
        }

        $other=Post::where('slug','<>',$slug)
            ->with('category','tags','tags.tagnya','penulis','comment','comment.child','files')
            ->where('post_type',"artikel")
            ->orderBy('created_at','desc')
            ->get();

        return view('web.single_artikel')
            ->with('page',$page)
            ->with('other',$other);
    }

    public function single_event(Request $request, $slug='/')
    {
        $page = Post::with('category','tags','tags.tagnya','penulis','comment','comment.child','files')
            ->where('post_type',"event")
            ->whereSlug($slug)
            ->first();

        if($page == null){
            return abort(404);
        }

        $other=Post::where('slug','<>',$slug)
            ->with('category','tags','tags.tagnya','penulis','comment','comment.child','files')
            ->where('post_type',"event")
            ->orderBy('created_at','desc')
            ->get();

        return view('web.single_event')
            ->with('page',$page)
            ->with('other',$other);
    }

    public function subscribe(Request $request)
    {
        return view('web.subscribe');
    }

    public function list_menu(Request $request){
        if($request->ajax()){
            $menu=\App\Models\Cms\Menu::with('child','child')
                ->whereNull('parent_id')
                ->where('active','Y')
                ->select(
                    [
                        'id',
                        'menu',
                        'slug',
                        'thumb',
                        'parent_id',
                        'no_urut',
                        'active'
                    ]
                )
                ->get();

            return $menu;
        }

        return abort(404);
    }

    public function list_carousel(Request $request)
    {
        if($request->ajax()){
            $overlay=Carouseloverlay::select('text')->first();
            $carousel=Carousel::select('caption','text','image')
                ->where('active','Y')
                ->get();

            return array(
                'overlay'=>$overlay,
                'carousel'=>$carousel
            );
        }

        return abort(404);
    }

    public function list_promo(Request $request)
    {
        $post=Post::with(
            [
                'category',
                'subcategory',
                'penulis'
            ]
        )->where('post_type','promo')
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

        $post=$post->get();

        return $post;
    }
    
    public function save_subscribe(Request $request)
    {
        $rules=[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'phone'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'message'=>"Valdiasi errors",
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $model=new \App\Models\Cms\Subscribe;
            $model->first_name=$request->input('first_name');
            $model->last_name=$request->input('last_name');
            $model->email=$request->input('email');
            $model->phone=$request->input('phone');
            $model->ip_address=\Request::ip();
            $model->save();

            $data=array(
                'success'=>true,
                'message'=>'You has been subscribe our newsletter',
                'errors'=>array()
            );
        }

        return $data;
    }

    public function simpan_info(Request $request){
        $rules=[
            'nama_instansi'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'erros'=>$validasi->errors()->all()
            );
        }else{
            $newinfo=new Instansi;
            $newinfo->nama_instansi=$request->input('nama_instansi');
            $newinfo->nama_lengkap_instansi=$request->input('nama_lengkap_instansi');
            $newinfo->teaser=$request->input('teaser');
            $newinfo->tagline=$request->input('tagline');
            $newinfo->tentang=$request->input('tentang');
            $newinfo->alamat=$request->input('alamat');
            $newinfo->visi=$request->input('visi');
            $newinfo->misi=$request->input('misi');
            $newinfo->telp=$request->input('telp');
            $newinfo->email=$request->input('email');
            $newinfo->fax=$request->input('fax');
            $newinfo->website=$request->input('website');
            $newinfo->lat=$request->input('lat');
            $newinfo->lng=$request->input('lng');

            if($request->has('logo') && $request->input('logo')!=""){
                if(!is_dir('uploads/info/')){
                    mkdir('uploads/info/', 0777, TRUE);
                }
                $imageData = $request->input('logo');
                $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->input('logo'))->save(public_path('uploads/info/').$filename);
                $newinfo->logo=$filename;
            }

            $simpan=$newinfo->save();

            if($simpan){
                \Artisan::call('db:seed');

                $data=array(
                    'success'=>true,
                    'pesan'=>'Data berhasil disimpan',
                    'errors'=>array()
                );
            }else{
                $data=array(
                    'success'=>false,
                    'pesan'=>'Data gagal disimpan',
                    'errors'=>array()
                );
            }
        }

        return response()->json($data);
    }

    public function save_kontak(Request $request)
    {
        $rules=[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'message'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'message'=>'Validasi errors',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $pesan = $request->input('message');

            $model=new \App\Models\Cms\Message;
            $model->first_name=$request->input('first_name');
            $model->last_name=$request->input('last_name');
            $model->email=$request->input('email');
            $model->phone=$request->input('phone');
            $model->message=$request->input('message');
            $simpan=$model->save();

            if($simpan){
                \Mail::to('info@kidsrepublic.sch.id')
                    ->send(new SendContactUs($first_name,$last_name,$email,$phone,$pesan));

                $data=array(
                    'success'=>true,
                    'message'=>'Message send',
                    'errors'=>array()
                );
            }else{
                $data=array(
                    'success'=>false,
                    'message'=>'Message fail to send',
                    'errors'=>array()
                );
            }

        }

        return $data;
    }
}
