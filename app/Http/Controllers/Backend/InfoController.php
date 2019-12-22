<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cms\Instansi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Cms\Post;
use App\Models\Cms\Menu;

class InfoController extends Controller
{
    function index(){
        $info=Instansi::select('*')->first();

        if($info){
            return $info;
        }else{
            return array();
        }
    }

    public function dashboard(Request $request)
    {
        $page=Post::where('post_type','page')->count();
        $menu=Menu::select('*')->count();
        $news=Post::where('post_type','artikel')->count();
        $event=Post::where('post_type','event')->count();

        return array(
            'page'=>$page,
            'menu'=>$menu,
            'news'=>$news,
            'event'=>$event
        );
    }

    public function access_log(Request $request)
    {
        $sql=\DB::select("select date_format(ts.tanggal,'%d') as hari, count(*) as jumlah 
                from (
                select date_format(a.created_at,'%Y-%m-%d') as tanggal from access_logs a
                where date_format(a.created_at,'%Y-%m')=date_format(curdate(), '%Y-%m')
                ) as ts
                group by ts.tanggal");

        $label=array();
        $data=array();
        foreach($sql as $key=>$val){
            $label[]=$val->hari;
        }

        $data[]=array('Hari','Jumlah');
        foreach($sql as $key=>$val){
            $data[]=array($label[$key], $val->jumlah);
        }

        return array(
            'bulan'=>date('F Y'),
            'data'=>$data
        );
    }

    public function save_info(Request $request){
        $rules=[
            'nama_instansi'=>'required',
            'nama_lengkap_instansi'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'erros'=>$validasi->errors()->all()
            );
        }else{
            if($request->has('id') && $request->input('id')!=""){
                $newinfo=Instansi::find($request->input('id'));
            }else{
                $newinfo=new Instansi;
            }
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

            $newinfo->save();

            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil disimpan',
                'errors'=>array()
            );
        }

        return $data;
    }
}