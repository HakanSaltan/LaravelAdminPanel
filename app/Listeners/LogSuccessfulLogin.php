<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\User;
use Auth;
use App\LogLogin;
class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if(!isset($_COOKIE['kid'])){
            $zaman = time();
            setcookie('kid', $zaman, $zaman + (60*60*1));

            $new_session_id = $zaman;

            User::where('id',Auth::user()->id)->update([
                "last_session"        => $new_session_id,
            ]);
        }else{
            User::where('id',Auth::user()->id)->update([
                "last_session"        => $_COOKIE['kid'],
            ]);
        }
        LogLogin::insert(
            [
                "user_id"=>Auth::user()->id,
                "aciklama"=>Auth::user()->name . " Giriş Yaptı",
                "islem_kodu"=>"1",
                "ip"=>\Illuminate\Support\Facades\Request::ip()
            ]);
    }
}
