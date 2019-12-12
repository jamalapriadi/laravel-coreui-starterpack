<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\Menu;
use App\Models\Cms\Instansi;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model=Menu::with('parent')->select('*');
        
        if($request->has('q')){
            $model=$model->where('menu','like','%'.$request->input('q').'%');
        }

        $model=$model->paginate(25);

        return $model;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'validasi gagal',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            if($request->has('kode') && $request->input('kode')!=""){
                $kode=$request->input('kode');

                $model= Menu::find($kode);
            }else{
                $model= new Menu;
            }

            $instansi=Instansi::first();
            
            $model->instansi_id=$instansi->id;
            
            $model->menu = $request->input('name');
            $model->menu_url = $request->input('url');
            $model->parent_id = $request->input('parent');
            $model->active="Y";
            $model->save();

            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil disimpan',
                'error'=>''
            );
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model= Menu::with('parent')->find($id);

        return $model;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model= Menu::find($id);

        $hapus=$model->delete();

        if($hapus){
            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil dihapus',
                'error'=>''
            );
        }elsE{
            $data=array(
                'success'=>false,
                'pesan'=>'Data gagal dihapus',
                'error'=>''
            );
        }

        return $data;

    }

    public function list_menu(Request $request){
        $model=Menu::with('parent')->select('*');

        if($request->has('q')){
            $model=$model->where('menu','like','%'.$request->input('q').'%');
        }

        $model=$model->get();

        return $model;
    }

    public function status_menu(Request $request, $id)
    {
        $rules=[
            'status'=>'required'
        ];

        $validasi=\Validator::make($request->all(), $rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'message'=>'Validasi error',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $user=Menu::find($id);
            $user->active=$request->input('status');
            $user->save();

            $data=array(
                'success'=>true,
                'message'=>'Data has been saved',
                'errors'=>array()
            );
        }

        return $data;
    }
}
