<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class kontrolLogin
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
        $response = $next($request);
        $path = $request->path();
        if($path != "/" && $path != "login" && $path != "logout" && $path != "register"){
            if($request->user()){
                if(isset($_COOKIE['kid'])){

                    if($_COOKIE['kid'] != $request->user()->last_session || $request->user()->last_session == '') {

                        return redirect('/kontrolLogout');
                    }
                }else{
                    return redirect('/kontrolLogout');
                }
            }
        }
        return $response;
    }
}
