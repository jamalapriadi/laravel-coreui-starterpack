<?php

namespace App\Http\Middleware;

use Closure;

class CekSiteInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response=$next($request);

        $info=\App\Models\Cms\Instansi::first();

        if($info==null){
            return response()->view('setup-instansi');
        }

        return $response;
    }
}
