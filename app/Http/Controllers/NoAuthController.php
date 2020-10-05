<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class NoAuthController extends Controller
{
    public function kontrolLogin(Request $request){

        $email = $request->email;
        $kullaniciInfo = User::where('email',$email)->first();
        if(isset($_COOKIE['kid'])){
            if($_COOKIE['kid'] == $kullaniciInfo->last_session || $kullaniciInfo->last_session == ''){
                return response(["status"=>"success"]);
            }else{
                return response(["status"=>"error"]);
            }
        }else{
            User::where('id',$kullaniciInfo->id)->update([
                "last_session"        => '',
            ]);
            return response(["status"=>"success"]);
        }
    }

    public function kontrolLogout(){
        Auth::logout();
        return redirect('/login');
    }
    public function lastSession(Request $request){
        $userId = $request->userId;
        User::where('id',$userId)->update([
            "last_session"        => '',
        ]);
        return response(["status"=>"success"]);
    }
}
