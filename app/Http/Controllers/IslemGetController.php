<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Roles;
use App\Permissions;
use Spatie\Permission\Contracts\Permission;

class IslemGetController extends Controller
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

    public function kullanicilar()
    {
        return json_encode(["veriler" => User::all(), "sonuc"=> true]);
    }
    
}
