<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request){
        $role=Role::select('id','name','guard_name');

        if($request->has('q')){
            $role=$role->where('name','like','%'.$request->input('q').'%');
        }

        if($request->has('halaman')){
            $halaman=$request->input('halaman');
        }else{
            $halaman=25;
        }

        $role=$role->paginate($halaman);

        return $role;
    }

    public function store(Request $request){
        $rules=[
            'name'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $role = Role::create(['name' => $request->input('name')]);

            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil disimpan',
                'error'=>''
            );
        }

        return $data;
    }

    public function show($id){
        $role=Role::with('permissions')->findOrFail($id);

        return $role;
    }

    public function update(Request $request,$id){
        $rules=[
            'name'=>'required'
        ];

        $validasi=\Validator::make($request->all(),$rules);

        if($validasi->fails()){
            $data=array(
                'success'=>false,
                'pesan'=>'Validasi error',
                'errors'=>$validasi->errors()->all()
            );
        }else{
            $role=Role::find($id)            
                ->update(
                    [
                        'name'=>$request->input('name')
                    ]
                );

            $data=array(
                'success'=>true,
                'pesan'=>'Data berhasil disimpan',
                'error'=>''
            );
        }

        return $data;
    }

    public function destroy($id){
        $role=Role::find($id);

        $hapus=$role->delete();

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

    public function list_role_with_permission($id){
        $user=\App\User::with('permissions','roles')->find($id);
        $role=Role::with('permissions')->get();

        return array(
            'user'=>$user,
            'role'=>$role
        );
    }

    public function list_role(Request $request)
    {
        return $role=Role::with('permissions')->get();
    }
}