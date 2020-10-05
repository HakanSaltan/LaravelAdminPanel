@extends('layout.default')
@section('css')
@endsection
@section('baslik')
Anasayfa
@endsection
@section('subheader')
<h2 class="text-white font-weight-bold my-2 mr-5">Anasayfa</h2>
@endsection
@section('subheaderalt')
<a href="#" class="opacity-75 hover-opacity-100">
    <i class="flaticon2-shelter text-white icon-1x"></i>
</a>
<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
<a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Anasayfa</a>
@endsection
@section('content')
<div class="card card-custom gutter-b card-stretch">
    <div class="card-header border-0 pt-5">
        <div class="card-title">
            <div class="font-weight-bolder">Anasayfa</div>
        </div>
        <div class="card-toolbar">
            <div class="dropdown dropdown-inline">
                <a href="#" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ki ki-bold-more-hor"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    <ul class="navi navi-hover py-5">
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon"><i class="flaticon2-drop"></i></span>
                                <span class="navi-text">New Group</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        Hesabınız Aktif Edilene Kadar Beklemeye Devam Ediniz.
        Hoşgeldin {{Auth::user()->name }}
    </div>

</div>

@endsection
