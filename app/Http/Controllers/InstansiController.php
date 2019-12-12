<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function __construct()
    {
        $info=\App\Models\Cms\Instansi::with(
            [
                'menu'=>function($q){
                    $q->whereNull('parent_id');
                },
                'menu.child',
                'menu.child.child',
                'menu.child.page',
                'video',
                'kontak'
            ]
        )->first();

        \View::share('instansi',$info);
    }
}
