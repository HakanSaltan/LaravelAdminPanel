<?php

namespace App\Http\Middleware;

use Closure;

use App\LogUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class LogMiddleware
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
        $uye_isim = isset(Auth::user()->name) ? Auth::user()->name : 'Guest';
        $uye_id = isset(Auth::user()->id) ? Auth::user()->id : '0';
        if($request->method()=="GET"){

          $route_name = $request->path();
          $log = $uye_isim.' (url:://'.$route_name.') sayfasına girdi';
          LogUser::insert(
            [
              "user_id"=>$uye_id,
              "islem"=>$log,
              "islem_kodu"=>"0",
              "ip"=>\Illuminate\Support\Facades\Request::ip(),
              "islem_aciklama"=>json_encode($request->all(), false)
            ]
          );
        }elseif($request->method()=="POST"){
          // $domainStrlen = strlen('http://'.$request->getHttpHost().'/');
          // $lastFullUrl = $_SERVER['HTTP_REFERER']; //

          // $lastScriptUrl = substr($lastFullUrl,$domainStrlen);
          // $lastScriptUrl = $request->path();
          // $routeName = $request->route()->getName();
            $route_name = $request->path();
          // if($request->tip=='yeni'){ // yeni veri girişi
          //     $log = $log.'na yeni kayıt ekledi.';
          // }elseif($request->tip=='sil'){ // var olan veri silinmesi
          //     $log = $log.'nda kayıt sildi.';
          // }else{ // var olan veri düzenlenmesi
            $log = $uye_isim . ' ' . $route_name.' sayfasında kayıt düzenlemesi yaptı.';
          // }
          LogUser::insert(
              [
                "user_id"=>$uye_id,
                "islem"=>$log,
                "islem_kodu"=>"1",
                "ip"=>\Illuminate\Support\Facades\Request::ip(),
                "islem_aciklama"=>json_encode($request->all(), false)
              ]
            );
        }

        return $response;
    }
}
