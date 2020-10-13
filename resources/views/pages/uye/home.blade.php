@extends('layout.default')
@section('styles')
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
        @Can('KullaniciSilme')
            Hoşgeldin {{Auth::user()->name }}
        @endCan
    </div>

</div>


@endsection
