<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Roles;
use App\Permissions;
use Spatie\Permission\Contracts\Permission;

class AdminGetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin']);
    }

    public function index()
    {
        return view('pages.admin.home');
    }

    public function kullanicilar()
    {
        $roles = Roles::all();
        $permissions = Permissions::all();
        return view('pages.admin.kullanicilar')->with('roles',$roles)->with('permissions',$permissions);
    }
    public function profile()
    {
        $profile = User::where('id','=',Auth::user()->id)->first();
        return view('pages.admin.profile')->with('profil',$profile);
    }
}
