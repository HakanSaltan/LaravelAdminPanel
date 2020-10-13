<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->hasRole('super-admin')){
            return redirect()->route('adminHome');
        }else if(Auth::user()->hasRole('uye')){
            return redirect()->route('uyeHome');
        }else{
            return view('home');
        }
    }
    public function gorevler()
    {
        return view('pages.genel.gorevler');
    }

}
