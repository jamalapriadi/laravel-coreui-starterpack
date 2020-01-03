<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cms\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category=Category::with('parent')->select('id','category_name','slug','description','updated_at','parent_id');
        
        if($request->has('q')){
            $category=$category->where('category_name','like','%'.$request->input('q').'%');
        }

        $category=$category->paginate(25);

        return $category;
        
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
            'name'=>'required|max:125',
            'desc'=>'required'
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
                $kd=$request->input('kode');
                $category=Category::find($kd);
            }else{
                $category=new Category;
            }
            
            $category->category_name=$request->input('name');
            $category->description=$request->input('desc');

            if($request->has('parent')){
                $category->parent_id=$request->input('parent');
            }

            $category->save();

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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent=Category::whereNull('parent_id')
            ->get();

        $category=Category::with('parent')->find($id);

        return array('category'=>$category,'parent'=>$parent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'category'=>'required|max:125',
            'desc'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'validasi gagal',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $category=Category::find($id);
            $category->slug=null;
            $category->category_name=$request->input('category');
            $category->description=$request->input('desc');

            if($request->has('parent') && $request->input('parent')!=null){
                $category->parent_id=$request->input('parent');
            }

            $category->save();

            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil diupdate',
                'error'=>''
            );
        }

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);


        $hapus=$category->delete();

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

    public function list_category(Request $request){
        $category=Category::select('id','category_name as text')
            ->whereNull('parent_id');

        if($request->has('q')){
            $category=$category->where('category_name','like','%'.$request->input('q').'%');
        }

        $category=$category->get();

        return $category;
    }

    public function list_sub_category(Request $request,$id){
        $sub=Category::where('parent_id',$id)
            ->get();

        return $sub;
    }
}
