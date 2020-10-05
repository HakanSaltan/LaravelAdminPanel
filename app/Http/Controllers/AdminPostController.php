<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Uyeler;
use Illuminate\Support\Facades\Hash;
use Mockery\Expectation;

class AdminPostController extends Controller
{
    /*
    Roller ve İzinlerle ilgili Dökümanlara buradan ulaşabilirsiniz.
    https://docs.spatie.be/laravel-permission/v3/basic-usage/basic-usage/
    */
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin']);
    }




    /*
        @author: Hakan SALTAN
        @since: 03.07.2020
        @desc: Eğer veri tipi yeni ise EKLEME, sil ise SİLME, guncelle ise GÜNCELLEME, yetki ise YETKİLENDİRME işlemleri uygulanmaktadır.
        @param $request->tip: adı
        @param $request->email: email
        @param $request->password: şifre
        @param $request->role: role adı
        @param $request->permissions: permission adları dizi olarak gelir
    */
    public function kullanicilar(Request $request)
    {
        try{
            DB::beginTransaction();
                if($request->tip=='yeni'){
                    $user = new User;
                    $user->name=$request->adi;
                    $user->email=$request->email;
                    $user->password=Hash::make($request->password);
                    $user->save();
                    $user->assignRole($this->roleName($request->role));
                }elseif($request->tip=='sil'){
                    $user = User::where('id',$request->id)->delete();
                }elseif($request->tip=='yetki'){
                    $user = User::where('id',$request->id)->first();
                    $user->syncRoles($request->role);
                    $user->syncPermissions($request->permissions);
                }elseif($request->tip=='guncelle'){
                    $user = User::where('id',$request->id)->first();
                    $user->name=$request->adi;
                    $user->email=$request->email;
                    $user->password=$request->password != null ? Hash::make($request->password) : $user->password;
                    $user->update();
                }

                if($user){
                    DB::commit();
                }else{
                    DB::rollBack();
                }
            return response(["error"=>false]);
        }catch(Exception $e){
            return response(["error"=>true]);
        }
    }

}
