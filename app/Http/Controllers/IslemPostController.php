<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Roles;
use App\Permissions;
use Spatie\Permission\Contracts\Permission;

class IslemPostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['role:super-admin']);
    }

    public function kullanicilar(Request $request)
    {
        $istek = $request->all();
        $id = $istek[$istek["birincilId"]];
        unset($istek["birincilId"]);
        $user = User::where('id', $id)->first();

        foreach ($istek as $key => $value)
        {
            $user->{$key} = $value;
        }

        return json_encode(["sonuc" => $user->update(), "veriler" => $user]);
    }
    
}
